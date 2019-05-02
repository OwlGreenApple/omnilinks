<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Order;
use App\Mail\Confirm_Email;

use App\Helpers\Helper;
use App\Http\Controllers\OrderController;

use Carbon, Crypt, Mail;

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
    protected $redirectTo = '/home';

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
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
       
        $user = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'gender'=> $data['gender'],
            'username'=> $data['username'],
            'password' => Hash::make($data['password']),
            'membership' => 'free',
        ]);

        if ($data['price']<>"") 
        {
            $ordercont = new OrderController;

            $diskon = 0;
            $total = $data['price'];
            $kuponid = null;
            if($data['kupon']!=''){
              $arr = $ordercont->cek_kupon($data['kupon'],$data['price'],$data['idpaket']);

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

            //create order 
            $dt = Carbon::now();
            $order = new Order;
            $str = 'OML'.$dt->format('ymdHi');
            $order_number = Helper::autoGenerateID($order, 'no_order', $str, 3, '0');
            $order->no_order = $order_number;
            $order->user_id = $user->id;
            $order->package = $data["namapaket"];
            //$order->jmlpoin = 0;
            $order->coupon_id = $kuponid;
            $order->total = $data["price"];
            $order->discount = $diskon;
            $order->grand_total = $total;
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
            }
          }
          return $user;

    }

    public function register(Request $request)
    {
        //dd($request->all());
        $validator = $this->validator($request->all());

        $ordercont = new OrderController;
        if($request->price<>""){
          $stat = $ordercont->cekharga($request->namapaket,$request->price);
          if($stat==false){
            return redirect("checkout/1")->with("error", "Paket dan harga tidak sesuai. Silahkan order kembali.");
          }
        }

        if(!$validator->fails()) {
           $user = $this->create($request->all());
           
            $register_time = Carbon::now()->toDateTimeString();
            $confirmcode = Hash::make($user->email.$register_time);
            $user->confirm_code = $confirmcode;
            $user->save();
            
            $secret_data = [
              'email' => $user->email,
            //   'register_time' => $register_time,
             'confirm_code' => $confirmcode,
            ];
          
            $emaildata = [
              'url' => url('/verifyemail/').'/'.Crypt::encrypt(json_encode($secret_data)),
              'user' => $user,
              'password' => $request->password,
            ];
            
             Mail::to($user->email)->send(new Confirm_Email($emaildata));

            if ($request->price<>"") {
              return redirect('thankyou');
            } else {
              return redirect('/login')->with("success", "Thank you for your registration. Please check your inbox to verify your email address.");
            }
          } else {
            return redirect("register")->with("error",$validator->errors()->first());
          }
         
    }
}
