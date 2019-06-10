<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;

use App\Mail\ExpiredMembershipMail;

use Mail,DateTime;

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
      $users = User::All();

      foreach ($users as $user) {
        $now = new DateTime();
        $date = new DateTime($user->valid_until);
        $interval = $date->diff($now)->format('%d');
        var_dump($interval);
        var_dump($date<$now);
        if($interval==5){
          Mail::to($user->email)->queue(new ExpiredMembershipMail($user->email,$user));
        }

        if($date < $now){
          Mail::to($user->email)->queue(new ExpiredMembershipMail($user->email,$user));

          $user->membership = 'free';
          $user->valid_until = null;
          $user->save();
        }
      }
    }
}
