<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\CustomerActivwa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function migrate_to_activwa()
    {
      $users = User::whereNotNull('wa_number')->get();
      foreach ($users as $user){
        $wa_number = $user->wa_number;
        if(substr($user->wa_number,0,3) === "+62"){
          $wa_number = str_replace("+62","62",$user->wa_number);
        }
        if(substr($wa_number,0,2) != "62"){
          // $sentences = $wa_number;
          // $string = '62';
          // $position = 0;

          // $wa_number = substr_replace( $sentences, $string, $position, 0 );
          $wa_number = "62".$wa_number;
        }

        $customer = new CustomerActivwa();
        $customer->user_id = 3;
        $customer->list_id = 17;
        $customer->name = $user->name;
        $customer->email = $user->email;
        $customer->wa_number = $wa_number;
        $customer->additional = null;
        $customer->status = 1;
        $customer->save();
      }
      return "success";
    }
}
