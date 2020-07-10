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
      'Pro Monthly' => 155000,
      'Elite Monthly' => 195000,
      'Pro Yearly' => 1020000,
      'Elite Yearly' => 1140000,
      'Top Up 5000' => 62500,
      'Top Up 10000' => 115000,
      'Top Up 20000' => 210000,
      'Top Up 25000' => 237000,
      'Top Up 50000' => 425000,
      'Top Up 75000' => 562000,
      'Top Up 100000' => 650000,
      
      'Elite Special 2 Months' => 195000,
      // 'Elite Special 3 Months' => 295000,
      'Elite Special 6 Months' => 295000,
      'Elite Special 5 Months' => 395000,
      // 'Elite Special 7 Months' => 495000,
      'Elite Special 12 Months' => 595000,
      
      //new 
      'Pro' => 195000, //30hari
      'Popular' => 395000, //90hari
      'Elite' => 695000, //180 hari
      'Super' => 1095000, //360 hari
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
    $user = Auth::user();
    //cek kodekupon
    $arr['status'] = 'success';
    $arr['message'] = '';
    $arr['total'] = number_format($harga, 0, '', '.');
    $arr['diskon'] = 0;
    $arr['coupon'] = null;
    $arr['pricing'] = '';

    if($kodekupon!=''){
      $user_id = 0;
      if (!is_null($user)) {
        $user_id = $user->id;
      }
      $coupon = Coupon::where('kodekupon',$kodekupon)
              ->where(function($query) use ($idpaket) {
                $query->where('package_id',$idpaket)
                      ->orwhere('package_id',0);
              })
              ->where(function($query) use ($user_id) {
                $query->where('user_id',$user_id)
                      ->orwhere('user_id',0);
              })
              ->first();

      if(is_null($coupon)){
        $arr['status'] = 'error';
        $arr['message'] = 'Kupon tidak terdaftar';
        return $arr;
      } else {
        // $now = new DateTime();
        // $date = new DateTime($coupon->valid_until);
        $now = Carbon::now();
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->valid_until);
        
        if($date->lt($now)){
          $arr['status'] = 'error';
          $arr['message'] = 'Kupon sudah tidak berlaku';
          return $arr;
        } else {
          if($coupon->valid_to=='new' and Auth::check()){
              //..
          } else if($coupon->valid_to=='extend' and !Auth::check()){
            //..
          } 
          else if(substr($coupon->valid_to,0,7)=='package'){
            $total = 0;
            $diskon = 0;
            $paket = "";
            $paketid = 0;
            $dataPaket = "";
						$harga_sebelum_diskon = 1095000;

            if ($coupon->valid_to == "package-elite-2") {
              $total = 195000;
              $paket = "Paket Special Elite 2 Bulan";
              $paketid = 12;
              $dataPaket = "Elite Special 2 Months";
            }
            if ($coupon->valid_to == "package-elite-6") {
              $total = 295000;
              $paket = "Paket Special Elite 6 Bulan";
              $paketid = 13;
              $dataPaket = "Elite Special 6 Months";
							$harga_sebelum_diskon = 695000;
            }
            if ($coupon->valid_to == "package-elite-5") {
              $total = 395000;
              $paket = "Paket Special Elite 5 Bulan";
              $paketid = 14;
              $dataPaket = "Elite Special 5 Months";
            }
            if ($coupon->valid_to == "package-elite-12") {
              $total = 595000;
              $paket = "Paket Special Elite 12 Bulan";
              $paketid = 15;
              $dataPaket = "Elite Special 12 Months";              
            }

            // selectbox ditambah dengan paket kupon 
            $arr['status'] = 'success-paket';
            $arr['message'] = 'Kupon berhasil dipakai & berlaku sekarang';
            $arr['total'] = number_format($total, 0, '', '.');
            $arr['pricing'] = '<strike>'.number_format($harga_sebelum_diskon, 0, '', '.').'</strike>';
            $arr['diskon'] = $diskon;
            $arr['coupon'] = $coupon;
            $arr['kodekupon'] = $coupon->kodekupon;
            $arr['paket'] = $paket;
            $arr['paketid'] = $paketid;
            $arr['dataPaket'] = $dataPaket;
            $arr['dataPrice'] = $total;
            return $arr;
          }
          else if(($coupon->valid_to=='') || ($coupon->valid_to=='expired-membership') || ($coupon->valid_to=='all') ){
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
            $arr['pricing'] = '<strike>'.number_format($harga, 0, '', '.').'</strike>';
            $arr['total'] = number_format($total, 0, '', '.');
            $arr['diskon'] = $diskon;
            $arr['coupon'] = $coupon;
            return $arr;
          }
        }
      }
    }

    return $arr;
  }

  public function register(Request $request) {
    //register dengan order
    $stat = $this->cekharga($request->namapaket,$request->price);

    $pathUrl = str_replace(url('/'), '', url()->previous());
    if($stat==false){
      // return redirect("checkout/1")->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
      return redirect($pathUrl)->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
    }

    $arr = $this->cek_kupon($request->kupon,$request->price,$request->idpaket);

    if($arr['status']=='error'){
      // return redirect("checkout/1")->with("error", $arr['message']);
      return redirect($pathUrl)->with("error", $arr['message']);
    }

    return view('auth.register')->with(array(
      "price"=>$request->price,
      "namapaket"=>$request->namapaket,
      "coupon_code"=>$request->kupon,
      "idpaket" => $request->idpaket,
    ));
  }

  public function index_order(){
    //halaman order user
    return view('order.index');
  }

  public function thankyou(){
    //halaman thankyou
    return view('pricing.thankyou')->with(array(
              'order'=>null,    
            ));
  }

  public function thankyou_register(){
    //halaman thankyou
    return view('pricing.thankyou-register')->with(array(
          'order'=>null,
          'coupon_code' => null,
    ));
    
  }

  public function thankyou_confirm_payment(){
    //halaman thankyou
    return view('pricing.thankyou-confirm-payment');
    
  }

  public function checkout($id){
    //halaman checkout
    return view('pricing.checkout')->with(array(
              'id'=>$id,
              'type'=>'normal-package',
            ));
  }

  public function load_order(Request $request){
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

  public function load_list_order(Request $request){
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

  //upload bukti TT 
  public function confirm_payment_order(Request $request){
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
        // $arr['status'] = 'error';
        // $arr['message'] = 'Upload file buktibayar terlebih dahulu';
        // return $arr;
        $pathUrl = str_replace(url('/'), '', url()->previous());
        return redirect($pathUrl)->with("error", "Upload file buktibayar terlebih dahulu");
      }  
      $order->keterangan = $request->keterangan;
      $order->save();

      // $arr['status'] = 'success';
      // $arr['message'] = 'Konfirmasi pembayaran berhasil';
    } else {
      // $arr['status'] = 'error';
      // $arr['message'] = 'Order telah atau sedang dikonfirmasi oleh admin';
        $pathUrl = str_replace(url('/'), '', url()->previous());
        return redirect($pathUrl)->with("error", "Order telah atau sedang dikonfirmasi oleh admin.");
    }

    // return $arr;
    return view('pricing.thankyou-confirm-payment');
  }


  //checkout klo uda login
  public function confirm_payment(Request $request){
    //buat order user lama
    $stat = $this->cekharga($request->namapaket,$request->price);

    $pathUrl = str_replace(url('/'), '', url()->previous());
    if($stat==false){
      // return redirect("checkout/1")->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
      return redirect($pathUrl)->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
    }

    if(substr($request->namapaket,0,6) === "Top Up"){
      $ads = Ads::where('user_id',Auth::user()->id)->first();
      if(is_null($ads)){
        // return redirect("checkout/5")->with("error", "Buat Ads terlebih dahulu sebelum melakukan Top Up.");   
        return redirect($pathUrl)->with("error", "Buat Ads terlebih dahulu sebelum melakukan Top Up.");   
      } 
    }

    $user = Auth::user();

    $diskon = 0;
    // $total = $request->price;
    $kuponid = null;
    if($request->kupon!=''){
      $arr = $this->cek_kupon($request->kupon,$request->price,$request->idpaket);

      if($arr['status']=='error'){
        // return redirect("checkout/1")->with("error", $arr['message']);
        return redirect($pathUrl)->with("error", $arr['message']);
      } else {
        // $total = $arr['total'];
        $diskon = $arr['diskon'];
        
        if($arr['coupon']!=null){
          $kuponid = $arr['coupon']->id;
        }
      }
    }

    //unique code 
    $unique_code = mt_rand(1, 1000);

    $dt = Carbon::now();
    $order = new Order;
    $str = 'OML'.$dt->format('ymdHi');
    $order_number = Helper::autoGenerateID($order, 'no_order', $str, 3, '0');
    $order->no_order = $order_number;
    $order->user_id = $user->id;
    $order->package =$request->namapaket;
    $order->jmlpoin=0;
    $order->coupon_id = $kuponid;
    $order->total = $request->price + $unique_code;
    $order->discount = $diskon;
    $order->grand_total = $request->price - $diskon + $unique_code;
    $order->status = 0;
    $order->buktibayar = "";
    $order->keterangan = "";
    $order->save();

    if($order->grand_total!=0){
      /* diremark 04 04 20, karena salah harusnya beli pertama kali ngga berubah $user->valid_until = new DateTime('+0 days');
      $user->save();*/
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
        if (!is_null($user->wa_number)){
            $message = null;
            $message .= '*Hi '.$user->name.'*,'."\n\n";
            $message .= "Berikut info pemesanan Omnilinkz :\n";
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
    } 
    else {
      $order->status = 2;
      $order->save();

      if(substr($order->package,0,5) === "Pro"){
        if($order->package=='Pro Monthly'){
          $valid = $this->add_time($user,"+1 months");
        } else if($order->package=='Pro Yearly'){
          $valid = $this->add_time($user,"+12 months");
        }

        $userlog = new UserLog;
        $userlog->user_id = $user->id;
        $userlog->type = 'membership';
        $userlog->value = 'pro';
        $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to pro('.$valid->format('Y-m-d h:i:s').')';
        $userlog->save();

        // $user->valid_until = $valid;
        $user->valid_until = new DateTime('+0 days');
        // $user->membership = 'pro';

      } 
      else if(substr($order->package,0,5) === "Elite"){
        if($order->package=='Elite Monthly'){
          $valid = $this->add_time($user,"+1 months");
        } 
        else if($order->package=='Elite Yearly'){
          $valid = $this->add_time($user,"+12 months");
        }
        /*
        else if($order->package=='Elite Special 2 Months'){
          $valid = $this->add_time($user,"+2 months");
        }
        else if($order->package=='Elite Special 3 Months'){
          $valid = $this->add_time($user,"+3 months");
        }
        else if($order->package=='Elite Special 5 Months'){
          $valid = $this->add_time($user,"+5 months");
        }
        else if($order->package=='Elite Special 12 Months'){
          $valid = $this->add_time($user,"+12 months");
        }*/

        $userlog = new UserLog;
        $userlog->user_id = $user->id;
        $userlog->type = 'membership';
        $userlog->value = 'elite';
        $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to elite('.$valid->format('Y-m-d h:i:s').')';
        $userlog->save();

        // $user->valid_until = $valid;
        /* diremark 04 04 20, karena salah harusnya beli pertama kali ngga berubah $user->valid_until = new DateTime('+0 days');*/
        // $user->membership = 'elite';
      }

      $user->save();
    }

    if(substr($order->package,0,6) === "Top Up"){
      $poin = $this->cekpoin($order->package);
      $order->jmlpoin = $poin;
      $order->ads_id = $ads->id;
  
      $order->save();
    }

    return view('pricing.thankyou')->with(array(
              'order'=>$order,    
            ));
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

  //klo dilunasi lewat admin page
  public function confirm_order(Request $request){
    //konfirmasi pembayaran admin
    $order = Order::find($request->id);
    $order->status = 2;
    
    $user = User::find($order->user_id);
    $valid=null;
    $type = "";
    
    /*
      'Pro' => 195000, //30hari
      'Popular' => 395000, //90hari
      'Elite' => 695000, //180 hari
      'Super' => 1095000, //360 hari
    */
    if(substr($order->package,0,5) === "Pro"){
      if($order->package=='Pro Monthly'){
        $valid = $this->add_time($user,"+1 months");
      } 
      else if($order->package=='Pro Yearly'){
        $valid = $this->add_time($user,"+12 months");
      }
      else if($order->package=='Pro'){
        $valid = $this->add_time($user,"+1 months");
      }
      $type = "pro";
      $user->membership = 'pro';
    } 
    else if(substr($order->package,0,7) === "Popular"){
      $valid = $this->add_time($user,"+3 months");
      $type="popular";
      $user->membership = 'popular';
    }
    else if(substr($order->package,0,5) === "Elite"){
      if($order->package=='Elite Monthly'){
        $valid = $this->add_time($user,"+1 months");
      } else if($order->package=='Elite Yearly'){
        $valid = $this->add_time($user,"+12 months");
      }
      else if($order->package=='Elite Special 2 Months'){
        $valid = $this->add_time($user,"+2 months");
      }
      else if($order->package=='Elite Special 3 Months'){
        $valid = $this->add_time($user,"+3 months");
      }
      else if($order->package=='Elite Special 6 Months'){
        $valid = $this->add_time($user,"+6 months");
      }
      else if($order->package=='Elite Special 5 Months'){
        $valid = $this->add_time($user,"+5 months");
      }
      else if($order->package=='Elite Special 12 Months'){
        $valid = $this->add_time($user,"+12 months");
      }
      else if($order->package=='Elite'){
        $valid = $this->add_time($user,"+6 months");
      }
      $type = "elite";
      $user->membership = 'elite';
    }
    else if(substr($order->package,0,5) === "Super"){
      $valid = $this->add_time($user,"+12 months");
      $type="super";
      $user->membership = 'super';
    }
    
    if($valid <> null){
        $formattedDate = $valid->format('Y-m-d H:i:s');
    }

    $userlog = new UserLog;
    $userlog->user_id = $user->id;
    $userlog->type = 'membership';
    $userlog->value = $type;
    $userlog->keterangan = 'Confirm Order '.$order->package.'. From '.$user->membership.'('.$formattedDate.') to '.$type.'('.$formattedDate.')';
   // $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to '.$type.'('.$formattedDate.')';
    $userlog->save();

    $user->valid_until = $valid;
    $user->is_member = 1;
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
    $arr['response'] = $this->IsPay($user->email,17,1);

    return $arr;
  }

  private function IsPay($email,$list_id,$is_pay){
    $curl = curl_init();
    $data = array(
        'email'=>$email,
        'list_id'=>$list_id,
        'is_pay'=>$is_pay
    );

    if(env('APP_ENV') == 'local')
    {
      $url = 'http://192.168.88.177/wa-project/is_pay';
    }
    else
    {
      $url = 'https://activwa.com/dashboard/is_pay';
    }
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTREDIR => 3,
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $response = json_decode($response,true);
      return $response['response'];
    }
  }

  
/* end class */
}
