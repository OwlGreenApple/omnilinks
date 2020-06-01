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

use Carbon, Crypt, Mail, DateTime, Auth;

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
      // 'membership' => 'free',
      'membership' => 'popular',
      'wa_number' => '62'.$data['wa_number'],
    ]);

    $order = null;
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

      //unique code 
      $unique_code = mt_rand(1, 1000);
      
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
      $order->total = $data["price"] + $unique_code;
      $order->discount = $diskon;
      $order->grand_total = $data['price'] - $diskon + $unique_code;
      $order->status = 0;
      $order->buktibayar = "";
      $order->keterangan = "";
      $order->save();
      
      if($order->grand_total!=0){
        $user->valid_until = new DateTime('+7 days');
        $user->save();

        $emaildata = [
            'order' => $order,
            'user' => $user,
            'nama_paket' => $data['namapaket'],
            'no_order' => $order_number,
        ];
      
        Mail::send('emails.order', $emaildata, function ($message) use ($user,$order_number) {
          $message->from('no-reply@omnilinks.com', 'Michael from Activomni');
          $message->to($user->email);
          $message->subject('[Omnilink] Order Nomor '.$order_number);
        });
      } 
      else {
        $order->status = 2;
        $order->save();
        $type="";

        if(substr($order->package,0,5) === "Pro"){
          if($order->package=='Pro Monthly'){
            $valid = $ordercont->add_time($user,"+1 months");
          } else if($order->package=='Pro Yearly'){
            $valid = $ordercont->add_time($user,"+12 months");
          }
          else if($order->package=='Pro'){
            $valid = $this->add_time($user,"+1 months");
          }
          $type="pro";
          $user->membership = 'pro';

        } 
        else if(substr($order->package,0,7) === "Popular"){
          $valid = $this->add_time($user,"+3 months");
          $type="popular";
          $user->membership = 'popular';
        }
        else if(substr($order->package,0,5) === "Elite"){
          if($order->package=='Elite Monthly'){
            $valid = $ordercont->add_time($user,"+1 months");
          } else if($order->package=='Elite Yearly'){
            $valid = $ordercont->add_time($user,"+12 months");
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
        $userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$formattedDate.') to '.$type.'('.$formattedDate.')';
        //$userlog->keterangan = 'Order '.$order->package.'. From '.$user->membership.'('.$user->valid_until.') to '.$type.'('.$valid->format('Y-m-d h:i:s').')';
        $userlog->save();

        $user->valid_until = $valid;
        $user->save();
        // $user->valid_until = new DateTime('+0 days');
        // $user->valid_until = Carbon::now();
      }

    } 
    else {
      $user->valid_until = new DateTime('+7 days');
      $user->save();
    }

    // return $user;
    return [
      "user"=>$user,
      "order"=>$order,
    ];

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

    $request->wa_number = "62".$request->wa_number;
    $is_error = false;
    $error_message = "";
    if(!is_numeric($request->wa_number)){
      $is_error = true;
      $error_message = "No WA harus angka";
    }
    if(!preg_match("/^628+[0-9]/i",$request->wa_number)){
      $is_error = true;
      $error_message = "No WA Tidak Valid";
    }
    if ($is_error) {
      $request->session()->flash('error', $error_message);
      return view('auth.register')->with(array(
        "price"=>$request->price,
        "namapaket"=>$request->namapaket,
        "coupon_code"=>$request->kupon,
        "idpaket" => $request->idpaket,
      ));
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
      $arrRet = $this->create($arrRequest);

      $register_time = Carbon::now()->toDateTimeString();
      $confirmcode = Hash::make($arrRet['user']->email.$register_time);
      $arrRet['user']->confirm_code = $confirmcode;
      $arrRet['user']->save();
      
      $string = '';
      if($request->price == null)
      {
      }

      $secret_data = [
        'email' => $arrRet['user']->email,
      //   'register_time' => $register_time,
       'confirm_code' => $confirmcode,
      ];
    
      $emaildata = [
        'url' => url('/verifyemail/').'/'.Crypt::encrypt(json_encode($secret_data)),
        'user' => $arrRet['user'],
        // 'password' => $request->password,
        'password' => $password,
       'price' => $request->price,
       'coupon_code' => $string,
      ];
      
      Mail::to($arrRet['user']->email)->send(new ConfirmEmail($emaildata));

      Auth::loginUsingId($arrRet['user']->id);

      if ($request->price <> null) {
        return view('pricing.thankyou')->with(array(
              'order'=>$arrRet['order'],    
            ));
      } else {
				//old system
        // $temp = $this->sendToActivWA($arrRequest['wa_number'],$arrRequest['name'],$arrRequest['email']);
				//New system, to activrespon list
				if(env('APP_ENV') <> 'local'){
					$temp = $this->sendToActivrespon($arrRequest['wa_number'],$arrRequest['name'],$arrRequest['email']);
				}
				
        // return redirect('/login')->with("successfree", "Thank you for your registration. Please check your inbox to verify your email address.");
        return redirect('/')->with("success", "Thank you for your registration. Please check your inbox to verify your email address.");
        // return view('pricing.thankyou-register')->with(array(
              // 'order'=>$arrRet['order'],    
              // 'coupon_code' => $string,
            // ));
      }
    } else {
      // return redirect("register")->with("error",$validator->errors()->first());
      $request->session()->flash('error', $validator->errors()->first());
      return view('auth.register')->with(array(
        "price"=>$request->price,
        "namapaket"=>$request->namapaket,
        "coupon_code"=>$request->kupon,
        "idpaket" => $request->idpaket,
      ));
      
    }
  }

  public function sendToActivrespon($wa_no,$name,$email)
  {
    $curl = curl_init();

      $data = array(
          'list_name'=>'o2ma0rl5',
          'name'=>$name,
          'email'=>$email,
          'phone_number'=>$wa_no,
      );

		 $url = "https://activrespon.com/dashboard/entry-google-form";

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
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

      /* if ($err) {
        echo "cURL Error #:" . $err;
       } else {
         echo $response."\n";
       }
       */
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

      if(env('APP_ENV') == 'local')
      {
         $url = "http://192.168.88.177/wa-project/private-list";
      }
      else
      {
         $url = "https://activwa.com/dashboard/private-list";
      }

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
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

      /* if ($err) {
        echo "cURL Error #:" . $err;
       } else {
         echo $response."\n";
       }
       */
  }

/**/  
}
