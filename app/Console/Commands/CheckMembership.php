<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Order;
use App\Coupon;
use App\UserLog;
use App\Page;
use App\Link;
use App\PremiumID;
use App\Helpers\Helper;

use App\Mail\ExpiredMembershipMail;
use App\Mail\ExpiredPremiumIDMail;
use App\Mail\ReminderFreeTrialMail;

use Mail,DateTime,Carbon;

class CheckMembership extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:membership';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Membership Valid Until';

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
      // $users = User::
                // where("is_confirm",1)
                // ->get();
      $users = User::all();

      foreach ($users as $user) {
        $now = Carbon::now();
        if (is_null($user->valid_until)) {
          $date = Carbon::now()->addDays(999);
        }
        else {
          $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->valid_until);
        }
        $interval = $now->diffInDays($date,false);
        // var_dump($user->email);
        // var_dump($interval);
        //klo member, maka akan diingatkan
        if ($user->is_member){
          if( ($interval==5) || ($interval==1) || ($interval==-1) ){
            if(env('MAIL_HOST')=='smtp.mailtrap.io'){
              sleep(2);
            }
            Mail::to($user->email)->queue(new ExpiredMembershipMail($user,$interval));
            if (!is_null($user->wa_number)){
              if ($interval == 5) {
                $message = null;
                $message .= "*Selamat ".$user->name.",* \n\n";
                $message .= "Gimana kabarnya? \n \n";
                $message .= "Kami mau kasih tau kalau *waktu berlangganan kamu akan habis 5 hari lagi*. \n \n";
                $message .= "Jangan sampai kamu _kehabisan waktu berlangganan saat menggunakan Omnilinkz_ yah \n \n";
                $message .= "Kamu bisa langsung perpanjang dengan klik link dibawah ini \n";
                $message .= "*►https://omnilinkz.com/dashboard/pricing* \n \n";

                $message .= "_Oh iya, kalau kamu pertanyaan jangan ragu untuk menghubungi kami di_  \n";
                $message .= "*WA 0817-318-368* \n\n";

                $message .= 'Terima Kasih,'."\n\n";
                $message .= 'Team Omnilinkz'."\n";
                $message .= '_*Omnilinkz is part of Activomni.com_';
                Helper::send_message_queue_system($user->wa_number,$message);
              }
              else if ($interval == 1) {
                $message = null;
                $message .= "Gawat ".$user->name."!, \n\n";
                $message .= "*Waktu berlangganan Omnilinkzmu tinggal satu hari*. \n \n";
                $message .= "*Perpanjang sekarang juga*, _sebelum waktu berlanggananmu habis ditengah jalan saat menggunakan Omnilinkz._ \n\n";
                $message .= "Klik Sekarang di *►https://omnilinkz.com/dashboard/pricing* \n\n";
                $message .= 'Terima Kasih,'."\n\n";
                $message .= 'Team Omnilinkz'."\n";
                $message .= '_*Omnilinkz is part of Activomni.com_';
                Helper::send_message_queue_system($user->wa_number,$message);
              }
              else if ($interval == -1) {
                $message = null;
                $message .= "*Hi ".$user->name.",* \n\n";
                $message .= "Kami mau mengingatkan kalau *waktu berlangganan kamu sudah habis sejak kemarin*. \n \n";
                $message .= "_Jangan sampai hubungan dengan klienmu jadi terhambat karena waktu berlangganan yang habis ya_ \n \n";
                $message .= "*Klik sekarang di ► https://omnilinkz.com/dashboard/pricing* \n \n";
                $message .= "Kalau ada pertanyaan, jangan sungkan menghubungi kami di \n";
                $message .= "*WA 0817-318-368* \n \n";
                
                $message .= 'Terima Kasih,'."\n\n";
                $message .= 'Team Omnilinkz'."\n";
                $message .= '_*Omnilinkz is part of Activomni.com_';
                Helper::send_message_queue_system($user->wa_number,$message);
              }
            }
          }
          
          
          //check premium id 
          if($interval==5){
            $pages = Page::where('user_id',$user->id)
                        ->where('premium_id','!=',0)
                        ->get();

            if(!is_null($pages)){
                foreach ($pages as $page) {
                    $page->premium_id = 0;
                    $page->premium_names = null;
                    $page->save();
                }
            }

            $links = Link::where('users_id',$user->id)
                        ->where('premium_id','!=',0)
                        ->get();

            if(!is_null($links)){
                foreach ($links as $link) {
                    $link->premium_id = 0;
                    $link->premium_names = null;
                    $link->save();
                }
            }

            $premiumid = PremiumID::where('user_id',$user->id);

            if($premiumid->exists()){
              $premiumid->delete();
              Mail::to($user->email)->queue(new ExpiredPremiumIDMail($user->email,$user));
            }

            //$user->valid_until = null;
            //$user->save();
          }

        }
        //klo blm member, maka ditawari untuk beli kupon
        else {
          $order = Order::where('user_id',$user->id)->first();
          if ($interval==1 && is_null($order)) {
            //dibuatin kupon, dikirim email kuponnya 
            do 
            {
              $karakter= 'abcdefghjklmnpqrstuvwxyz123456789';
              $string = 'special-';
              for ($i = 0; $i < 7 ; $i++) {
                $pos = rand(0, strlen($karakter)-1);
                $string .= $karakter[$pos];
              }
              $coupon = Coupon::where("kodekupon","=",$string)->first();
            } while (!is_null($coupon));

            $coupon = new Coupon;
            $coupon->kodekupon = $string;
            $coupon->diskon_value = 0;
            $coupon->diskon_percent = 0;
            $coupon->valid_until = new DateTime('+2 days');
            // $coupon->valid_to = "package-elite-3";
            $coupon->valid_to = "package-elite-2";
            $coupon->keterangan = "Kupon AutoGenerate Free User";
            $coupon->package_id = 0;
            $coupon->user_id = $user->id;
            $coupon->save();

            Mail::to($user->email)->queue(new ReminderFreeTrialMail($user,$string));
            /*if (!is_null($user->wa_number)){
              $message = null;
              $message .= '*Hi '.$user->name.'*,'."\n\n";
              $message .= "*Yakin bisa rela?* Hari ini kamu *bakal kehilangan harga spesial* yang sudah kamu dapatkan 5 hari lalu ketika order Omnilinkz lhoo. \n \n";
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
            }*/
          }
         /* else if ($interval==2 && is_null($order)) {
            $coupon = Coupon::
                      where('user_id',$user->id)->first();
            if (!is_null($coupon)){
              Mail::to($user->email)->queue(new ReminderFreeTrialMail($user,$string));
              
              if (!is_null($user->wa_number)){
                $message = null;
                $message .= '*Hi '.$user->name.'*,'."\n\n";
                $message .= "*Yakin bisa rela?* Hari ini kamu *bakal kehilangan harga spesial* yang sudah kamu dapatkan 5 hari lalu ketika order Omnilinkz lhoo. \n \n";
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
            }
          }*/
        }

        if($date < $now and $user->membership!='free'){
          $userlog = new UserLog;
          $userlog->user_id = $user->id;
          $userlog->type = 'membership';
          $userlog->value = $user->membership;
          $userlog->keterangan = 'Cron check membership, user jadi free';
          $userlog->save();

          $user->membership = 'free';
          //$user->valid_until = null;
          $user->save();
          
          //pages themes dibalikin jadi solid #fff
          /* page dikasi pop up, tapi settingan tetap sama $pages = Page::where('user_id',$user->id)
                      ->get();
          if(!is_null($pages)){
            foreach ($pages as $page) {
              //default value
              $page->is_outlined=1;
              $page->outline="#000";
              $page->is_bio_color=1;
              $page->bio_color="#000";
              $page->color_picker="#fff";
              $page->save();
            }
          }*/
          
        }
      }
    }
}
