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
  public function viewDashboard()
  {
    $user=Auth::user();
    return view('user.dashboard.dash')->with('user',$user);
  }
  
  public function loadDashboard(Request $request)
  {
    $user=Auth::user();
    $search = false;
    //halaman dashboard user
    if($request->keywords==''){
      $page = Page::where('user_id',$user->id)
            ->orderBy('created_at','ascend')
            ->paginate(10);
    } else {
      $search = true;
      $page = Page::where('user_id',$user->id);

      if(strtolower($request->keywords)=='whatsapp'){
        $page = $page->where('wa_pixel_id','!=',null)
                  ->where('wa_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='skype'){
        $page = $page->where('skype_pixel_id','!=',null)
                  ->where('skype_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='telegram'){
        $page = $page->where('telegram_pixel_id','!=',null)
                  ->where('telegram_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='line'){
        $page = $page->where('line_pixel_id','!=',null)
                  ->where('line_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='messenger'){
        $page = $page->where('messenger_pixel_id','!=',null)
                  ->where('messenger_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='facebook'){
        $page = $page->where('fb_pixel_id','!=',null)
                  ->where('fb_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='youtube'){
        $page = $page->where('youtube_pixel_id','!=',null)
                  ->where('youtube_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='twitter'){
        $page = $page->where('twitter_pixel_id','!=',null)
                  ->where('twitter_pixel_id','!=',0);
      } else if(strtolower($request->keywords)=='instagram'){
        $page = $page->where('ig_pixel_id','!=',null)
                  ->where('ig_pixel_id','!=',0);
      } else {
        $page = $page->where('page_title','like','%'.$request->keywords.'%')
                  ->orwhere('names','like','%'.$request->keywords.'%')
                  ->orwhere('premium_names','like','%'.$request->keywords.'%');
      }
      
      $page = $page->orderBy('created_at','ascend')
                ->paginate(10);    
    }
    

    $arr['view']=(string) view('user.dashboard.dashboardcontent')
                  ->with('pages',$page)
                  ->with('bulan',$request->bulan)
                  ->with('tahun',$request->tahun)
                  ->with('search',$search);

    $arr['pager'] = (string) view('user.dashboard.dash_pagination')
                    ->with('pages',$page);

    return $arr;
  }

  public function dashboard_detail($pageid,$id,$mode,$bulan,$tahun) {
    //halaman dashboard detail user
    $data = $this->detail_report($pageid,$id,$mode,$bulan,$tahun);

    $pixels = Pixel::where('pages_id',$pageid)->get();

    return view('user.dashboard.dashboard-detail.index')
            ->with('data',$data)
            ->with('pageid',$pageid)
            ->with('id',$id)
            ->with('mode',$mode)
            ->with('bulann',$bulan)
            ->with('tahun',$tahun)
            ->with('pixels',$pixels);
  }
  
  public function dashboard_detail_all($pageid,$bulan,$tahun) {
    //halaman dashboard detail user
    //$data = $this->detail_report($pageid,$id,$mode,$bulan,$tahun);
    $page = Page::find($pageid);

    return view('user.dashboard.dashboard-detail.index-all')
            //->with('data',$data)
            ->with('pageid',$pageid)
            ->with('page',$page)
            ->with('bulann',$bulan)
            ->with('tahun',$tahun);
  }

  public function load_dash_detail(Request $request){
    //halaman dashboard detail user
    $data = $this->detail_report($request->pageid,$request->id,$request->mode,$request->bulan,$request->tahun);

    $arr['chart'] = $data['chart'];
    $arr['view'] = (string) view('user.dashboard.dashboard-detail.content')
                    ->with('data',$data);
    $arr['total_click'] = $data['total_click'];

    return $arr;
  }

  public function load_dash_detail_all(Request $request){
    //halaman dashboard detail user
    $page = Page::find($request->pageid);

    $links = Link::where('users_id',Auth::user()->id)
              ->where('pages_id',$page->id)
              ->get();

    $banners = Banner::where('users_id',Auth::user()->id)
                ->where('pages_id',$page->id)
                ->get();

    $pixels = Pixel::where('users_id',Auth::user()->id)
                ->select('jenis_pixel')
                ->where('pages_id',$page->id)
                ->groupBy('jenis_pixel')
                ->get();

    $array = $this->counter_click_month($page,$banners,$links,$request->bulan,$request->tahun);

    $chart = $this->chart_day($page,$banners,$links,$request->bulan,$request->tahun);

    $arr['chart'] = $chart;
    $arr['data'] = $array;
    $arr['view'] = (string) view('user.dashboard.dashboard-detail.content-all')
                    ->with('page',$page)
                    ->with('links',$links)
                    ->with('banners',$banners)
                    ->with('pixels',$pixels)
                    ->with('arr',$array)
                    ->with('bulan',$request->bulan)
                    ->with('tahun',$request->tahun);

    $arr['total_click'] = array_sum($array);

    return $arr;
  }

  public function load_chart(Request $request){
    $user=Auth::user();
    //generate chart all page
    $bulan = $request->bulan;
    $tahun = $request->tahun;
    $query_date = date('t-'.$bulan.'-'.$tahun);

    $first_date = date('01-'.$bulan.'-'.$tahun, strtotime($query_date));
    $arr = array();

    $total_click = 0;
    while(strtotime($first_date) <= strtotime($query_date)){
      $filename = 'clicked/'.$user->email.'/'.$first_date.'/all/total-click/counter.txt';

      $click = $this->check_file($filename);
      $total_click = $total_click + $click;
        
      $arr[] = array("x"=> strtotime($first_date)*1000, "y"=>$click);

      $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
    }

    $arr['chart'] = $arr;
    $arr['total_click'] = $total_click;

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

  public function deleteLink(Request $request){
    if($request->mode=='link'){
      $link = Link::find($request->id)->delete();
    } else if($request->mode=='banner'){
      $banner = Banner::find($request->id)->delete();
    } else {
      $page = Page::find($request->id);
      switch($request->mode){
        case 'wa':
          $page->wa_title = null;
          $page->wa_link = null;
          $page->wa_pixel_id = 0;
          $page->wa_logo = null;
          $page->wa_link_counter = 0;
        break;
        case 'telegram':
          $page->telegram_title = null;
          $page->telegram_link = null;
          $page->telegram_pixel_id = 0;
          $page->telegram_logo = null;
          $page->telegram_link_counter = 0;
        break;
        case 'skype':
          $page->skype_title = null;
          $page->skype_link = null;
          $page->skype_pixel_id = 0;
          $page->skype_logo = null;
          $page->skype_link_counter = 0;
        break;
        case 'fb':
          $page->fb_title = null;
          $page->fb_link = null;
          $page->fb_pixel_id = 0;
          $page->fb_logo = null;
          $page->fb_link_counter = 0;
        break;
        case 'ig':
          $page->ig_title = null;
          $page->ig_link = null;
          $page->ig_pixel_id = 0;
          $page->ig_logo = null;
          $page->ig_link_counter = 0;
        break;
        case 'twitter':
          $page->twitter_title = null;
          $page->twitter_link = null;
          $page->twitter_pixel_id = 0;
          $page->twitter_logo = null;
          $page->twitter_link_counter = 0;
        break;
        case 'youtube':
          $page->youtube_title = null;
          $page->youtube_link = null;
          $page->youtube_pixel_id = 0;
          $page->youtube_logo = null;
          $page->youtube_link_counter = 0;
        break;
      }

      $page->save();
    }

    $arr['status']="success";
    return $arr;
  }

  public function editLink(Request $request){
    if($request->mode=='link'){
      $link = Link::find($request->id);
      $link->title = $request->title;
      $link->link = $request->link;
      $link->pixel_id = $request->pixel;
      $link->save();
    } else if($request->mode=='banner'){
      $banner = Banner::find($request->id);
      $banner->title = $request->title;
      $banner->link = $request->link;
      $banner->pixel_id = $request->pixel;
      $banner->save();
    } else {
      $page = Page::find($request->id);

      switch($request->mode){
        case 'wa':
          $page->wa_link = $request->link;
          $page->wa_pixel_id = $request->pixel;
        break;
        case 'telegram':
          $page->telegram_link = $request->link;
          $page->telegram_pixel_id = $request->pixel;
        break;
        case 'skype':
          $page->skype_link = $request->link;
          $page->skype_pixel_id = $request->pixel;
        break;
        case 'fb':
          $page->fb_link = $request->link;
          $page->fb_pixel_id = $request->pixel;
        break;
        case 'ig':
          $page->ig_link = $request->link;
          $page->ig_pixel_id = $request->pixel;
        break;
        case 'twitter':
          $page->twitter_link = $request->link;
          $page->twitter_pixel_id = $request->pixel;
        break;
        case 'youtube':
          $page->youtube_link = $request->link;
          $page->youtube_pixel_id = $request->pixel;
        break;
      }

      $page->save();
    }

    $pixel = Pixel::find($request->pixel);

    $arr['status'] = 'success';
    $arr['message'] = 'Edit link berhasil';
    $arr['pixel'] = $pixel;

    return $arr;
  }

  public function pdf_page($id,$bulan,$tahun){
    $user=Auth::user();
    //generate pdf 1 page
    $page = Page::find($id);

    $banners = Banner::where('pages_id',$id)
                      ->where('users_id',$user->id)
                      ->get();

    $links = Link::where('pages_id',$id)
                  ->where('users_id',$user->id)
                  ->get();

    $pixels = Pixel::where('users_id',$user->id)
              ->select('jenis_pixel')
              ->where('pages_id',$id)
              ->groupBy('jenis_pixel')
              ->get();

    $click = $this->counter_click_month($page,$banners,$links,$bulan,$tahun);

    $chart = $this->chart_day($page,$banners,$links,$bulan,$tahun);

    $data = array(
      'page' => $page, 
      'banners' => $banners,
      'links' => $links,
      'click' => $click,
      'chart' => $chart,
      'pixels' => $pixels,
      'bulan' => $bulan,
      'tahun' => $tahun,
    );

    $pdf = PDF::loadView('user.pdf.pdf-all', $data)
          ->setPaper('a4')
          ->setOption('footer-html', view('user.pdf.footer'))
          ->setOption('margin-bottom', 10)
          ->setOption('margin-right', '0mm')
          ->setOption('margin-left', '0mm')
          /*->setOption('enable-javascript', true)
          ->setOption('images', true)
          ->setOption('javascript-delay', 13000)
          ->setOption('enable-smart-shrinking', true)
          ->setOption('no-stop-slow-scripts', true)*/;

    return $pdf->stream();
  }

  public function detail_report($pageid,$id,$mode,$bulan,$tahun){
    //generate data pdf detail

    $page = Page::find($pageid);  
    if(is_null($page)){
      return abort(404);
    }

    if($mode=='link'){
      $link = Link::find($id); 
      if(is_null($link)){
        return abort(404);
      }
      $arr = $this->chart_link($pageid,'link-'.$link->title,$bulan,$tahun); 
  
      $data = array(
        'id' => $link->id,
        'pageid' => $page->id,
        'title' => $link->title,
        'pagetitle' => $page->page_title,
        'link' => $link->link,
        'created_at' => $link->created_at,
        'updated_at' => $link->updated_at,
        'pixel_id' => $link->pixel_id,
        'chart' => $arr['chart'],
        'total_click' => $arr['total_click'],
        'bulanpdf' => $bulan,
        'tahunpdf' => $tahun,
        'mode' => $mode,
      );
    } else if($mode=='banner') {
      $banner = Banner::find($id);
      if(is_null($banner)){
        return abort(404);
      }
      $arr = $this->chart_link($pageid,'banner-'.$banner->title,$bulan,$tahun);

      $data = array(
        'id' => $banner->id,
        'pageid' => $page->id,
        'title' => $banner->title,
        'pagetitle' => $page->page_title,
        'link' => $banner->link,
        'created_at' => $banner->created_at,
        'updated_at' => $banner->updated_at,
        'pixel_id' => $banner->pixel_id,
        'chart' => $arr['chart'],
        'total_click' => $arr['total_click'],
        'bulanpdf' => $bulan,
        'tahunpdf' => $tahun,
        'mode' => $mode,
      );
    } else {
      switch($mode){
        case 'wa':
          $title = 'WhatsApp';
          $link = $page->wa_link;
          $pixelid = $page->wa_pixel_id;
        break;
        case 'telegram':
          $title = 'Telegram';
          $link = $page->telegram_link;
          $pixelid = $page->telegram_pixel_id;
        break;
        case 'skype':
          $title = 'Skype';
          $link = $page->skype_link;
          $pixelid = $page->skype_pixel_id;
        break;
        case 'fb':
          $title = 'Facebook';
          $link = $page->fb_link;
          $pixelid = $page->fb_pixel_id;
        break;
        case 'ig':
          $title = 'Instagram';
          $link = $page->ig_link;
          $pixelid = $page->ig_pixel_id;
        break;
        case 'twitter':
          $title = 'Twitter';
          $link = $page->twitter_link;
          $pixelid = $page->twitter_pixel_id;
        break;
        case 'youtube':
          $title = 'Youtube';
          $link = $page->youtube_link;
          $pixelid = $page->youtube_pixel_id;
        break;
      }

      $arr = $this->chart_link($pageid,$mode,$bulan,$tahun);

      $data = array(
        'id' => $page->id,
        'pageid' => $page->id,
        'title' => $title,
        'pagetitle' => $page->page_title,
        'link' => $link,
        'created_at' => $page->created_at,
        'updated_at' => $page->updated_at,
        'pixel_id' => $pixelid,
        'chart' => $arr['chart'],
        'total_click' => $arr['total_click'],
        'bulanpdf' => $bulan,
        'tahunpdf' => $tahun,
        'mode' => $mode,
      );
    }

    return $data;
  }

  public function pdf_single($pageid,$id,$mode,$bulan,$tahun){
    //generate pdf detail
    $data = $this->detail_report($pageid,$id,$mode,$bulan,$tahun);

    $pdf = PDF::loadView('user.pdf.pdf-single', $data)
          ->setPaper('a4')
          ->setOption('footer-html', view('user.pdf.footer'))
          ->setOption('margin-bottom', 10)
          ->setOption('margin-right', '0mm')
          ->setOption('margin-left', '0mm')
          /*->setOption('enable-javascript', true)
          ->setOption('images', true)
          ->setOption('javascript-delay', 13000)
          ->setOption('enable-smart-shrinking', true)
          ->setOption('no-stop-slow-scripts', true)*/;

    return $pdf->stream();
  }

  public function check_file($filename){
    //check isi file total click
    $content = 0;
    
    /*if(file_exists('storage/app/'.$filename)){
      $myfile = fopen('storage/app/'.$filename, "r") or die("Unable to open file!");
      $content = (int)fread($myfile, filesize('storage/app/'.$filename));
      fclose($myfile);
    } */
    
    $content = file_get_contents(Storage::disk('s3')->url($filename));
    
    return $content;
  }

  public function counter_click_month($page,$banners,$links,$bulan,$tahun){
    $user=Auth::user();
    //hitung click perbulan
    $query_date = date('t-'.$bulan.'-'.$tahun);
    $first_date = date('01-'.$bulan.'-'.$tahun, strtotime($query_date));
    //$last_date = date('t-m-Y', strtotime($query_date));
    $arr = array();

    foreach ($banners as $banner) {
      $filename = 'clicked/'.$user->email.'/'.date($bulan.'-'.$tahun).'/'.$page->id.'/banner-'.$banner->title.'/counter.txt';

      $click = $this->check_file($filename);

      $arr[$banner->title] = $click;
    }

    foreach ($links as $link) {
      $filename = 'clicked/'.$user->email.'/'.date($bulan.'-'.$tahun ).'/'.$page->id.'/link-'.$link->title.'/counter.txt';

      $click = $this->check_file($filename);

      $arr[$link->title] = $click;
    } 

    $key = ['wa','telegram','skype','line','messenger','fb','ig','twitter','youtube'];
      
    foreach ($key as $k) {
      $filename = 'clicked/'.$user->email.'/'.date($bulan.'-'.$tahun).'/'.$page->id.'/'.$k.'/counter.txt';

      $click = $this->check_file($filename);

      $arr[$k] = $click;
    }

    /*while($first_date <= $query_date){
      foreach ($banners as $banner) {
        $filename = 'clicked/'.$user->email.'/'.$first_date.'/banner-'.$banner->title.'/counter.txt';

        $click = $this->check_file($filename);

        if(array_key_exists($banner->title, $arr)){
          $arr[$banner->title] = $arr[$banner->title] + $click;
        } else {
          $arr[$banner->title] = $click;
        }
      }
      
      foreach ($links as $link) {
        $filename = 'clicked/'.$user->email.'/'.$first_date.'/link-'.$link->title.'/counter.txt';

        $click = $this->check_file($filename);

        if(array_key_exists($link->title, $arr)){
          $arr[$link->title] = $arr[$link->title] + $click;
        } else {
          $arr[$link->title] = $click;
        }
      } 

      $key = ['wa','telegram','skype','fb','ig','twitter','youtube'];
      
      foreach ($key as $k) {
        $filename = 'clicked/'.$user->email.'/'.$first_date.'/'.$k.'/counter.txt';

        $click = $this->check_file($filename);

        if(array_key_exists($k, $arr)){
          $arr[$k] = $arr[$k] + $click;
        } else {
          $arr[$k] = $click;
        }
      }
        
      $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
    }*/
    dd($arr);
    return $arr;
  }

  public function chart_day($page,$banners,$links,$bulan,$tahun){
    $user=Auth::user();
    //generate chart dalam 30 hari 1 page
    $query_date = date('t-'.$bulan.'-'.$tahun);
    $first_date = date('01-'.$bulan.'-'.$tahun, strtotime($query_date));
    //$last_date = date('t-m-Y', strtotime($query_date));
    $arr = [];

    while(strtotime($first_date) <= strtotime($query_date)){
      $filename = 'clicked/'.$user->email.'/'.$first_date.'/'.$page->id.'/total-click/counter.txt';

      $click = $this->check_file($filename);
        
      $arr[] = array("x"=> strtotime($first_date)*1000, "y"=>$click);

      $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
    }

    /*$click_day = 0;
    while($first_date <= $query_date){
      foreach ($banners as $banner) {
        $filename = 'clicked/'.$user->email.'/'.$first_date.'/banner-'.$banner->title.'/counter.txt';

        $click = $this->check_file($filename);

        $click_day = $click_day + $click;
      }
      
      foreach ($links as $link) {
        $filename = 'clicked/'.$user->email.'/'.$first_date.'/link-'.$link->title.'/counter.txt';

        $click = $this->check_file($filename);

        $click_day = $click_day + $click;
      } 

      $key = ['wa','telegram','skype','fb','ig','twitter','youtube'];
      
      foreach ($key as $k) {
        $filename = 'clicked/'.$user->email.'/'.$first_date.'/'.$k.'/counter.txt';

        $click = $this->check_file($filename);

        $click_day = $click_day + $click;
      }
        
      $arr[] = array("x"=> strtotime($first_date)*1000, "y"=>$click_day);

      $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
    }*/

    return $arr;
  }

  public function chart_link($pageid,$name,$bulan,$tahun){
    $user=Auth::user();
    //generate chart dalam 30 hari detail
    $query_date = date('t-'.$bulan.'-'.$tahun);
    $first_date = date('01-'.$bulan.'-'.$tahun, strtotime($query_date));
    //$last_date = date('t-m-Y', strtotime($query_date));
    $arr = [];
    $total_click = 0;

    while(strtotime($first_date) <= strtotime($query_date)){
      $filename = 'clicked/'.$user->email.'/'.$first_date.'/'.$pageid.'/'.$name.'/counter.txt';

      $click = $this->check_file($filename);
      $total_click = $total_click + $click;

      $arr[] = array("x"=> strtotime($first_date)*1000, "y"=>$click);

      $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
    }

    $allarr['chart'] = $arr;
    $allarr['total_click'] = $total_click;

    /*while($first_date <= $query_date){
      $filename = 'clicked/'.$user->email.'/'.$first_date.'/0/link-'.$link->title.'/counter.txt';

      $click = $this->check_file($filename);
      $total_click = $total_click + $click;

      $arr[] = array("x"=> strtotime($first_date)*1000, "y"=>$click);

      $first_date = date('d-m-Y',strtotime('+1 day', strtotime($first_date)));
    }

    $allarr['chart'] = $arr;
    $allarr['total_click'] = $total_click;*/

    return $allarr;
  }
}
