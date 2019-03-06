<?php
// biolink controller
namespace App\Http\Controllers;
use App\Page;
use App\Link;
use App\User;
use App\Pixel;
use App\Whatsapplink;
use Illuminate\Http\Request;
use Auth,Carbon;
use Ramsey\Uuid\Uuid;

class BiolinkController extends Controller
{ 
  public function savewa(Request $request)
  {
  	$uuid=$request->uuidpixel;
  	$walink= new Whatsapplink();
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
  public function newbio()
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
  	$uuid=Uuid::uuid4();
    $user = Auth::user();
    $page=new Page();
  	$page->user_id=$user->id; 
  	$page->uid=$uuid;
  	$page->names="omn.lkz/".$generated_string; 
  	$page->save();
    return redirect('/dash/new/'.$uuid);  
  }

  public function viewpage($uuid)
  {	
  	$pixel=Pixel::where('users_id',Auth::user()->id)->get();
  	$page=Page::where('uid','=',$uuid)->first();
  	$pageid=0;
  	if(!is_null($page)){
  		$pageid=$page->id;
  	}
    return view('user.dashboard.biolinks')->with([
    	'uuid'=>$uuid,
    	'pageid'=>$pageid,
    	'pixels'=>$pixel,
    ]);  
  }

  public function savetemp(Request $request)
  {

  }

  public function savelink(Request $request)
  {
  	$uuid=$request->uuid;
  	$page=Page::where('uid','=',$uuid)->first();
  	$user=Auth::user();
  	$page->wa_link=$request->wa;
  	$page->wa_pixel_id=$request->wapixel;
  	$page->fb_link=$request->fb;
  	$page->fb_pixel_id=$request->fbpixel;
  	$page->twitter_link=$request->twitter;
  	$page->telegram_link=$request->telegram;
  	$page->telegram_pixel_id=$request->telegrampixel;
  	$page->skype_link=$request->skype;
  	$page->skype_pixel_id=$request->skypepixel;
  	$page->youtube_link=$request->youtube;
  	$page->youtube_pixel_id=$request->youtubepixel;
  	$page->ig_link=$request->ig;
  	$page->ig_pixel_id=$request->igpixel;
  	$names=$page->names;
  	$page->save();
  	$title=$request->title;
  	$link=$request->url;
  	foreach ($title as $judul) 
  	{
  		foreach ($link as $linki) 
  		{
			$url=new Link();
			$url->pages_id=$page->id;
  			$url->users_id=$user->id;
  			$url->link=$linki;
  			$url->title=$judul;
  			$url->save();
  		}
  	}
  	  return redirect('/dash/new/'.$uuid)->with('ok',$names);
  }

  public function dash()
  {
  		return view('user.dashboard.dash');
  }

  public function savepixel(Request $request)
  {
  	$uuid=$request->uuidpixel;
  	$page=Page::where('uid','=',$uuid)->first();
  	$pixel=new Pixel();
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
