<?php
namespace App\Http\Controllers;
use App\Page;
use App\Link;
use App\User;
use App\Pixel;
use App\Banner;
use App\Whatsapplink;
use Auth,Carbon,Validator,Storage;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

use PDF;

class DashboardController extends Controller
{
    public function loadDashboard()
    {
    	$page=Page::where('user_id',Auth::user()->id)
    				->orderBy('created_at','ascend')
    				->paginate(5);
    	//dd($page->count());
    	$arr['view']=(string) view('user.dashboard.dashboardcontent')
    	 				->with('pages',$page);

    	return $arr;
    }
   
    public function deletePage(Request $Request)
    {
    	$page=Page::find($Request->deletedataid);
      if (is_file($page->image_pages)) {
       Storage::delete($page->image_pages);
      }
    	$link=Link::where('pages_id',$Request->deletedataid)->delete();
    	$banner=Banner::where('pages_id',$Request->deletedataid)->get();
      foreach ($banner as $viewbanner)
       {     
            Storage::delete($viewbanner->images_banner);
            $viewbanner->delete();
      }
      $page->delete();
    	$arr['status']="success";
  		return $arr;
    } 

    public function pdf_biolinks($id){
      $page = Page::find($id);
      $banners = Banner::where('pages_id',$id)->get();
      $links = Link::where('pages_id',$id)->get();

      $click = $this->counter_click_month($page,$banners,$links);

      $chart = $this->chart_day($page,$banners,$links);

      $data = array(
        'page' => $page, 
        'banners' => $banners,
        'links' => $links,
        'click' => $click,
        'chart' => $chart,
      );

      $pdf = PDF::loadView('user.pdf.pdf-all', $data)
            ->setPaper('a4')
            ->setOption('footer-html', view('user.pdf.footer'))
            ->setOption('margin-bottom', 10)
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('enable-javascript', true)
            ->setOption('images', true)
            ->setOption('javascript-delay', 13000)
            ->setOption('enable-smart-shrinking', true)
            ->setOption('no-stop-slow-scripts', true);

      return $pdf->stream();
    }

    public function pdf_singlelinks($id){
      $link = Link::find($id);

      $chart = $this->chart_link($link);

      $data = array(
        'link' => $link,
        'chart' => $chart,
      );

      $pdf = PDF::loadView('user.pdf.pdf-single', $data)
            ->setPaper('a4')
            ->setOption('footer-html', view('user.pdf.footer'))
            ->setOption('margin-bottom', 10)
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('enable-javascript', true)
            ->setOption('images', true)
            ->setOption('javascript-delay', 13000)
            ->setOption('enable-smart-shrinking', true)
            ->setOption('no-stop-slow-scripts', true);

      return $pdf->stream();
    }

    public function check_file($filename){
      $content = 0;

      if(file_exists('storage/app/'.$filename)){
        $myfile = fopen('storage/app/'.$filename, "r") or die("Unable to open file!");
        $content = (int)fread($myfile, filesize('storage/app/'.$filename));
        fclose($myfile);
      } 

      return $content;
    }

    public function counter_click_month($page,$banners,$links){
      $query_date = date('d-m-Y');
      $first_date = date('01-m-Y', strtotime($query_date));
      //$last_date = date('t-m-Y', strtotime($query_date));
      $arr = array();

      while($first_date <= $query_date){
        foreach ($banners as $banner) {
          $filename = 'clicked/'.Auth::user()->email.'/'.$first_date.'/banner-'.$banner->title.'/counter.txt';

          $click = $this->check_file($filename);

          if(array_key_exists($banner->title, $arr)){
            $arr[$banner->title] = $arr[$banner->title] + $click;
          } else {
            $arr[$banner->title] = $click;
          }
        }
        
        foreach ($links as $link) {
          $filename = 'clicked/'.Auth::user()->email.'/'.$first_date.'/link-'.$link->title.'/counter.txt';

          $click = $this->check_file($filename);

          if(array_key_exists($link->title, $arr)){
            $arr[$link->title] = $arr[$link->title] + $click;
          } else {
            $arr[$link->title] = $click;
          }
        } 

        $key = ['wa','telegram','skype','fb','ig','twitter','youtube'];
        
        foreach ($key as $k) {
          $filename = 'clicked/'.Auth::user()->email.'/'.$first_date.'/'.$k.'/counter.txt';

          $click = $this->check_file($filename);

          if(array_key_exists($k, $arr)){
            $arr[$k] = $arr[$k] + $click;
          } else {
            $arr[$k] = $click;
          }
        }
          
        $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
      }

      return $arr;
    }

    public function chart_day($page,$banners,$links){
      $query_date = date('d-m-Y');
      $first_date = date('01-m-Y', strtotime($query_date));
      //$last_date = date('t-m-Y', strtotime($query_date));
      $arr = [];

      $click_day = 0;
      while($first_date <= $query_date){
        foreach ($banners as $banner) {
          $filename = 'clicked/'.Auth::user()->email.'/'.$first_date.'/banner-'.$banner->title.'/counter.txt';

          $click = $this->check_file($filename);

          $click_day = $click_day + $click;
        }
        
        foreach ($links as $link) {
          $filename = 'clicked/'.Auth::user()->email.'/'.$first_date.'/link-'.$link->title.'/counter.txt';

          $click = $this->check_file($filename);

          $click_day = $click_day + $click;
        } 

        $key = ['wa','telegram','skype','fb','ig','twitter','youtube'];
        
        foreach ($key as $k) {
          $filename = 'clicked/'.Auth::user()->email.'/'.$first_date.'/'.$k.'/counter.txt';

          $click = $this->check_file($filename);

          $click_day = $click_day + $click;
        }
          
        $arr[] = array("x"=> strtotime($first_date)*1000, "y"=>$click_day);

        $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
      }

      return $arr;
    }

    public function chart_link($link){
      $query_date = date('d-m-Y');
      $first_date = date('01-m-Y', strtotime($query_date));
      //$last_date = date('t-m-Y', strtotime($query_date));
      $arr = [];

      $click_day = 0;
      while($first_date <= $query_date){
        
        $filename = 'clicked/'.Auth::user()->email.'/'.$first_date.'/link-'.$link->title.'/counter.txt';

        $click = $this->check_file($filename);

        $arr[] = array("x"=> strtotime($first_date)*1000, "y"=>$click);

        $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
      }

      return $arr;
    }
}
