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

    public function __construct($user,$order)
    {
      $this->user = $user;
      $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('no-reply@omnilinkz.com', 'Omnilinkz')
                  ->subject('[Omnilinkz] Email Reminder Setelah Order')
                  ->view('emails.notif-order-user')
                  ->with([
                    'user'=>$this->user,
                    'order'=>$this->order,
                  ]);
                  // ->with($this->user->email);

    }

}
