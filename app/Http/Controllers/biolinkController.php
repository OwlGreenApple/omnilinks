<?php
namespace App\Http\Controllers;
use App\Page;
use App\Link;
use App\User;
use App\Pixel;
use App\Banner;
use App\Whatsapplink;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Auth,Carbon,Validator,Storage;
use Ramsey\Uuid\Uuid;

class BiolinkController extends Controller
{ 
  public function savewa(Request $request)
  {
  	$uuid=$request->uuidpixel;
    if(is_null($request->editidwa))
    {
    $walink= new Whatsapplink();  
    }
    else
    {
      $walink=Whatsapplink::where('id','=',$request->editidwa)->first(); 
    }
  	$user=Auth::user();
  	$page=Page::where('uid','=',$uuid)->first();
  	$walink->users_id=$user->id; 
  	$walink->pages_id=$page->id;
  	$walink->nomor=$request->nomorwa;
  	$walink->pesan=$request->pesan;
  	$walink->linkgenerator=$request->textlink;
  	$walink->save();	  
  	return redirect('/dash/new/'.$uuid);
  }

  public function loadwalink(Request $request)
  {
  	$walink=Whatsapplink::where('users_id',Auth::user()->id)
  					->orderBy('created_at','ascend')->get();
  	$arr['viewer'] =(string) view('user.dashboard.contentwa')
                    ->with('walink',$walink);
     return $arr;
  }
    public function deletewalink(Request $request)
  {
   $walink=Whatsapplink::find($request->idwalink);
   $walink->delete();
   $arra['status']="success";
   return $arra;
  }

  public function newbio(Request $request)
  {
    $num=7;
    do
    {
      $generated_string = ""; 
      $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";  
      $len = strlen($domain);  
      for ($i=0;$i<$num;$i++) 
      {  
        $index=rand(0,$len-1); 
        $generated_string=$generated_string.$domain[$index]; 
      } 
      $cekpage=Page::where('names','=',$generated_string)->first();
    }
    while (!is_null($cekpage));
  	$uuid=Uuid::uuid4();
    $user = Auth::user();
    $page=new Page();
  	$page->user_id=$user->id; 
  	$page->uid=$uuid;
  	$page->names=$generated_string; 
  	$page->save();
    return redirect('/dash/new/'.$uuid);  
  }

  public function viewpage($uuid)
  {	
  	$pixel=Pixel::where('users_id',Auth::user()->id)
                  ->where('pages_id','!=',0)
                  ->get();
  	$page=Page::where('uid','=',$uuid)->first();
  	$pageid=0;
    $links=Link::where('users_id',Auth::user()->id)
                ->where('pages_id',$page->id)
                ->get();
  	if(!is_null($page)){
  		$pageid=$page->id;
  	}
    return view('user.dashboard.biolinks')->with([
    	'uuid'=>$uuid,
    	'pageid'=>$pageid,
    	'pixels'=>$pixel,
      'links'=>$links,
    ]);  
  }
public function link($names)
 {
  $page=Page::where('names','=',$names)->first();
  $link=Link::where('pages_id','=',$page->id)
        ->orderBy('created_at','ascend')
        ->get();
  $banner=Banner::where('pages_id','=',$page->id)
        ->orderBy('created_at','ascend')
        ->get();
  return view('user.link.link')
        ->with(['links'=>$link,
                 'pages'=>$page,
                'banner'=>$banner,
              ]);
 }

