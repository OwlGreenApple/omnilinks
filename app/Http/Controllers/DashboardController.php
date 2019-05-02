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
}
