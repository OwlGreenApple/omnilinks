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
  public function newsingle() {
	  if(Auth::user()->membership=='free') {
      return abort(404);
    } else {
      return view('user.dashboard.singlebiolinks');
    }
	}

 	public function single(Request $request)
 	{
    if(is_null($request->idlink))
    {
      $linkCheck=Link::where('users_id',Auth::user()->id)
                      ->where('pages_id',0)
                      ->count();
      if ((Auth::user()->membership=='basic') OR (Auth::user()->membership=='free')) {
         if($linkCheck>=5) {
          $arr['status'] = 'gagal';
          $arr['message']='maaf anda sudah tidak bisa menambahkan link lagi';
          return $arr;
        } 
      }         
      $link=new Link;
      $num=7;
      $generated_string = ""; 
      $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";  
      $len = strlen($domain); 
       for ($i=0;$i<$num;$i++) 
      {  
        $index=rand(0,$len-1); 
        $generated_string=$generated_string.$domain[$index]; 
      }  
      $link->names=$generated_string; 
    }
    else
    {
      $link=Link::where('id','=',$request->idlink)->first();
    }
 		  $user=Auth::User();
 		  $link->pages_id=0;
  		$link->users_id=$user->id;
  		$link->pixel_id=$request->idpixel;
  		$link->link=$request->url;
  		$link->title=$request->title;
  		$link->save();
      $arr['status'] = 'success';
      $arr['message']='anda sudah menambahkan link';
      return $arr;
  		//return redirect('/dash/newsingle')->with('ok','Link telah Ditambahkan');
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
      // if (!$pixel->count()) {
      //   return redirect(404);
      // }
    }
 		$user=Auth::User();
 		$pixel->users_id=$user->id;
 		$pixel->pages_id=0;
 		$pixel->title=$request->titlepixel;
    $pixel->jenis_pixel=$request->jenis_pixel;
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
      $pixels=$pixels->paginate(15);

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
    $link=Link::leftjoin('pixels','links.pixel_id','pixels.id')
                ->select('pixels.title as judul','links.title','links.id as idlink','links.names as shorten','links.link as datalink','links.pixel_id as idpixel')
                ->where('links.title','Like','%'.$request->carilink.'%')
                ->where('links.users_id',Auth::user()->id)
                ->where('links.pages_id',0)
                ->orderBy('links.created_at','ascend');
                
    $total=$link->count();
    $link=$link->paginate(15);

    $array['view']=(string) view('user.dashboard.contentsinglelink')
                    ->with('links',$link);
    $array['pager']=(string) view('user.dashboard.paginatesinglelink')
                    ->with([
                      'links'=>$link,
                      'total'=>$total,
                    ]);
    return $array;
  }
  public function deletesinglelink(Request $request)
  {
    $link=link::find($request->idlink);
    $link->delete();
    $arr['status']='success';
    return $arr;
  }
  public function loadPixelLink()
  {
     $data_pixel=Pixel::where('users_id',Auth::user()->id)
                          ->where('pages_id',0)
                          ->get();
    $arr['view']=(string) view('user.dashboard.contentpixelsinglelink')
                  ->with('data_pixel',$data_pixel);
    return $arr;
  }
}

