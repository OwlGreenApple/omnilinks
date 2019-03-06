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
	  	 $data_pixel=Pixel::where('users_id',Auth::user()->id)->get();
		  return view('user.dashboard.singlebiolinks',['data_pixel'=>$data_pixel]);
	  }
 	public function single(Request $request)
 	{
 		$link=new Link;
 		$user=Auth::User();
 		$link->pages_id=0;
  		$link->users_id=$user->id;
  		$link->pixel_id=$request->idpixel;
  		$link->link=$request->url;
  		$link->title=$request->title;
  		$link->save();
  		return redirect('/dash/newsingle')->with('ok','Link telah Ditambahkan');
 	}
 	public function singlepixel(Request $request)
 	{
 		$pixel= new Pixel();
 		$user=Auth::User();
 		$pixel->users_id=$user->id;
 		$pixel->pages_id=0;
 		$pixel->title=$request->titlepixel;
  		$pixel->script=$request->script;
  		$pixel->save();
  		return redirect('/dash/newsingle')->with('ok','pixel telah Ditambahkan');
 	}

}
