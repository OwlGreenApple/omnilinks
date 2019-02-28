<?php

namespace App\Http\Controllers;
use App\page;
use App\link;
use App\User;
use Illuminate\Http\Request;
use Auth,carbon;

class biolinkController extends Controller
{
  public function newbio()
  {
   return view('user.dashboard.biolinks');
  }
  public function savebio(Request $request)
  {
    $user = Auth::user();
    $page = new page;
	$page->user_id=$user->id;
    $page->wa_link=$request->wa;
    $page->fb_link=$request->fb;
    $page->twitter_link=$request->twitter;
    $page->youtube_link=$request->youtube;
    $page->telegram_link=$request->telegram;
    $page->skype_link=$request->skype;
    $page->save();
	$title=$request->title;
	$linki=$request->url;
	foreach($title as $tile)
	{
		foreach($linki as $url)
		{
		$link= new link;
		$link->pages_id=$page->id;
		$link->users_id=$user->id;	
		$link->link=$url;
		$link->title=$tile;
		$link->save();
		}
	}				
	
    return redirect('/dash/new')->with('ok',' link tervalidasi');
  }

  public function newsingle(Request $request)
  {
	  return view('user.dashboard.singlebiolinks');
  }
}
