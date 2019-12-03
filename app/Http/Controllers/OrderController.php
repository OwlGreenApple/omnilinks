<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Account;
use App\HistorySearch;
use App\User;
use App\Group;
use App\Save;
use App\Coupon;
use App\Order;
use App\UserLog;
use App\Notification;
use App\Ads;
use App\AdsHistory;

use App\Helpers\Helper;
use Carbon, Crypt;
use Auth,Mail,Validator,Storage,DateTime;

class OrderController extends Controller
{   
  public function cekharga($namapaket, $price){
    //cek paket dengan harga
    $paket = array(
      'Basic Monthly' => 155000,
      'Elite Monthly' => 195000,
      'Basic Yearly' => 1020000,
      'Elite Yearly' => 1140000,
      'Top Up 5000' => 62500,
      'Top Up 10000' => 115000,
      'Top Up 20000' => 210000,
      'Top Up 25000' => 237000,
      'Top Up 50000' => 425000,
      'Top Up 75000' => 562000,
      'Top Up 100000' => 650000,
    );

    if(isset($paket[$namapaket])){
      if($price!=$paket[$namapaket]){
        return false; 
      } else {
        return true;
      }
    } else {
      return false;
    }
  }

  public function cekpoin($namapaket){
    //cek paket dengan harga
    $paket = array(
      'Top Up 5000' => 5000,
      'Top Up 10000' => 10000,
      'Top Up 20000' => 20000,
      'Top Up 25000' => 25000,
      'Top Up 50000' => 50000,
      'Top Up 75000' => 75000,
      'Top Up 100000' => 100000,
    );

    if(isset($paket[$namapaket])){
      return $paket[$namapaket];
    } else {
      return false;
    }
  }

  public function cek_kupon($kodekupon,$harga,$idpaket){
    //cek kodekupon
    $arr['status'] = 'success';
    $arr['message'] = '';
    $arr['total'] = number_format($harga, 0, '', '.');
    $arr['diskon'] = 0;
    $arr['coupon'] = null;

    if($kodekupon!=''){
      $coupon = Coupon::where('kodekupon',$kodekupon)
                ->where(function($query) use ($idpaket) {
                  $query->where('package_id',$idpaket)
                        ->orwhere('package_id',0);
                })
                ->first();

      if(is_null($coupon)){
        $arr['status'] = 'error';
        $arr['message'] = 'Kupon tidak terdaftar';
      } else {
        $now = new DateTime();
        $date = new DateTime($coupon->valid_until);
        
        if($date<$now){
          $arr['status'] = 'error';
          $arr['message'] = 'Kupon sudah tidak berlaku';
        } else {
          if($coupon->valid_to=='new' and Auth::check()){

          } else if($coupon->valid_to=='extend' and !Auth::check()){

          } else {
            $total = 0;
            $diskon = 0;

            if($coupon->diskon_value==0 and $coupon->diskon_percent!=0){
              $diskon = $harga * $coupon->diskon_percent/100;
              $total = $harga - $diskon;
            } else {
              $diskon = $coupon->diskon_value;
              $total = $harga - $coupon->diskon_value;
            }

            $arr['status'] = 'success';
            $arr['message'] = 'Kupon berhasil dipakai & berlaku sekarang';
            $arr['total'] = number_format($total, 0, '', '.');;
            $arr['diskon'] = $diskon;
            $arr['coupon'] = $coupon;
          }
        }
      }
    }

    return $arr;
  }

  public function register(Request $request) {
    //register dengan order
    $stat = $this->cekharga($request->namapaket,$request->price);

    if($stat==false){
      return redirect("checkout/1")->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
    }

    $arr = $this->cek_kupon($request->kupon,$request->price,$request->idpaket);

    if($arr['status']=='error'){
      return redirect("checkout/1")->with("error", $arr['message']);
    }

    return view('auth.register')->with(array(
      "price"=>$request->price,
      "namapaket"=>$request->namapaket,
      "coupon_code"=>$request->kupon,
      "idpaket" => $request->idpaket,
    ));
  }

  public function index_order()
  {
    //halaman order user
    return view('order.index');
  }

  public function thankyou()
  {
    //halaman thankyou
    return view('pricing.thankyou');
  }

  public function checkout($id){
    //halaman checkout
    return view('pricing.checkout')->with(array(
              'id'=>$id,    
            ));
  }

  public function load_order(Request $request)
  {
    //halaman order user
    $orders = Order::where('user_id',Auth::user()->id)
                ->orderBy('created_at','descend')
                ->paginate(15);
                //->get();
    $arr['view'] = (string) view('order.content')
                      ->with('orders',$orders);
    $arr['pager'] = (string) view('order.pagination')
                      ->with('orders',$orders); 
    return $arr;
  }

