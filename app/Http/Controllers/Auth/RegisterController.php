<?php

namespace App\Http\Controllers\Auth;
use App\Helpers\Helper;
use App\User;
use App\Order;
use App\Mail\Confirm_Email;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon, Crypt, Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Illuminate\Http\Request;
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
        ]);
        if ($data['price']<>"") 
        {
            //create order 
            $dt = Carbon::now();
            $order = new Order;
            $str = 'OMNILI'.$dt->format('ymdHi');
            $order_number = Helper::autoGenerateID($order, 'no_order', $str, 3, '0');
            $order->no_order = $order_number;
            $order->userid = $user->id;
            $order->package = $data["namapaket"];
            //$order->jmlpoin = 0;
            $order->coupon=0;
            $order->total = $data['price'];
            $order->discount = 0;
            $order->status = 0;
            $order->level=0;
            $order->bukti_bayar = "";
            $order->keterangan = "";
            $order->save();
            
            //return view('pricing.thankyou');
            // // //mail order to user 
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
          return $user;

    }

          public function post_register(Request $request)
          {
            
            }
    public function register(Request $request)
    {
        //dd($request->all());
        $validator = $this->validator($request->all());
        if(!$validator->fails()) {
           $user = $this->create($request->all());
           
            $register_time = Carbon::now()->toDateTimeString();
            $confirmcode = Hash::make($user->email.$register_time);
            $user->confirm_code = $confirmcode;
            $user->save();
            
           // $this->check_history($user);
    
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

             return redirect('/login')->with("success", "Thank you for your registration. Please check your inbox to verify your email address.");
          } else {
            return redirect("register")->with("error",$validator->errors()->first());
          }
         
    }
}
