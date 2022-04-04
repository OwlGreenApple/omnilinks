<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\Helper;

use App\Page;
use App\Link;
use App\Banner;
use App\Proof;
use App\ProofHistory;
use App\User;
use App\Order;

use Validator, Auth, Carbon, Mail;

class ProofController extends Controller
{
    public function index()
    {
      $user = Auth::user();
      $data = array(
        'total_proof_credit'=>str_replace(',','.',number_format($user->point))
      );
     
      return view('user.proof.index',$data);
    }

    //mengurangi point page per user visit hlmn omli
    public function count_page_point(Request $request)
    {
      if (Auth::check() === true) {
         $auth = Auth::id();
      }
      else
      {
         $auth = 0;
      }
      
      $updated = false;
      $page =  Page::where([['user_id',$request->user_id],['names',$request->page]])->orWhere('premium_names',$request->page)->first();

      $proof_history = ProofHistory::where([['user_id',$request->user_id],['page_name',$request->page],['ip_address',$request->ip]])->whereDate('created_at', Carbon::today())->get();

      if(is_null($page) || $auth == $request->user_id || $proof_history->count() >= 3)
      {
         exit();
      }

      $available_proof = Proof::where('page_id',$page->id)->get()->count();

      $current_page_point = $page->point;
      if($current_page_point > 0 && $available_proof > 0)
      {
          $updated_page_point = $current_page_point - 1;
      }
      else
      {
          exit();
      }

      try
      {
        $page->point = $updated_page_point;
        $page->save();
        $updated = true;
      }
      catch(QueryException $e)
      {
        //$e->getMessage();
        exit();
      }

      $ip = $request->ip;
      // $ip = 'down';
      if($ip === 'down')
      {
        $total_no_ip = ProofHistory::where([['page_name',$request->page],['ip_address','LIKE','%0.0.0%']])->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') = CURDATE()")->get();

        $ip = '0.0.0.'.$total_no_ip->count();
      }

      if($updated == true)
      {
        $ph = new ProofHistory;
        $ph->user_id = $request->user_id;
        $ph->page_name = $request->page;
        $ph->ip_address = $ip;
        $ph->kredit = 1;

        try
        {
          $ph->save();
        }
        catch(QueryException $e)
        {
          //$e->getMessage();
        }
      }
      exit();
    }

    public function display_links(Request $request)
    {
      $page = Page::where('user_id',Auth::id())->get();
      $datatable_pagination = $request->pagination;
      $data = [];

      if($page->count() > 0)
      {
        foreach($page as $row):
          if($row->premium_names <> null || !empty($row->premium_names))
          {
              $names = $row->premium_names;
          }
          else
          {
              $names = $row->names;
          }

          $data[] = [
            'id'=>$row->id,
            'name'=>$names,
            'credit'=>$row->point,
            'edit_link'=>url('biolinks').'/'.$row->uid
          ];
        endforeach;
      }
      return view('user.proof.content',['pages'=>$data,'paging'=>$datatable_pagination]);
    }

    public function counting_point(Request $request)
    {
      $page_id = $request->id;
      $nominal = $request->nominal;
      $purpose = $request->purpose;
      $user = Auth::user();

      $page = Page::find($page_id);
      $user_point = $res['point'] = $user->point;
 
      //purpose 1 = add points
      if($purpose == 1)
      {
        $user_point = $user_point - $nominal;
        if($user_point < 0)
        {
          $res['err'] = 3;
          return response()->json($res);
        }

        $ph = new ProofHistory;
        $ph->user_id = $user->id;
        $ph->page_name = $request->page;
        $ph->debit = $nominal;

        try
        {
          $page->point += $nominal;
          $page->save();
          $user->point = $user_point;
          $user->save();
          $ph->save();
          $res['err'] = 0;
          $res['point'] = str_replace(",",".",number_format($user->point));
        }
        catch(QueryException $e)
        {
          //$e->getMessage();
          $res['err'] = 1;
        }
        return response()->json($res);
      }

      //substract

      $diff = $page->point - $nominal;
      if($diff >= 0)
      {
        $user_point = $user_point + $nominal;

        $ph = new ProofHistory;
        $ph->user_id = $user->id;
        $ph->page_name = $request->page;
        $ph->kredit = $nominal;

        try{
          $page->point = $diff;
          $page->save();
          $user->point = $user_point;
          $user->save();
          $ph->save();
          $res['err'] = 0;
          $res['point'] = str_replace(",",".",number_format($user->point));
        }
        catch(QueryException $e)
        {
          //$e->getMessage();
          $res['err'] = 1;
        }
      }
      else
      {
          $res['err'] = 2;
      }
      return response()->json($res);
  }