  public function load_list_order(Request $request)
  {
    //halaman list order admin
    $orders = Order::join(env('DB_DATABASE').'.users','orders.user_id','users.id')  
                ->select('orders.*','users.email')
                ->orderBy('created_at','descend')
                ->get();
    $arr['view'] = (string) view('admin.list-order.content')
                      ->with('orders',$orders);
    /*$arr['pager'] = (string) view('admin.list-order.pagination')
                      ->with('orders',$orders); */
    return $arr;
  }
  
  public function check_kupon(Request $request){
    //cek kodekupon
    $arr = $this->cek_kupon($request->kupon,$request->harga,$request->idpaket);
    return $arr;
  }

  public function confirm_payment_order(Request $request)
  {
    $user = Auth::user();
    //konfirmasi pembayaran user
    $order = Order::find($request->id_confirm);
    $folder = $user->email.'/buktibayar';

    if($order->status==0)
    {
      $order->status = 1;

      if($request->hasFile('buktibayar'))
      {
        // $path = Storage::putFile('bukti',$request->file('buktibayar'));
        $dir = 'bukti_bayar/'.explode(' ',trim($user->name))[0].'-'.$user->id;
        $filename = $order->no_order.'.jpg';
        Storage::disk('s3')->put($dir."/".$filename, file_get_contents($request->file('buktibayar')), 'public');
        $order->buktibayar = $dir."/".$filename;
        
      } else {
        $arr['status'] = 'error';
        $arr['message'] = 'Upload file buktibayar terlebih dahulu';
        return $arr;
      }  
      $order->keterangan = $request->keterangan;
      $order->save();

      $arr['status'] = 'success';
      $arr['message'] = 'Konfirmasi pembayaran berhasil';
    } else {
      $arr['status'] = 'error';
      $arr['message'] = 'Order telah atau sedang dikonfirmasi oleh admin';
    }

    return $arr;
  }

  public function confirm_payment(Request $request){
    //buat order user lama
    $stat = $this->cekharga($request->namapaket,$request->price);

    if($stat==false){
      return redirect("checkout/1")->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
    }

    if(substr($request->namapaket,0,6) === "Top Up"){
      $ads = Ads::where('user_id',Auth::user()->id)->first();
      if(is_null($ads)){
        return redirect("checkout/5")->with("error", "Buat Ads terlebih dahulu sebelum melakukan Top Up.");   
      } 
    }

    $user = Auth::user();

    $diskon = 0;
    $total = $request->price;
    $kuponid = null;
    if($request->kupon!=''){
      $arr = $this->cek_kupon($request->kupon,$request->price,$request->idpaket);

      if($arr['status']=='error'){
        return redirect("checkout/1")->with("error", $arr['message']);
      } else {
        $total = $arr['total'];
        $diskon = $arr['diskon'];
        
        if($arr['coupon']!=null){
          $kuponid = $arr['coupon']->id;
        }
      }
    }

    $dt = Carbon::now();
    $order = new Order;
    $str = 'OML'.$dt->format('ymdHi');
    $order_number = Helper::autoGenerateID($order, 'no_order', $str, 3, '0');
    $order->no_order = $order_number;
    $order->user_id = $user->id;
    $order->package =$request->namapaket;
    $order->jmlpoin=0;
    $order->coupon_id = $kuponid;
    $order->total = $request->price;
    $order->discount = $diskon;
    $order->grand_total = $total;
    $order->status = 0;
    $order->buktibayar = "";
    $order->keterangan = "";
    $order->save();

    if($order->grand_total!=0){
      //mail order to user 
      $emaildata = [
          'order' => $order,
          'user' => $user,
          'nama_paket' => $request->namapaket,
          'no_order' => $order_number,
      ];
      Mail::send('emails.order', $emaildata, function ($message) use ($user,$order_number) {
        $message->from('no-reply@omnilinkz.com', 'Omnilinkz');
        $message->to($user->email);
        $message->subject('[Omnilinkz] Order Nomor '.$order_number);
      });
    } else {
      $order->status = 2;
      $order->save();

      if(substr($order->package,0,5) === "Basic"){
        if($order->package=='Basic Monthly'){
          $valid = $this->add_time($user,"+1 months");
        } else if($order->package=='Basic Yearly'){
          $valid = $this->add_time($user,"+12 months");
        }

        $userlog = new UserLog;
        $userlog->user_id = $user->id;
        $userlog->type = 'membership';
        $userlog->value = 'basic';
        $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to basic('.$valid->format('Y-m-d h:i:s').')';
        $userlog->save();

        $user->valid_until = $valid;
        $user->membership = 'basic';

      } else if(substr($order->package,0,5) === "Elite"){
        if($order->package=='Elite Monthly'){
           $valid = $this->add_time($user,"+1 months");
        } else if($order->package=='Elite Yearly'){
          $valid = $this->add_time($user,"+12 months");
        }

        $userlog = new UserLog;
        $userlog->user_id = $user->id;
        $userlog->type = 'membership';
        $userlog->value = 'elite';
        $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to elite('.$valid->format('Y-m-d h:i:s').')';
        $userlog->save();

        $user->valid_until = $valid;
        $user->membership = 'elite';
      }

      $user->save();
    }

    if(substr($order->package,0,6) === "Top Up"){
      $poin = $this->cekpoin($order->package);
      $order->jmlpoin = $poin;
      $order->ads_id = $ads->id;
  
      $order->save();
    }

    return view('pricing.thankyou');
  }