  public function savetemp(Request $request)
  {
    $uuid=$request->uuidtemp;
    $page=Page::where('uid','=',$uuid)->first();
    $page->page_title=$request->judul;
    $page->link_utama=$request->link;
    
    if(is_null($request->file('imagepages')))
    {
    $path=null;
    }
    else{
    $path = Storage::putFile('template',$request->file('imagepages')); 
    }
    $page->image_pages = $path;
    $page->telpon_utama=$request->nomor;
    $page->save();
    $names=$page->names;
    for($i=0;$i<count($request->judulBanner);$i++) 
    { 
      $banner= new Banner();
      $user=Auth::user();
      $banner->users_id=$user->id;
      $banner->pages_id=$page->id;
      $banner->title=$request->judulBanner[$i];
      $banner->link=$request->linkBanner[$i];
      $banner->pixel_id=$request->bannerpixel[$i];
      if(is_null($request->file('bannerImage')))
      {
        $path1=null;
      }
      else
      {
        $path1=Storage::putFile('banner',$request->file('bannerImage')[$i]);  
      }
      $banner->images_banner=$path1;
      $banner->save(); 
    }
    
    $arr['status'] = 'success';
    $arr['message'] ='Letakkan link berikut di Bio Instagram <a href="omn.lkz/'.$names.'">omn.lkz/'.$names.'</a>';
    return $arr;
  }
  public function addBanner()
  {
    $pixels=Pixel::where('users_id',Auth::user()->id)
                  ->where('pages_id','!=',0)
                  ->orderBy('created_at','ascend')
                  ->get();
    $arr['view'] =(string) view('user.dashboard.bannerContent')
                    ->with('pixels',$pixels);
     return $arr;
  }

  public function savelink(Request $request)
  {
  	$uuid=$request->uuid;
  	$page=Page::where('uid','=',$uuid)->first();
  	$user=Auth::user();
    $wa=$request->wapixel;
    $twitter=$request->twitterpixel;
    $telegram=$request->telegrampixel;
    $youtube=$request->youtubepixel;
    $ig=$request->igpixel;
    $skype=$request->skypepixel;
    $fb=$request->fbpixel;
    $page->wa_pixel_id=$wa;
    $page->twitter_pixel_id=$twitter;
    $page->ig_pixel_id=$ig;
    $page->telegram_pixel_id=$telegram;
    $page->youtube_pixel_id=$youtube;
    $page->skype_pixel_id=$skype;
    $page->fb_pixel_id=$fb;
  	$page->wa_link=$request->wa;
  	$page->fb_link=$request->fb;
  	$page->twitter_link=$request->twitter;
  	$page->telegram_link=$request->telegram;
  	$page->skype_link=$request->skype;
  	$page->youtube_link=$request->youtube;
  	$page->ig_link=$request->ig;
  	$names=$page->names;
  	$page->save();
  	$title=$request->title;
  	$link=$request->url;
   /// dd($link);
    $id=$request->idlink;
    for ($i=0; $i <count($title); $i++)
     { 
      if($id[$i]=='new')
      {
        $url=new Link();
        
      }
      else
      {
         $url=Link::find($id[$i]);

      }
       $url->pages_id=$page->id;
        $url->names=null;
        $url->users_id=$user->id;
        $url->title=$title[$i];
        $url->link=$link[$i];
        $url->save();
    }
      

    $arr['status'] = 'success';

    $arr['message'] ='Letakkan link berikut di Bio Instagram <a href="omn.lkz/'.$names.'">omn.lkz/'.$names.'</a>';
  	return $arr;
  }

  public function savepixel(Request $request)
  {
  	$uuid=$request->uuidpixel;
  	$page=Page::where('uid','=',$uuid)->first();
    if (is_null($request->editidpixel)) 
    {
        $pixel=new Pixel();
    }
    else
    {
     $pixel=Pixel::where('id','=',$request->editidpixel)->first(); 
    }
    
  	$user=Auth::user();
  	$pixel->pages_id=$page->id;
  	$pixel->users_id=$user->id;
  	$pixel->title=$request->title;
  	$pixel->script=$request->script;
  	$pixel->save();
  	return redirect('/dash/new/'.$uuid);
  }
  public function loadpixel(Request $request)
  {
  	$idpage=$request->idpage;
  	$pixels=Pixel::where('users_id',Auth::user()->id)
                  ->where('pages_id','!=',0)
  					->orderBy('created_at','ascend')->get();
  					//dd($pixels);
  	$arr['view'] =(string) view('user.dashboard.contentpixel')
                    ->with('pixels',$pixels);
     return $arr;
  }

  public function deletepixel(Request $request)
  {
  	$pixel=Pixel::find($request->idpixel);
  	$pixel->delete();
  	$arr['status']="success";
  	return $arr;
  }

}
