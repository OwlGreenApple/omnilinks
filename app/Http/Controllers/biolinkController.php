<?php
// biolink controller
namespace App\Http\Controllers;
use App\Page;
use App\Link;
use App\User;
use Illuminate\Http\Request;
use Auth,Carbon;
use Ramsey\Uuid\Uuid;

class BiolinkController extends Controller
{
  public function newbio()
  {
  	$uuid=Uuid::uuid4();
    $user = Auth::user();
    $page=new Page();
  	$page->user_id=$user->id; 
  	$page->names=$uuid;
  	$page->save();
    // $token="";
    // $page= page::where('name',$name)->first();
    // if(is_null($page))
    // {
    //   $page = new page();
    //   $page->name = 
    // }
   //return $this->viewpage($uuid);
    return redirect('/dash/new/'.$uuid);  
  }
  public function viewpage($names)
  {
  	//$name=page::where('name',$names);
    return view('user.dashboard.biolinks')->with('name',$names);  
  }
  public function savetemp(Request $request,$names)
  {

  	// $edit->update($request->all());
  }
  public function savelink(Request $request,$names)
  {
  	$names=$request->names;
  	$page=Page::where('names','=',$names)->first();
  	$user=Auth::user();
  	$page->wa_link=$request->wa;
  	$page->fb_link=$request->fb;
  	$page->twitter_link=$request->twitter;
  	$page->skype_link=$request->skype;
  	$page->save();
  	$title=$request->title;
  	$link=$request->url;
  	foreach ($title as $judul) 
  	{
  		foreach ($link as $linki) 
  		{
  			$url=new Link();
  			$url->users_id=$user_id;
  			$url->link=$link;
  			$url->title=$title;
  			$url->save();
  		}
  	}

  	  return redirect('/dash/new')->with('ok',' link tervalidasi');
  }
 //
 //  		$link->pages_id=$page->id;
 //  		$link->users_id=$user->id;	
 //  		$link->link=$url;
 //  		$link->title=$tile;
 //  		$link->save();
 //  		}
	//   }  				

 //  }

  public function newsingle(Request $request)
  {
	  return view('user.dashboard.singlebiolinks');
  }
  public function dash()
  {
  		return view('user.dashboard.dash');
  }
}
