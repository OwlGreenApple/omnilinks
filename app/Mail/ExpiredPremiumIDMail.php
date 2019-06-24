<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpiredPremiumIDMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $emaildata;
    protected $user;

    public function __construct($emaildata,$user)
    {
        $this->emaildata = $emaildata;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@omnilinkz.com', 'Omnilinkz')
                  ->subject('[Omnilinkz] Premium ID')
                  ->view('emails.expired-premiumid')
                  ->with('user',$this->user)
                  ->with($this->emaildata);
    }
}
