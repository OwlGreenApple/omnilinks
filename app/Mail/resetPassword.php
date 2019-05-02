<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class resetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
      protected $token;
    public function __construct($token)
    {
           $this->token = url('/password/reset/'.$token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('omnilinks@gmail.com', 'Omnilinks')
        ->subject('[Omnilinks] Reset Password')
        ->view('emails.forgot-password')
        ->with('linkReset',$this->token);
    }
}