  function proof_history(Request $request)
  {
    $mod = $request->get('mod');

    if($mod == null)
    {
      $pf = ProofHistory::where('user_id',Auth::id())->get();
    }
    else
    {
      $pf = ProofHistory::where([['user_id',Auth::id()],['page_name','=',$mod]])->get();
    }

    return view('user.proof.history',['pf'=>$pf]);
  }

  public function checkout_proof($id)
  {
    return view('pricing.checkoutproof')->with(array('id'=>$id));
  }

  private function cek_proof_price($package,$price)
  {
    $paket = array(
      getActivProofPackage()[1]['package'] => getActivProofPackage()[1]['price'],
      getActivProofPackage()[2]['package'] => getActivProofPackage()[2]['price'],
      getActivProofPackage()[3]['package'] => getActivProofPackage()[3]['price'],
      getActivProofPackage()[4]['package'] => getActivProofPackage()[4]['price'],
    );

    if(isset($paket[$package]))
    {
      if($price!=$paket[$package]){
        return false; 
      } else {
        return true;
      }
    }
    else
    {
      return false;
    }
  }

  public function proof_payment(Request $request)
  {
    $user = Auth::user();
    $check_price = $this->cek_proof_price($request->package,$request->price);

    if($check_price == false)
    {
      $res['msg'] = 2;
      return response()->json($res); 
    }

    $diskon = 0;
    //unique code 
    $unique_code = mt_rand(1, 1000);

    $dt = Carbon::now();
    $order = new Order;
    $str = 'OML'.$dt->format('ymdHi');
    $order_number = Helper::autoGenerateID($order, 'no_order', $str, 3, '0');
    $order->no_order = $order_number;
    $order->user_id = $user->id;
    $order->package =$request->package;
    $order->jmlpoin=0;
    $order->coupon_id = 0;
    $order->total = $request->price + $unique_code;
    $order->discount = $diskon;
    $order->grand_total = $request->price - $diskon + $unique_code;
    $order->status = 0;
    $order->buktibayar = "";
    $order->keterangan = "";

    try
    {
      $order->save();
      $order_status = true;
    }
    catch(QueryException $e)
    {
      // dd($e->getMessage());
      $order_status = false;
    }

    if($order_status == true)
    {
      $emaildata = [
        'order' => $order,
        'user' => $user,
        'nama_paket' => $request->package,
        'no_order' => $order_number,
      ];
    
      $helper = new Helper;
      if(env('APP_ENV') !== 'local' && $helper->check_email_bouncing($user->email) == true){
          Mail::send('emails.topupactivproof', $emaildata, function ($message) use ($user,$order_number) {
            $message->from('info@omnilinkz.com', 'Omnilinkz');
            $message->to($user->email);
            $message->subject('[Omnilinkz] Order Nomor '.$order_number);
          });
      }
    }
    else
    {
        $res['msg'] = 0;
        return response()->json($res); 
    }

    if(!is_null($user->wa_number))
    {
      $message = null;
      $message .= '*Hi '.$user->name.'*,'."\n\n";
      $message .= "Berikut info pemesanan topup Activproof :\n";
      $message .= '*No Order :* '.$order->no_order.''."\n";
      $message .= '*Nama :* '.$user->name.''."\n";
      $message .= '*Paket :* '.$order->package.''."\n";
      // $message .= '*Tgl Pembelian :* '.$dt->format('d-M-Y').''."\n";
      $message .= '*Total Biaya :*  Rp. '.str_replace(",",".",number_format($order->grand_total))."\n";

      $message .= "Silahkan melakukan pembayaran dengan bank berikut : \n\n";
      $message .= 'BCA (Sugiarto Lasjim)'."\n";
      $message .= '8290-812-845'."\n\n";
      
      $message .= "Harus diperhatikan juga, kalau jumlah yang di transfer harus *sama persis dengan nominal diatas* supaya _*kami lebih mudah memproses pembelianmu*_.\n\n";

      $message .= '*Sesudah transfer:*'."\n";
      $message .= '- *Login* ke https://omnilinkz.com'."\n";
      $message .= '- *Klik* Profile'."\n";
      $message .= '- Pilih *Order & Confirm*'."\n";
      $message .= '- *Upload bukti konfirmasi* disana'."\n\n";

      $message .= 'Terima Kasih,'."\n\n";
      $message .= 'Team Omnilinkz'."\n";
      $message .= '_*Omnilinkz is part of Activomni.com_';
      
      Helper::send_message_queue_system($user->wa_number,$message);
     }

     $res['msg'] = 1;
     return response()->json($res); 
  }


/* END CONTROLLER */
}
