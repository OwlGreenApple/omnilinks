<?php
namespace App\Http\Controllers;
use App\Page;
use App\Link;
use App\User;
use App\Pixel;
use App\Banner;
use App\Ads;
use App\AdsHistory;
use App\Whatsapplink;

use App\Helpers\Helper;
use App\Mail\NotifClickFreeUser; 
use App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;
use Auth,Carbon,Validator,Storage,Mail;
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
  	return redirect('/biolinks/'.$uuid);
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
    $user = Auth::user();
    $pageCheck=Page::where('user_id',$user->id)
                      ->count();
    if ($user->membership=='free') {
      if ($pageCheck>=1) {
        return redirect('/')->with("error","Maaf Anda sudah tidak bisa membuat biolink lagi. Silahkan upgrade terlebih dahulu");
      }
    }
    else if ($user->membership=='basic') {
      if ($pageCheck>=3) {
        return redirect('/')->with("error","Maaf Anda sudah tidak bisa membuat biolink lagi. Silahkan upgrade terlebih dahulu"); 
      }
    }
    else if ($user->membership=='elite') {
      if ($pageCheck>=10) {
        return redirect('/')->with("error","Maaf Anda sudah tidak bisa membuat biolink lagi. Maksimal 10 biolink"); 
      }
    }


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
  
    $page=new Page();
  	$page->user_id=$user->id; 
  	$page->uid=$uuid;
  	$page->names=$generated_string; 
  	$page->save();

    return redirect('/biolinks/'.$uuid);  
  }

  public function viewpage($uuid)
  {	
 
  	$page=Page::where('uid','=',$uuid)->first();
  	$pageid=0;
    $links=Link::where('users_id',Auth::user()->id)
                ->where('pages_id',$page->id)
                ->orderBy('created_at')
                ->get();
    $banner=Banner::where('users_id',Auth::user()->id)
                  ->where('pages_id',$page->id)
                  ->get();
  	if(!is_null($page)){
  		$pageid=$page->id;
  	}
    
    return view('user.dashboard.biolinks')->with([
    	'uuid'=>$uuid,
      'pages'=>$page,
    	'pageid'=>$pageid,
      'banner'=>$banner,
      'links'=>$links,
    ]);  
  }
  
  public function link($names)
  {
    if ($names == "blog"){
      return redirect("blog");
    }
    else {
      $page = Page::where('names',$names) 
                ->orwhere('premium_names',$names) 
                ->first();

      if (is_null($page)) {
        $link = Link::where('names',$names)
                ->orwhere('premium_names',$names)
                ->first();

        /*if(is_null($link)){
          return "Page not found";
        } else {
          $pixel = Pixel::find($link->pixel_id);
          $script = "";
          if (!is_null($pixel)) {  
            $script = $pixel->script;  
          }

          return view('user.script')->with([
            'mode' => 'singlelinks',
            'script' => $script,
            'link' => $link->link,
          ]);
        }*/

        if(is_null($link)){
          return "Page not found";
        } else {
          $tes = $this->click('link',$link->id);
          return $tes;
        }
      }

      $user = User::find($page->user_id);
      
      $links = Link::where('pages_id','=',$page->id)
                ->orderBy('created_at','descend')
                ->get();

      $banner = Banner::where('pages_id','=',$page->id)
                  ->orderBy('created_at','ascend')
                  ->get();

      $sort_msg = array_filter(explode(';', $page->sort_msg));
      $sort_link = array_filter(explode(';', $page->sort_link));
      $sort_sosmed = array_filter(explode(';', $page->sort_sosmed));

      $links = $links->sortBy(function($model) use ($sort_link){
                return array_search($model->getKey(), $sort_link);
              });

      if($user->membership=='free'){
        $ads = Ads::where('credit','>=','2')
              ->inRandomOrder()->first();

        if(!is_null($ads)){
          $adshistory = new AdsHistory;
          $adshistory->user_id = $ads->user_id;
          $adshistory->ads_id = $ads->id;
          $adshistory->credit_before = $ads->credit;
          $adshistory->credit_after = $ads->credit - 1;
          $adshistory->jml_credit = 1;
          $adshistory->is_view = 1;
          $adshistory->description = 'view';
          $adshistory->save();

          $ads->credit = $ads->credit-1;
          $ads->save();
        }  
      } else {
        $ads = null;
      }
      

      return view('user.link.link')
              ->with('pages',$page)
              ->with('membership',$user->membership)
              ->with('links',$links)
              ->with('banner',$banner)
              ->with('sort_msg',$sort_msg)
              ->with('sort_link',$sort_link)
              ->with('sort_sosmed',$sort_sosmed)
              ->with('ads',$ads);
    }
  }

  public function pixelpage(Request $request)
  {
    $id = 0;

    $pixel=Pixel::where('users_id',Auth::user()->id)
                  ->where('pages_id','!=',0)
                  ->get();

    $arr['view']=(string) view('user.dashboard.contentpixelsinglelink')
                  ->with('data_pixel',$pixel);
    return $arr;
  }

  public function savetemp(Request $request)
  {
    $user=Auth::user();
    
    $validator = Validator::make($request->all(), [
      'judul' => ['required', 'string',  'max:255'],
      // 'link' => ['required', 'string', 'max:255'],
      // 'phone_no' => ['required', 'string', 'max:255'],
      // 'imagepages' => ['required', 'file'],
      // 'judulBanner.*' => ['required', 'string', 'max:255'],
      // 'linkBanner.*' => ['required', 'active_url', 'max:255'],
    ]); 
    
    if($validator->fails()) {
      $arr['status'] = 'error';
      $arr['message'] = $validator->errors()->first();
      return $arr;
    }
    
    $uuid=$request->uuidtemp;
    $page=Page::where('uid','=',$uuid)->first();
    $page->page_title=$request->judul;
    $page->description=$request->description;
    // $page->link_utama=$request->link;
    
    if(!is_null($request->file('imagepages')))
    {
      // $path = Storage::putFile('template',$request->file('imagepages')); 
      // $page->image_pages = $path;
      $dt = Carbon::now();
      $dir = 'photo_page/'.explode(' ',trim($user->name))[0].'-'.$user->id;
      $filename = $dt->format('ymdHi').'-'.$page->id.'.jpg';
      Storage::disk('s3')->put($dir."/".$filename, file_get_contents($request->file('imagepages')), 'public');
      $page->image_pages = $dir."/".$filename;
    }

    // $page->telpon_utama=$request->phone_no;

    // if ($request->backtheme=="") 
    if ($request->modeBackground=="solid") 
    {
       $page->template=null;
       $page->color_picker=$request->color;
       $page->wallpaper=null;
       $page->gif_template=null;
    }
    else if ($request->modeBackground=="gradient")  
    {
      $page->color_picker=null;
      $page->template=$request->backtheme;
      $page->wallpaper=null;
      $page->gif_template=null;
    }
    else if ($request->modeBackground=="wallpaper") 
    {
      $page->color_picker=null;
      $page->template=null;
      $page->wallpaper=$request->wallpaperclass;  
      $page->gif_template=null;
    }
    else if ($request->modeBackground=="animation") 
    {
      $page->color_picker=null;
      $page->template=null;
      $page->wallpaper=null;  
      $page->gif_template=$request->animationclass;  
    }

    $page->rounded=$request->colorButton;
    $page->outline=$request->colorOutlineButton;
    $page->is_rounded=$request->rounded;
    $page->is_outlined=$request->outlined;
    
    $page->powered=$request->powered;
    $page->text_color=$request->textColor;
    $page->is_text_color=$request->is_text_color;

    /*if(Auth::user()->membership=='elite'){
      $page->powered=0;
    } else {
      $page->powered=1;
    }*/
    
    $page->save();
    $names=$page->names;
    if ($user->membership=='basic' or  $user->membership=='elite') 
    {
      $idbanner=$request->idBanner;
      $statusbanner=$request->statusBanner;
    
      for($i=0;$i<count($request->judulBanner);$i++) 
      { 
        //pengecekan banner 
        $validator = Validator::make($request->all(), [
          'judulBanner.'.$i => ['required', 'string', 'max:255'],
          'linkBanner.'.$i => ['required', 'active_url', 'max:255'],
        ]); 

        if($validator->fails()) {
          $failedRules = $validator->failed();
        
          if(isset($failedRules['judulBanner.'.$i]['Required']) and isset($failedRules['linkBanner.'.$i]['Required'])){
            continue;
          } else {
            $arr['status'] = 'error';
            $arr['message'] = $validator->errors()->first();
            return $arr;
          }
        }
        
        if($request->hasFile('bannerImage.'.$i)) {
          $arr_size = getimagesize( $request->file('bannerImage')[$i] );
          $ratio_img = $arr_size[0] / $arr_size[1];
          if ($ratio_img<1.2)  {
            $arr['status'] = 'error';
            $temp = $i+1;
            $arr['message'] ='Image ke-'. $temp .' -> ratio width / height harus lebih besar dari 1.2';
            return $arr;
          }
        }

        if($idbanner[$i]==""){
          $banner= new Banner();
          if(!$request->hasFile('bannerImage.'.$i)) {
            $arr['status'] = 'error';
            $arr['message'] = 'Banner image is required';
            return $arr;
          }
        } else {
          if ($statusbanner[$i]=="delete"){
            $bannerde= Banner::find($request->idBanner[$i]);
            if (!is_null($bannerde)){
              $bannerde->delete();
            }
            continue;
          }
          $banner= Banner::where('id','=',$request->idBanner[$i])->first();
        }

        $banner->users_id=$user->id;
        $banner->pages_id=$page->id;
        $banner->title=$request->judulBanner[$i];
        $banner->link=$request->linkBanner[$i];
        $banner->pixel_id=$request->bannerpixel[$i];

        $banner->save(); 
        if($request->hasFile('bannerImage.'.$i)) {
          $dt = Carbon::now();
          $dir = 'banner/'.explode(' ',trim($user->name))[0].'-'.$user->id;
          $filename = $dt->format('ymdHi').'-'.$banner->id.'.jpg';
          if($idbanner[$i]==""){
            Storage::disk('s3')->put($dir."/".$filename, file_get_contents($request->file('bannerImage')[$i]), 'public');
            $banner->images_banner=$dir."/".$filename;
            $banner->save(); 
          } else {
            Storage::disk('s3')->put($banner->images_banner, file_get_contents($request->file('bannerImage')[$i]), 'public');
          }
        } 
        
      }
    }

    $arr['status'] = 'success';
    $short_link =env('SHORT_LINK');
    $arr['message'] = 'Letakkan link berikut di Bio Instagram <a href="https://'.$short_link.'/'.$names.'" target="_blank">'.$short_link.'/'.$names.'</a> &nbsp; <span class="btn-copy" data-link="https://'.$short_link.'/'.$names.'"><i class="fas fa-file"></i></span>';
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
    $validator = Validator::make($request->all(), [
      'wa' => [ 'max:255'],
      'telegram' => ['max:255'],
      'skype' => ['max:255'],
    ]); 
    
    if($validator->fails()) {
      $arr['status'] = 'error';
      $arr['message'] = $validator->errors()->first();
      return $arr;
    }
    
    
  	$uuid=$request->uuid;
  	$page=Page::where('uid','=',$uuid)->first();
  	$user=Auth::user();

    $wa = $request->wapixel;
    $twitter = $request->twitterpixel;
    $telegram = $request->telegrampixel;
    $youtube = $request->youtubepixel;
    $ig = $request->igpixel;
    $skype = $request->skypepixel;
    $fb = $request->fbpixel;
    $line = $request->linepixel;
    $messenger = $request->messengerpixel;

    $page->wa_pixel_id=$wa;
    $page->twitter_pixel_id=$twitter;
    $page->ig_pixel_id=$ig;
    $page->telegram_pixel_id=$telegram;
    $page->youtube_pixel_id=$youtube;
    $page->skype_pixel_id=$skype;
    $page->fb_pixel_id=$fb;
    $page->line_pixel_id=$line;
    $page->messenger_pixel_id=$messenger;

  	$page->wa_link=$request->wa;
  	$page->fb_link=$request->fb;
  	$page->twitter_link=$request->twitter;
  	$page->telegram_link=$request->telegram;
  	$page->skype_link=$request->skype;
  	$page->youtube_link=$request->youtube;
  	$page->ig_link=$request->ig;
    $page->line_link=$request->line;
    $page->messenger_link=$request->messenger;

    $page->is_click_bait=$request->is_click_bait;

  	$names=$page->names;
    $id=$request->idlink;
    $deletelink=$request->deletelink;
    $sort_link = '';
    for ($i=0; $i <count($request->title); $i++)
    { 
      if($id[$i]=='new')
      {
        $url=new Link();
      }
      else
      {
        if ($deletelink[$i]=='delete') {
          $linkku=Link::find($id[$i]);
          if (!is_null($linkku)){
            $linkku->delete();
          }
          continue;
        }
        $url=Link::where('id','=',$id[$i])->first();
      }

      // Pengecekan Link
      $validator = Validator::make($request->all(), [
        'title.'.$i => ['required', 'string', 'max:255'],
        'url.'.$i => ['required', 'active_url', 'max:255'],
      ]); 
      if($validator->fails()) {
        $arr['status'] = 'error';
        $arr['message'] = $validator->errors()->first();
        return $arr;
      }

      $url->pages_id=$page->id;
      $url->names=null;
      $url->users_id=$user->id;
      $url->title=$request->title[$i];
      $url->link=$request->url[$i];
      $url->pixel_id = $request->linkpixel[$i];
      $url->save();

      /*if($sort_link=='')
      {
        $sort_link = $url->id.'-12';
      } 
      else {
        $sort_link = $sort_link.';'.$url->id.'-12';
      }*/
      if($url->id<>''){
        $sort_link .= $url->id.';';
      }
    }

    $sort_msg = '';
    
    if($request->has('sortmsg'))
    {
      $countmsg = 12/count($request->sortmsg);

      foreach ($request->sortmsg as $msg) {
        /*if($sort_msg==''){
          $sort_msg = $msg.'-'.$countmsg;
        } else {
          $sort_msg = $sort_msg.';'.$msg.'-'.$countmsg;
        }*/
        if($msg<>''){
          $sort_msg .= $msg.';';
        }
      }

      // if(strpos($sort_msg, 'wa')==false and $page->wa_link!=''){
        // $sort_msg .= 'wa;';
      // }
    } 
      
    $sort_sosmed = '';
    if($request->has('sortsosmed')){
      $countsosmed = count($request->sortsosmed);
      $mod = count($request->sortsosmed)%3;
      $div = floor(count($request->sortsosmed)/3);
      $col = 0;
      $colmod = 0;
      if($mod>0){
        $colmod = 12/$mod;
      } 
      if($div>0){
        $col = 12/3;
      }

      $count = 0;
      $countdiv = 0;
      foreach ($request->sortsosmed as $sosmed) {
        /*if($sort_sosmed==''){
          if($countdiv==$div){
            $sort_sosmed = $sosmed.'-'.$colmod;
          } else {
            $sort_sosmed = $sosmed.'-'.$col;
          }
        } else {
          if($countdiv==$div){
            $sort_sosmed = $sort_sosmed.';'.$sosmed.'-'.$colmod;
          } else {
            $sort_sosmed = $sort_sosmed.';'.$sosmed.'-'.$col;
          }
        }*/
        if($sosmed<>''){
          $sort_sosmed .= $sosmed.';';
        }
        
        $count = $count+1;
        if($count>=3)
        {
          $count=0;
          $countdiv=1;
        }
      }

      // if(strpos($sort_sosmed, 'youtube')==false and $page->youtube_link!=''){
        // $sort_sosmed .= 'youtube;';
      // }
    }

    $page->sort_link = $sort_link;
    $page->sort_msg = $sort_msg;
    $page->sort_sosmed = $sort_sosmed;
    $page->save();

    if((is_null($page->wa_link) && is_null($page->skype_link) && !is_null($page->telegram_link)) || (!is_null($page->wa_link) && is_null($page->skype_link) && is_null($page->telegram_link)) || (is_null($page->wa_link) && !is_null($page->skype_link) && is_null($page->telegram_link)))
    {
     $page->colom='links-num-1';
    }
    elseif((!is_null($page->wa_link) && is_null($page->skype_link) && !is_null($page->telegram_link)) || (!is_null($page->wa_link) && !is_null($page->skype_link) && is_null($page->telegram_link)) || (is_null($page->wa_link) && !is_null($page->skype_link) && !is_null($page->telegram_link))) 
    {
      $page->colom='links-num-2';
    }
    elseif(!is_null($page->wa_link) && !is_null($page->skype_link) && !is_null($page->telegram_link))
    {
      $page->colom='links-num-3';
    }
    
    if ((is_null($page->fb_link)&& is_null($page->ig_link) && is_null($page->twitter_link) && !is_null($page->youtube_link))||(is_null($page->fb_link)&& is_null($page->ig_link) && !is_null($page->twitter_link) && is_null($page->youtube_link))||(is_null($page->fb_link) && !is_null($page->ig_link) && is_null($page->twitter_link) && is_null($page->youtube_link))||(!is_null($page->fb_link)&& is_null($page->ig_link) && is_null($page->twitter_link) && is_null($page->youtube_link))) 
    {
      $page->colom_sosmed='col-md-12 col-12 text-center';
    }
    elseif((is_null($page->fb_link)&& is_null($page->ig_link) && !is_null($page->twitter_link) && !is_null($page->youtube_link))||(is_null($page->fb_link)&& !is_null($page->ig_link) && is_null($page->twitter_link) && !is_null($page->youtube_link))||(!is_null($page->fb_link) && is_null($page->ig_link) && is_null($page->twitter_link) && !is_null($page->youtube_link))||(!is_null($page->fb_link)&& !is_null($page->ig_link) && is_null($page->twitter_link) && is_null($page->youtube_link))||(!is_null($page->fb_link)&& is_null($page->ig_link) && !is_null($page->twitter_link) && is_null($page->youtube_link))||(is_null($page->fb_link)&& !is_null($page->ig_link) && !is_null($page->twitter_link) && is_null($page->youtube_link)))
    {
      $page->colom_sosmed='col-md-6 col-6 text-center';
    }
    elseif ((is_null($page->fb_link)&& !is_null($page->ig_link) && !is_null($page->twitter_link) && !is_null($page->youtube_link))||(!is_null($page->fb_link)&& !is_null($page->ig_link) && !is_null($page->twitter_link) && is_null($page->youtube_link))||(!is_null($page->fb_link) && !is_null($page->ig_link) && is_null($page->twitter_link) && !is_null($page->youtube_link))||(!is_null($page->fb_link)&& is_null($page->ig_link) && !is_null($page->twitter_link) && !is_null($page->youtube_link))) 
    {
       $page->colom_sosmed='col-md-4 col-4 text-center';
    }
    elseif(!is_null($page->fb_link) && !is_null($page->ig_link) && !is_null($page->twitter_link) && !is_null($page->youtube_link))
    {
      $page->colom_sosmed='col-md-3 col-3 text-center';
    }
    $page->save();

    $arr['status'] = 'success';

    $short_link = env('SHORT_LINK');
    $arr['message'] ='Letakkan link berikut di Bio Instagram <a href="https://'.$short_link.'/'.$names.'" target="_blank">'.$short_link.'/'.$names.'</a> &nbsp; <span class="btn-copy" data-link="https://'.$short_link.'/'.$names.'"><i class="fas fa-file"></i></span>';
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
    $pixel->jenis_pixel=$request->jenis_pixel;
  	$pixel->script=$request->script;
  	$pixel->save();
  	return redirect('/biolinks/'.$uuid);
  }

  public function loadpixel(Request $request)
  {
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

  public function make_file($date,$pageid,$name,$username){
    $folder = 'clicked/'.$username.'/'.$date.'/'.$pageid.'/'.$name.'/';
    $filename = 'counter.txt';
    
    $counter = 0;
    $root_folder = "";
    // if ( env('APP_ENV') !== "local" ) {
      // env('SHORT_LINK')
      // $root_folder = "/home2/omnilinkz/public_html/dashboard/";
    // }
    
    /*if(file_exists($root_folder.'storage/app/'.$folder.$filename)){
      $myfile = fopen($root_folder.'storage/app/'.$folder.$filename, "r") or die("Unable to open file!");
      $content = (int)fread($myfile, filesize($root_folder.'storage/app/'.$folder.$filename));
      $counter = $content + 1;
      fclose($myfile);
    } else {
      $counter = 1;
    }*/
    
    if (Storage::disk('s3')->has($folder.$filename)) {
      // $counter = file_get_contents(Storage::disk('s3')->url($filename));
      $counter = Storage::disk('s3')->get($folder.$filename);
      $counter += 1;
    } 
    else {
      $counter = 1;
    }

    // if ( env('APP_ENV') == "local" ) {
      Storage::disk('s3')->put($folder.$filename,$counter);
    // }
    // else if ( env('APP_ENV') !== "local" ) {
      // mkdir($root_folder.'storage/app/'.$folder,0755,true);
      // file_put_contents($root_folder.'storage/app/'.$folder.$filename, $counter);
    // }
  }

  public function click($mode,$id){

    if($mode=='link'){
      $link = Link::find($id);
      //$user = User::find($link->user_id);
      $user = User::find($link->users_id);
    } else if($mode=='banner'){
      $banner = Banner::find($id);
      //$user = User::find($banner->user_id);
      $user = User::find($banner->users_id);
    } else {
      $pages = Page::find($id);
      $user = User::find($pages->user_id);
    }

    $filename = 'clicked/'.$user->username.'/'.date('m-Y').'/all/total-click/counter.txt';

    $dash = new DashboardController;
    $clicks = $dash->check_file($filename);

    if($user->membership=='free'){
      if($clicks==800){
        Mail::to($user->email)->queue(new NotifClickFreeUser($user->email,$user,$clicks));
      }

      if($clicks>=1000){
        return abort(404);
      }
    }

    //function redirect link
    if($mode=='link'){
      //$link = Link::find($id);
      $link->counter = $link->counter+1;
      $link->save();

      $this->make_file(date('d-m-Y'),$link->pages_id,'link-'.$link->title,$user->username);
      $this->make_file(date('d-m-Y'),$link->pages_id,'total-click',$user->username);
      $this->make_file(date('d-m-Y'),'all','total-click',$user->username);
      $this->make_file(date('m-Y'),$link->pages_id,'link-'.$link->title,$user->username);
      $this->make_file(date('m-Y'),$link->pages_id,'total-click',$user->username);
      $this->make_file(date('m-Y'),'all','total-click',$user->username);

      $pixel = Pixel::find($link->pixel_id);
      $script = "";
      if (!is_null($pixel)) {
        //jalanin pixel
        //echo "<script>";
        $script =  $pixel->script;
        //echo "</script>";

      }
      // return redirect($link->link);
      return view('user.script')->with([
        'user' => $user,
        'mode' => $mode,
        'script' => $script,
        'link' => $link->link,
      ]);

    } 
    else if($mode=='banner'){
      //$banner = Banner::find($id);
      $banner->counter = $banner->counter+1;
      $banner->save();

      $this->make_file(date('d-m-Y'),$banner->pages_id,'banner-'.$banner->title,$user->username);
      $this->make_file(date('d-m-Y'),$banner->pages_id,'total-click',$user->username);
      $this->make_file(date('d-m-Y'),'all','total-click',$user->username);
      $this->make_file(date('m-Y'),$banner->pages_id,'banner-'.$banner->title,$user->username);
      $this->make_file(date('m-Y'),$banner->pages_id,'total-click',$user->username);
      $this->make_file(date('m-Y'),'all','total-click',$user->username);

      $pixel = Pixel::find($banner->pixel_id);
      $script = "";
      if (!is_null($pixel)) {
        //jalanin pixel
        //echo "<script>";
        $script = $pixel->script;
        //echo "</script>";
      }
      // return redirect($banner->link);
      return view('user.script')->with([
        'user' => $user,
        'mode' => $mode,
        'script' => $script,
        'link' => $banner->link,
      ]);
    } 
    else {
      //$pages = Page::find($id);

      switch ($mode) {
        case "wa":
          $pages->wa_link_counter = $pages->wa_link_counter+1;
          $link = 'https://api.whatsapp.com/send?phone='.$pages->wa_link;
          $idpixel = $pages->wa_pixel_id;
        break;
        case "telegram":
          $pages->telegram_link_counter = $pages->telegram_link_counter+1;
          $link = 'https://t.me/'.$pages->telegram_link;
          $idpixel = $pages->telegram_pixel_id;
        break;
        case "skype":
          $pages->skype_link_counter = $pages->skype_link_counter+1;
          $link = 'skype:'.$pages->skype_link.'?chat';
          $idpixel = $pages->skype_pixel_id;
        break;
        case "line":
          $pages->line_link_counter = $pages->line_link_counter+1;
          $link = 'https://line.me/ti/p/~'.$pages->line_link;
          $idpixel = $pages->line_pixel_id;
        break;
        case "messenger":
          $pages->messenger_link_counter = $pages->messenger_link_counter+1;
          $link = 'http://m.me/'.$pages->messenger_link;
          $idpixel = $pages->messenger_pixel_id;
        break;
        case "youtube":
          $pages->youtube_link_counter = $pages->youtube_link_counter+1;
          $link = $pages->youtube_link;
          $idpixel = $pages->youtube_pixel_id;
        break;
        case "fb":
          $pages->fb_link_counter = $pages->fb_link_counter+1;
          $link = "https://facebook.com/".$pages->fb_link;
          $idpixel = $pages->fb_pixel_id;
        break;
        case "twitter":
          $pages->twitter_link_counter = $pages->twitter_link_counter+1;
          $link = "https://twitter.com/".$pages->twitter_link;
          $idpixel = $pages->twitter_pixel_id;
        break;
        case "ig":
          $pages->ig_link_counter = $pages->ig_link_counter+1;
          $link = "https://instagram.com/".$pages->ig_link;
          $idpixel = $pages->ig_pixel_id;
        break;
      }
      $pages->save();

      $this->make_file(date('d-m-Y'),$pages->id,$mode,$user->username);
      $this->make_file(date('d-m-Y'),$pages->id,'total-click',$user->username);
      $this->make_file(date('d-m-Y'),'all','total-click',$user->username);
      $this->make_file(date('m-Y'),$pages->id,$mode,$user->username);
      $this->make_file(date('m-Y'),$pages->id,'total-click',$user->username);
      $this->make_file(date('m-Y'),'all','total-click',$user->username);

      $pixel = Pixel::find($idpixel);
      $script = "";
      if (!is_null($pixel)) {
        //jalanin pixel
        //echo "<script>";
        $script = $pixel->script;
        //echo "</script>";
      }
      // return redirect($link);

      return view('user.script')->with([
        'user' => $user,
        'mode' => $mode,
        'script' => $script,
        'link' => $link,
      ]);
    }
  }

  public function delete_photo(Request $request){
    $page=Page::where('uid','=',$request->id)->first();

    if($page->image_pages!=''){
      Storage::disk('s3')->delete($page->image_pages);
      $page->image_pages = null;
      $page->save();
    }

    $arr['status'] = 'success';
    $arr['message'] = 'Delete picture berhasil';

    return $arr;
  }

  public function loadLinkBio(Request $request){
  	$links=Link::where('users_id',Auth::user()->id)
                  ->where('pages_id',$request->id)
  					// ->orderBy('created_at')
            ->get();
  					//dd($pixels);
    $page = Page::find($request->id);
    $sort_link = array_filter(explode(';', $page->sort_link));
    $links = $links->sortBy(function($model) use ($sort_link){
              return array_search($model->getKey(), $sort_link);
            });
            
  	$arr['view'] =(string) view('user.dashboard.load.link')
                    ->with('links',$links);
     return $arr;
  }
}
