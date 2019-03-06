<?php
// biolink controller
namespace App\Http\Controllers;
use App\Page;
use App\Link;
use App\User;
use App\Pixel;
use Illuminate\Http\Request;
use Auth,Carbon;
use Ramsey\Uuid\Uuid;

class BiolinkController extends Controller
{ 
  
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
  	$page->fb_link=$request->fb;
  	$page->twitter_link=$request->twitter;
  	$page->skype_link=$request->skype;
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
  public function savewa()
  {

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
