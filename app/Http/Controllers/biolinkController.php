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
        $link= new link;
        //dd($page);
        $page->user_id=$user->id;
        $page->wa_link=$request->wa;
        $page->fb_link=$request->fb;
        $page->twitter_link=$request->twitter;
        $page->youtube_link=$request->youtube;
        $page->telegram_link=$request->telegram;
        $page->skype_link=$request->skype;
        $page->save();
        
        $title=$request->title;
        foreach ( $title as $tile) {
            $link->pages_id=$page->id;
            $link->users_id=$user->id;
            $link->title=$tile;
            $link->save();
        }
        
        return redirect('/biolinks/new')->with('ok',' link tervalidasi');
    }
}
