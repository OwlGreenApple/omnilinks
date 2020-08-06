<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Coupon;

use DateTime;

class NotifOrderUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $order;
    protected $interval;

    public function __construct($user,$order,$interval)
    {
      $this->user = $user;
      $this->order = $order;
      $this->interval = $interval;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      if ($this->interval==5) {
        return $this->from('info@omnilinkz.com', 'Michael from Activomni')
                  ->subject('[Omnilinkz] Jangan Sampai Diskonmu Gak Berlaku Lagi, Konfirmasi Sekarang')
                  ->view('emails.notif-order-user-2')
                  ->with([
                    'user'=>$this->user,
                    'order'=>$this->order,
                  ]);
                  // ->with($this->user->email);
      }
      if ($this->interval==1) {
        return $this->from('info@omnilinkz.com', 'Michael from Activomni')
                  ->subject('[Omnilinkz] Kamu Lupa ya? Orderan Kamu Lagi Nunggu di Konfirmasi nih!')
                  ->view('emails.notif-order-user')
                  ->with([
                    'user'=>$this->user,
                    'order'=>$this->order,
                  ]);
                  // ->with($this->user->email);
      }
    }

}
