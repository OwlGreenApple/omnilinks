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
      // $users = User::All();
      $users = User::where('id',3)->get();

      foreach ($users as $user) {
        $now = Carbon::now();
        if (is_null($user->valid_until)) {
          $date = Carbon::now()->addDays(999);
        }
        else {
          $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->valid_until);
        }
        $interval = $now->diffInDays($date,false);
        // var_dump($user->email);
        // var_dump($interval);
        if( ($interval==5) || ($interval==1) || ($interval==-1) ){
          if(env('MAIL_HOST')=='smtp.mailtrap.io'){
            sleep(2);
          }
          Mail::to($user->email)->queue(new ExpiredMembershipMail($user,$interval));
        }

        //check premium id 
        if($interval==5){
            $pages = Page::where('user_id',$user->id)
                        ->where('premium_id','!=',0)
                        ->get();

            if(!is_null($pages)){
                foreach ($pages as $page) {
                    $page->premium_id = 0;
                    $page->premium_names = null;
                    $page->save();
                }
            }

            $links = Link::where('users_id',$user->id)
                        ->where('premium_id','!=',0)
                        ->get();

            if(!is_null($links)){
                foreach ($links as $link) {
                    $link->premium_id = 0;
                    $link->premium_names = null;
                    $link->save();
                }
            }

            $premiumid = PremiumID::where('user_id',$user->id);
            
            if($premiumid->exists()){
              $premiumid->delete();
              Mail::to($user->email)->queue(new ExpiredPremiumIDMail($user->email,$user));
            }
            
            //$user->valid_until = null;
            //$user->save();
        }

        if($date < $now and $user->membership!='free'){
          $userlog = new UserLog;
          $userlog->user_id = $user->id;
          $userlog->type = 'membership';
          $userlog->value = $user->membership;
          $userlog->keterangan = 'Cron check membership, user jadi free';
          $userlog->save();

          $user->membership = 'free';
          //$user->valid_until = null;
          $user->save();
          
          //pages themes dibalikin jadi solid #fff
          $pages = Page::where('user_id',$user->id)
                      ->get();
          if(!is_null($pages)){
            foreach ($pages as $page) {
              //default value
              $page->is_outlined=1;
              $page->outline="#000";
              $page->is_bio_color=1;
              $page->bio_color="#000";
              $page->color_picker="#fff";
              $page->save();
            }
          }
          
        }
      }
    }
}
