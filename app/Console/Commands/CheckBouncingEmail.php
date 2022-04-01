<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Helpers\Helper;
use carbon\Carbon;

class CheckBouncingEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:email_bouncing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check email bouncing';

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
        $check = new Helper;
        $users = User::whereIn('is_valid_email',[0,2])->where('created_at','<=', Carbon::parse("2022-03-30")->toDateString())->select('email','id')->get();
        dd($users);
        if($users->count() > 0)
        {
            foreach($users as $row):
                $user = User::find($row->id);
                $user->is_valid_email = $check->check_email_bouncing($row->email);
            endforeach;
        }
    }

/* end class */
}
