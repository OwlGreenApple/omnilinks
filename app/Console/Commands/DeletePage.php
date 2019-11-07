<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\UserLog;
use App\Page;
use App\Link;
use App\Banner;
use App\PremiumID;

use App\Mail\ExpiredMembershipMail;
use App\Mail\ExpiredPremiumIDMail;

use Mail,DateTime,Storage;

class DeletePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unecesary data on pages';

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
      $pages = Page::withTrashed()->get();

      foreach ($pages as $page) {
        if (is_file($page->image_pages)) {
          Storage::disk('s3')->delete($page->image_pages);
        }
        $link=Link::where('pages_id',$page->id)->delete();
        $banner=Banner::where('pages_id',$page->id)->get();
        foreach ($banner as $viewbanner)
        {
          Storage::disk('s3')->delete($viewbanner->images_banner);
          $viewbanner->delete();
        }

        $page->forceDelete();
      }
    }
}
