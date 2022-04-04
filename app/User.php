<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

use App\Mail\resetPassword;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','password','gender','username','membership','valid_until','wa_number','is_valid_email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* 
        is_invalid_email:
        0 == belum di cek
        1 == valid
        2 == kuota email verify (bulkmail) habis
        3 == invalid
    */

    public function sendPasswordResetNotification($token)
    {
        $helper = new Helper;
        if($helper->check_email_bouncing($this->email) == true)
        {
            Mail::to($this->email)->bcc("celebgramme.dev@gmail.com")->queue(new resetPassword($token));
            return redirect('/password/reset')->with("success","We have e-mailed your password reset link!"); 
        }
        else
        {
            return redirect('/password/reset')->with("error","Your email is invalid"); 
        }
    }
}