  public static function add_time($user,$time){
    //tambah waktu valid until
    if(is_null($user->valid_until)){
      $valid = new DateTime($time);
    } else {
      $now = new DateTime();
      $uservalid = new DateTime($user->valid_until);

      if($uservalid<$now){
        $valid = new DateTime($time);
      } else {
        $uservalid = strtotime($user->valid_until);
        $valid = new DateTime (date("Y-m-d", strtotime($time, $uservalid)));
      }
    }

    /*if(is_null($user->valid_until)){
      $valid = new DateTime($time);
    } else {
      $now = new DateTime();

      if(is_a($user->valid_until, 'DateTime')){
        $uservalid = $user->valid_until;
      } else {
        $uservalid = new DateTime($user->valid_until);  
      }

      if($uservalid<$now){
        $valid = new DateTime($time);
      } else {
        if(is_a($user->valid_until, 'DateTime')){
          //modify nya masih belum jalan
          $valid = $user->valid_until->modify($time);
        } else {
          $uservalid = strtotime($user->valid_until);
          $valid = new DateTime (date("Y-m-d", strtotime($time, $uservalid)));
        }
      }
    }*/

    return $valid;
  }

  public function confirm_order(Request $request){
    //konfirmasi pembayaran admin
    $order = Order::find($request->id);
    $order->status = 2;
    
    $user = User::find($order->user_id);
    $valid=null;

    if(substr($order->package,0,5) === "Basic"){
      if($order->package=='Basic Monthly'){
        //$valid = new DateTime("+1 months");
        $valid = $this->add_time($user,"+1 months");
      } else if($order->package=='Basic Yearly'){
        //$valid = new DateTime("+12 months");
        $valid = $this->add_time($user,"+12 months");
      }

      $userlog = new UserLog;
      $userlog->user_id = $user->id;
      $userlog->type = 'membership';
      $userlog->value = 'basic';
      $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to basic('.$valid->format('Y-m-d h:i:s').')';
      $userlog->save();

      $user->valid_until = $valid;
      $user->membership = 'basic';
    } else if(substr($order->package,0,5) === "Elite"){
      if($order->package=='Elite Monthly'){
        //$valid = new DateTime("+1 months");
        $valid = $this->add_time($user,"+1 months");
      } else if($order->package=='Elite Yearly'){
        //$valid = new DateTime("+12 months");
        $valid = $this->add_time($user,"+12 months");
      }

      $userlog = new UserLog;
      $userlog->user_id = $user->id;
      $userlog->type = 'membership';
      $userlog->value = 'elite';
      $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to elite('.$valid->format('Y-m-d h:i:s').')';
      $userlog->save();

      $user->valid_until = $valid;
      $user->membership = 'elite';
    }

    $user->save();
    $order->save();

    if(substr($order->package,0,6) === "Top Up"){
      $ads = Ads::find($order->ads_id);

      $adshistory = new AdsHistory;
      $adshistory->user_id = $order->user_id;
      $adshistory->ads_id = $ads->id;
      $adshistory->credit_before = $ads->credit;
      $adshistory->credit_after = $ads->credit + $order->jmlpoin;
      $adshistory->jml_credit = $order->jmlpoin;
      $adshistory->description = 'top up';
      $adshistory->save();

      $ads->credit = $ads->credit + $order->jmlpoin;
      $ads->save();
    }

    $emaildata = [
      'order' => $order,
      'user' => $user,
    ];

    Mail::send('emails.confirm-order', $emaildata, function ($message) use ($user,$order) {
      $message->from('no-reply@omnilinkz.com', 'Omnilinkz');
      $message->to($user->email);
      $message->subject('[Omnilinkz] Konfirmasi Order'.$order->no_order);
    });

    $arr['status'] = 'success';
    $arr['message'] = 'Order berhasil dikonfirmasi';

    return $arr;
  }

}
