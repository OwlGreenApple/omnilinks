<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifClickFreeUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $emaildata;
    protected $user;
    protected $clicks;

    public function __construct($emaildata,$user,$clicks)
    {
        $this->emaildata = $emaildata;
        $this->user = $user;
        $this->clicks = $clicks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@omnilinkz.com', 'Omnilinkz')
                  ->subject('[Omnilinkz] Notif Click Free User')
                  ->view('emails.notifclick-free-user')
                  ->with('user',$this->user)
                  ->with('clicks',$this->clicks)
                  ->with($this->emaildata);
    }
}
