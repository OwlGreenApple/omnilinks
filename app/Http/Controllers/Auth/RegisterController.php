<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\UserLog;
use App\Order;
use App\Coupon;
use App\Mail\ConfirmEmail;

use App\Helpers\Helper;
use App\Http\Controllers\OrderController;

use Carbon, Crypt, Mail, DateTime;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = '/login';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'name' => ['required', 'string', 'max:255'],
      // 'password' => ['required', 'string', 'min:6'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function create(array $data)
  {       
    $ordercont = new OrderController;

    //create user register
    $user = User::create([
      'email' => $data['email'],
      'name' => $data['name'],
      'gender'=> $data['gender'],
      // 'username'=> $data['username'],
      'username'=> $data['email'],
      'password' => Hash::make($data['password']),
      'membership' => 'free',
      'wa_number' => $data['wa_number'],
    ]);

    #IF ORDER IS NOT FREE
    if ($data['price']<>"") 
    {
      $diskon = 0;
      // $total = $data['price'];
      $kuponid = null;
      if($data['kupon']!='')
      {
        $arr = $ordercont->cek_kupon($data['kupon'],$data['price'],$data['idpaket']);

        if($arr['status']=='error'){
          return redirect("checkout/1")->with("error", $arr['message']);
        } else {
          // $total = $data['price'];
          $diskon = $arr['diskon'];
          if($arr['coupon']!=null){
            $kuponid = $arr['coupon']->id;
          }
        }
      }

      //create order 
      $dt = Carbon::now();
      $order = new Order;
      $str = 'OML'.$dt->format('ymdHi');
      $order_number = Helper::autoGenerateID($order, 'no_order', $str, 3, '0');
      $order->no_order = $order_number;
      $order->user_id = $user->id;
      $order->package = $data["namapaket"];
      $order->jmlpoin = 0;
      $order->coupon_id = $kuponid;
      $order->total = $data["price"];
      $order->discount = $diskon;
      $order->grand_total = $data['price'] - $diskon;
      $order->status = 0;
      $order->buktibayar = "";
      $order->keterangan = "";
      $order->save();
      
      if($order->grand_total!=0){
        $emaildata = [
            'order' => $order,
            'user' => $user,
            'nama_paket' => $data['namapaket'],
            'no_order' => $order_number,
        ];
      
        Mail::send('emails.order', $emaildata, function ($message) use ($user,$order_number) {
          $message->from('no-reply@omnilinks.com', 'Omnilinks');
          $message->to($user->email);
          $message->subject('[Omnilink] Order Nomor '.$order_number);
        });
      } else {
        $order->status = 2;
        $order->save();

        if(substr($order->package,0,5) === "Basic"){
          if($order->package=='Basic Monthly'){
            $valid = $ordercont->add_time($user,"+1 months");
          } else if($order->package=='Basic Yearly'){
            $valid = $ordercont->add_time($user,"+12 months");
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
            $valid = $ordercont->add_time($user,"+1 months");
          } else if($order->package=='Elite Yearly'){
            $valid = $ordercont->add_time($user,"+12 months");
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

    } else {
      $user->valid_until = new DateTime('+30 days');
      $user->save();
    }

    return $user;

  }

  public function register(Request $request)
  {
    //dd($request->all());
    
    $ordercont = new OrderController;
    if($request->price<>""){
      $stat = $ordercont->cekharga($request->namapaket,$request->price);
      if($stat==false){
        return redirect("checkout/1")->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
      }
    }

    $validator = $this->validator($request->all());
    if(!$validator->fails()) {
      //random password
      $pas = $request->email.$request->name;
      $gh = substr($pas, 0,6);
      $chrnd =substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
      $password = str_replace(' ','', $gh.$chrnd);
      
      $arrRequest = $request->all();
      $arrRequest['password'] = $password;
      $user = $this->create($arrRequest);

      $register_time = Carbon::now()->toDateTimeString();
      $confirmcode = Hash::make($user->email.$register_time);
      $user->confirm_code = $confirmcode;
      $user->save();
      
      $string = '';
      if ($request->price<>"") 
      {
        // return redirect('thankyou');
      } else {
        // return redirect('/login')->with("successfree", "Thank you for your registration. Please check your inbox to verify your email address.");
        //klo free user dibuatin kupon diskon 50%, berlaku selama 2x24 jam
        do 
        {
          $karakter= 'abcdefghjklmnpqrstuvwxyz123456789';
          $string = '';
          for ($i = 0; $i < 5 ; $i++) {
            $pos = rand(0, strlen($karakter)-1);
            $string .= $karakter{$pos};
          }
          $coupon = Coupon::where("kodekupon","=",$string)->first();
        } while (!is_null($coupon));
        $coupon = new Coupon;
        $coupon->kodekupon = $string;
        $coupon->diskon_value = 0;
        $coupon->diskon_percent = 50;
        $coupon->valid_until = new DateTime('+3 days');
        $coupon->valid_to = "";
        $coupon->keterangan = "Kupon AutoGenerate Free User";
        $coupon->package_id = 4;
        $coupon->user_id = $user->id;
        $coupon->save();
      }
      

      $secret_data = [
        'email' => $user->email,
      //   'register_time' => $register_time,
       'confirm_code' => $confirmcode,
      ];
    
      $emaildata = [
        'url' => url('/verifyemail/').'/'.Crypt::encrypt(json_encode($secret_data)),
        'user' => $user,
        // 'password' => $request->password,
        'password' => $password,
       'price' => $request->price,
       'coupon_code' => $string,
      ];
      
      Mail::to($user->email)->send(new ConfirmEmail($emaildata));

      if ($request->price<>"") {
        return redirect('thankyou');
      } else {
        $this->sendToActivWA($arrRequest['wa_number'],$arrRequest['name'],$arrRequest['email']);
        return redirect('/login')->with("successfree", "Thank you for your registration. Please check your inbox to verify your email address.");
      }
    } else {
      return redirect("register")->with("error",$validator->errors()->first());
    }
  }

  public function sendToActivWA($wa_no,$name,$email)
    {
      $curl = curl_init();

        $data = array(
            'list_id'=> 17, //activwa list_id for omnilinkz
            'wa_no'=>$wa_no,
            'name'=>$name,
            'email'=>$email
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://activwa.com/dashboard/private-list",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response."\n";
        }
    }

/**/  
}
