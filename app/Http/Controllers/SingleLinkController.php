<?php

namespace App\Http\Controllers;
use App\User;
use App\Link;
use App\Pixel;
use Illuminate\Http\Request;
use Auth,Carbon;
use Ramsey\Uuid\Uuid;

class SingleLinkController extends Controller
{
  public function newsingle()
	 {
	  $data_pixel=Pixel::where('users_id',Auth::user()->id)
                          ->where('pages_id',0)
                          ->get();
		return view('user.dashboard.singlebiolinks',['data_pixel'=>$data_pixel]);
	 }
 	public function single(Request $request)
 	{
 		$num=7;
    $generated_string = ""; 
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";  
    $len = strlen($domain); 
     for ($i=0;$i<$num;$i++) 
    {  
        $index=rand(0,$len-1); 
        $generated_string=$generated_string.$domain[$index]; 
    }  
      $link=new Link;
 		  $user=Auth::User();
 		  $link->pages_id=0;
  		$link->users_id=$user->id;
  		$link->pixel_id=$request->idpixel;
      $link->names=$generated_string; 
  		$link->link=$request->url;
  		$link->title=$request->title;
  		$link->save();
  		return redirect('/dash/newsingle')->with('ok','Link telah Ditambahkan');
 	}
 	public function singlepixel(Request $request)
 	{
      if(is_null($request->hiddenid))
    {
    $pixel= new Pixel();
    }
    else
    {
      $pixel=Pixel::where('id','=',$request->hiddenid)->first();
    }
 		$user=Auth::User();
 		$pixel->users_id=$user->id;
 		$pixel->pages_id=0;
 		$pixel->title=$request->titlepixel;
  	$pixel->script=$request->script;
  	$pixel->save();
  		return redirect('/dash/newsingle')->with('ok','pixel telah Ditambahkan');
 	}
  public function loadsinglepixel(Request $request)
  {
      $pixels=Pixel::where('title','LIKE','%'.$request->cari.'%')
                  ->where('users_id',Auth::user()->id)
                  ->where('pages_id',0)
                  ->orderBy('created_at','ascend');

        $total=$pixels->count();
        $pixels=$pixels->paginate(5);

      $arr['view'] =(string) view('user.dashboard.contentsinglepixel')
                    ->with('pixels',$pixels);
      $arr ['pager']=(string) view('user.dashboard.paginatesinglepixel')
                    ->with([
                      'pixels'=>$pixels,
                      'total'=>$total,
                          ]);
     return $arr;
  }
  public function deletesinglepixel(Request $request)
  {
    $pixels=Pixel::find($request->idpixel);
    $pixels->delete();
    $arr['status']="success";
    return $arr;
  }
  public function loadsinglelink(Request $request)
  {
    $link=Link::join('pixels','links.pixel_id','pixels.id')
                ->select('pixels.title as judul','links.title','links.names as shorten','links.link')
                ->where('links.title','Like','%'.$request->carilink.'%')
                ->where('links.users_id',Auth::user()->id)
                ->where('links.pages_id',0)
                ->orderBy('links.created_at','ascend');
                
    $total=$link->count();
    $link=$link->paginate(5);

    $array['view']=(string) view('user.dashboard.contentsinglelink')
                    ->with('links',$link);
    $array['pager']=(string) view('user.dashboard.paginatesinglelink')
                    ->with([
                      'links'=>$link,
                      'total'=>$total,
                    ]);
    return $array;
  }
}
