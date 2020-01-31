<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Coupon;
use Illuminate\Http\Request;
use Crypt, Carbon ;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    protected function authenticated(Request $request, $user)
    {
      $now = Carbon::now();
      if (is_null($user->valid_until)) {
        $date = Carbon::now()->addDays(999);
      }
      else {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->valid_until);
      }
      $interval = $now->diffInDays($date,false);
      if( ($interval<=3) && ($interval>=1) && (!$user->is_member) ){
        $coupon = Coupon::
                  where("user_id",$user->id)
                  ->where("valid_to","package-elite-3")
                  ->first();
        if (!is_null($coupon)){
          return view('pricing.thankyou-register')->with(array(
              'coupon_code' => $coupon->kodekupon,
          ));
        }
      }

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
}
