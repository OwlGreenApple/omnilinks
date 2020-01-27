<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Order;
use App\UserLog;
use App\Page;
use App\Link;
use App\PremiumID;

use App\Mail\NotifOrderUserMail;

use Mail,DateTime,Carbon;

class NotifOrderUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:orderuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and notif order user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $orders = Order::
                where("is_notif_1",0)
                ->orWhere("is_notif_2",0)
                ->where('status',"<>",2)
                ->get();
      // $users = User::where('id',3)->get();

      foreach ($orders as $order) {
        $user = User::find($order->user_id);
        if (is_null($user)){
          continue;
        }
        
        $now = Carbon::now();
        if (is_null($order->created_at)) {
          $date = Carbon::now()->addDays(999);
        }
        else {
          $date = Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at);
        }
        $interval = $date->diffInDays($now,false);
        // var_dump($user->email);
        // var_dump($interval);
        if( ($interval==5) && ($user->membership=='free') ){
          if(env('MAIL_HOST')=='smtp.mailtrap.io'){
            sleep(2);
          }
          $order->is_notif_2 = 1;
          $order->is_notif_1 = 1;
          $order->save();
          Mail::to($user->email)->queue(new NotifOrderUserMail($user,$order,$interval));
          continue;
        }

        if( ($interval==1) && ($user->membership=='free') ){
          if(env('MAIL_HOST')=='smtp.mailtrap.io'){
            sleep(2);
          }
          $order->is_notif_1 = 1;
          $order->save();
          Mail::to($user->email)->queue(new NotifOrderUserMail($user,$order,$interval));
        }


      }
    }
}
