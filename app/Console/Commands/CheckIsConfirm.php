<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\UserLog;
use App\Page;
use App\Link;
use App\PremiumID;

use App\Mail\ExpiredMembershipMail;
use App\Mail\ExpiredPremiumIDMail;

use Mail,DateTime,Carbon;

class CheckIsConfirm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:isconfirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check IsConfirm User';

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
      $users = User::
                where("is_confirm",0)
                ->get();

      foreach ($users as $user) {
          $userlog = new UserLog;
          $userlog->user_id = $user->id;
          $userlog->type = 'membership';
          $userlog->value = $user->membership;
          $userlog->keterangan = 'Cron check isconfirm, user dapat popular 8 hari';
          $userlog->save();

          $user->membership = 'popular';
          $user->valid_until = new DateTime('+8 days');
          $user->save();
          
          
      }
    }
}
