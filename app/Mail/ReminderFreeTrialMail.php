<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Coupon;

use DateTime;

class ReminderFreeTrialMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $kodekupon;

    public function __construct($user,$kodekupon)
    {
      $this->user = $user;
      $this->kodekupon = $kodekupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('no-reply@omnilinkz.com', 'Michael from Activomni')
                  ->subject('[Omnilinkz] Cara Sederhana Ini bisa membuat Produkmu Laku Keras ')
                  ->view('emails.reminder-free-trial')
                  ->with([
                    'user'=>$this->user,
                    'kodekupon'=>$this->kodekupon,
                  ]);
    }
}
