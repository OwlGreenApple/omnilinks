<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResendConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emaildata)
    {
        $this->emaildata = $emaildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@omnilinkz.com', 'Omnilinkz')
                  ->subject('[Omnilinkz] Confirmation Email')
                  ->view('emails.resend-confirm-email')
                  ->with($this->emaildata);
    }
}
