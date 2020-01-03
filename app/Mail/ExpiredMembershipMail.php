<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Coupon;

use DateTime;

class ExpiredMembershipMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $interval;

    public function __construct($user,$interval)
    {
      $this->user = $user;
      $this->interval = $interval;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      if ($this->interval==5){
        return $this->from('no-reply@omnilinkz.com', 'Omnilinkz')
                  ->subject('[Omnilinkz] Membership tinggal 5 hari lagi nih, nggak berasa yah')
                  ->view('emails.expired-membership.notif-1')
                  ->with([
                    'user'=>$this->user,
                  ])
                  ->with($this->user->email);
      }
      if ($this->interval==1){
        $coupon = $this->create_coupon();
        return $this->from('no-reply@omnilinkz.com', 'Omnilinkz')
                  ->subject('[Omnilinkz] Service Omnilinkz.Com akan berakhir')
                  ->view('emails.expired-membership.notif-2')
                  ->with([
                    'user'=>$this->user,
                    'coupon'=>$coupon,
                    'days_coupon'=>3,
                  ])
                  ->with($this->user->email);
      }
      if ($this->interval==-1){
        $coupon = Coupon::where('user_id',$this->user->id)
                  ->where("valid_to","expired-membership")
                  ->orderBy("id","desc")
                  ->first();
        if (is_null($coupon)) {
          $coupon = $this->create_coupon();
        }
        return $this->from('no-reply@omnilinkz.com', 'Omnilinkz')
                  ->subject('[Omnilinkz] Hari ini terakhir penggunaan coupon order anda')
                  ->view('emails.expired-membership.notif-3')
                  ->with([
                    'user'=>$this->user,
                    'coupon'=>$coupon,
                  ])
                  ->with($this->user->email);
      }
    }

    public function create_coupon()
    {
      do 
      {
        $karakter= 'abcdefghjklmnpqrstuvwxyz123456789';
        $string = 'promo-';
        for ($i = 0; $i < 7 ; $i++) {
          $pos = rand(0, strlen($karakter)-1);
          $string .= $karakter{$pos};
        }
        $coupon = Coupon::where("kodekupon","=",$string)->first();
      } while (!is_null($coupon));

      $coupon = new Coupon;
      $coupon->kodekupon = $string;
      $coupon->diskon_value = 0;
      $coupon->diskon_percent = 10;
      $coupon->valid_until = new DateTime('+3 days');
      $coupon->valid_to = "expired-membership";
      $coupon->keterangan = "Kupon AutoGenerate Expired Membership";
      $coupon->package_id = 0;
      $coupon->user_id = $this->user->id;
      $coupon->save();
      return $coupon;
    }
}
