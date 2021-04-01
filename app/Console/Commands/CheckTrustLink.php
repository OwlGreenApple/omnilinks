<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\UserController as Usc;

class CheckTrustLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:trusted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To filter whether link or banner link is valid or not';

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
        $usercontrol = new Usc;
        $usercontrol->flag_link();
        $usercontrol->flag_link_banner();
    }
}
