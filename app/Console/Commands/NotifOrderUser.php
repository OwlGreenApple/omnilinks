<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Order;
use App\UserLog;
use App\Page;
use App\Link;
use App\PremiumID;
use App\Helpers\Helper;

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
        if( ($interval==3) && ($user->membership!='free') ){
          if(env('MAIL_HOST')=='smtp.mailtrap.io'){
            sleep(2);
          }
          $order->is_notif_2 = 1;
          $order->is_notif_1 = 1;
          $order->save();

          $helper = new Helper;
          if($helper->check_email_bouncing($user->email) == true)
          {
            Mail::to($user->email)->queue(new NotifOrderUserMail($user,$order,$interval));
          }

          if (!is_null($user->wa_number)){
            $message = null;
            $message .= '*Hi '.$user->name.'*,'."\n\n";
            $message .= "*Yakin bisa rela?* Hari ini kamu *bakal kehilangan harga spesial* yang sudah kamu dapatkan 3s hari lalu ketika order Omnilinkz lhoo. \n \n";
            $message .= "_Ini rinciannya :_ \n \n";
            $message .= '*No Order :* '.$order->no_order.''."\n";
            $message .= '*Nama :* '.$user->name.''."\n";
            $message .= '*Paket :* '.$order->package.''."\n";
            $message .= '*Total Biaya :*  Rp. '.str_replace(",",".",number_format($order->grand_total))."\n";

            $message .= "Silahkan melakukan pembayaran dengan bank berikut : \n\n";
            $message .= 'BCA (Sugiarto Lasjim)'."\n";
            $message .= '8290-812-845'."\n\n";

            $message .= "Buruan transfer dan konfirmasi sekarang karena kalau tidak, _pembelian mu akan dihapus jam 12 malam nanti oleh sistem_. *Kamu juga akan kehilangan kesempatan memiliki Omnilinkz dengan harga spesial.* \n\n";

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
          continue;
        }

        if( ($interval==1) && ($user->membership!='free') ){
          if(env('MAIL_HOST')=='smtp.mailtrap.io'){
            sleep(2);
          }
          $order->is_notif_1 = 1;
          $order->save();

          $helper = new Helper;
          if($helper->check_email_bouncing($user->email) == true)
          {
            Mail::to($user->email)->queue(new NotifOrderUserMail($user,$order,$interval));
          }
          
          if (!is_null($user->wa_number)){
            $message = null;
            $message .= '*Hi '.$user->name.'*,'."\n\n";
            $message .= "_Gimana kabarnya?_ \n";
            $message .= "Kami mau mengingatkan nih kalau kamu *belum melakukan transfer dan konfirmasi pembayaran*. \n \n";
            $message .= "_Kemarin kamu sudah membeli paket Omnilinkz, ini rinciannya :_ \n \n";
            $message .= '*No Order :* '.$order->no_order.''."\n";
            $message .= '*Nama :* '.$user->name.''."\n";
            $message .= '*Paket :* '.$order->package.''."\n";
            $message .= '*Total Biaya :*  Rp. '.str_replace(",",".",number_format($order->grand_total))."\n";

            $message .= "Silahkan melakukan pembayaran dengan bank berikut : \n\n";
            $message .= 'BCA (Sugiarto Lasjim)'."\n";
            $message .= '8290-812-845'."\n\n";

            $message .= "_Buruan transfer dan konfirmasi agar pembelianmu tidak dihapus oleh sistem._\n\n";

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


      }
    }
}
