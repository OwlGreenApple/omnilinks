<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BiolinkController as Bio;
use App\Page;

class CheckDescriptionTrustedLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:desc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To check if description contains banned link';

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
        // $pages = Page::select('description','id')->get();
        $pages = Page::where('id',10)->first();
        $bio = Bio::desc_trust_positif($pages->description);
        dd($bio);

        if($pages->count() > 0)
        {
          foreach($pages as $row):
            $description = $row->description;
            $pageid = $row->id;

            $bio = Bio::desc_trust_positif($description);

            print_r($bio)."\n";

            /*if(count($bio) > 0)
            {
              foreach($bio as $col)
              {
                $replace = str_replace($col,"",$description);
                $pg = Page::find($pageid)->description = $replace;
                $pg->save();
              }
            }*/
          endforeach;
        }
    }

/*end class*/
}
