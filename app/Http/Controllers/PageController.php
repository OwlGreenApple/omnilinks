<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Page;
use App\Link;
use App\Banner;
use App\ProofHistory;

use Validator, Auth, Carbon;

class PageController extends Controller
{
    protected function validator(array $data)
    {
      return Validator::make($data, [
        'kodekupon' => ['required','string','unique:coupons'],
        'diskon_value' => ['required','integer','min:0'],
        'diskon_percent' => ['required','integer','min:0','max:100'],
        'valid_until' => ['required','date','after:today'],
      ]);
    }

    public function index(){
      //halaman list kupon admin
      return view('admin.list-page.index');
    }

    public function load_page(Request $request){
      //halaman list kupon admin
      $pages = Page::all();

      $arr['view'] = (string) view('admin.list-page.content')
              ->with('pages',$pages);  
      return $arr;
    }
    
    //isi total_counter dengan sum semua link yang ada dipages
    public function calc_total_counter_on_pages(){
      $pages = Page::all();
      foreach ($pages as $page){
        $total_counter = 0;
        $total_counter += $page->wa_link_counter;
        $total_counter += $page->line_link_counter;
        $total_counter += $page->telegram_link_counter;
        $total_counter += $page->skype_link_counter;
        $total_counter += $page->messenger_link_counter;
        $total_counter += $page->youtube_link_counter;
        $total_counter += $page->fb_link_counter;
        $total_counter += $page->twitter_link_counter;
        $total_counter += $page->ig_link_counter;
        
        $total_counter += Link::where("pages_id",$page->id)->sum('counter');
        $total_counter += Banner::where("pages_id",$page->id)->sum('counter');
        
        
        $page->total_counter = $total_counter;
        $page->save();
        echo $page->id." ".$page->total_counter."<br>";
      }
    }

/* END CONTROLLER */
}
