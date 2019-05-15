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
    $user = Auth::user();
    $pageCheck=Page::where('user_id',$user->id)
                      ->count();
    if ($user->membership=='free') {
      if ($pageCheck>=1) {
        return redirect('/dash')->with("error","maaf anda sudah tidak bisa membuat pages lagi,silahkan upgrade terlebih dahulu");
      }
    }
    else if ($user->membership=='basic') {
      if ($pageCheck>=5) {
        return redirect('/dash')->with("error","maaf anda sudah tidak bisa membuat pages lagi,silahkan upgrade terlebih dahulu"); 
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

    return redirect('/dash/new/'.$uuid);  
  }

  public function viewpage($uuid)
  {	
 
  	$page=Page::where('uid','=',$uuid)->first();
  	$pageid=0;
    $links=Link::where('users_id',Auth::user()->id)
                ->where('pages_id',$page->id)
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
    $page=Page::where('names',$names)  
              ->first();
    return view('user.link.link')->with('pages',$page);
  }

  public function pixelpage()
  {
    $pixel=Pixel::where('users_id',Auth::user()->id)
                  ->where('pages_id','!=',0)
                  ->get();

    $arr['view']=(string) view('user.dashboard.contentpixelsinglelink')
                  ->with('data_pixel',$pixel);
    return $arr;
  }

  public function savetemp(Request $request)
  {
    $uuid=$request->uuidtemp;
    $page=Page::where('uid','=',$uuid)->first();
    $page->page_title=$request->judul;
    $page->link_utama=$request->link;
    
    if(!is_null($request->file('imagepages')))
    {
      $path = Storage::putFile('template',$request->file('imagepages')); 
      $page->image_pages = $path;
    }

    $page->telpon_utama=$request->nomor;

    // if ($request->backtheme=="") 
    if ($request->modeBackground=="solid") 
    {
       $page->template=null;
       $page->color_picker=$request->color;
    }
    else if ($request->modeBackground=="gradient") 
    {
      $page->color_picker=null;
      $page->template=$request->backtheme;  
    }

    $page->rounded=$request->colorButton;
    $page->outline=$request->colorOutlineButton;
    $page->is_rounded=$request->rounded;
    $page->is_outlined=$request->outlined;
    
    if($request->powered=='powered'){
      $page->powered=1;
    }
    
    $page->save();
    $names=$page->names;
    if (Auth::user()->membership=='basic' or  Auth::user()->membership=='elite') 
    {
      $idbanner=$request->idBanner;
      $statusbanner=$request->statusBanner;
      //dd($request->all());
      for($i=0;$i<count($request->judulBanner);$i++) 
      { 
        
        
        if($idbanner[$i]==""){
          $banner= new Banner(); 
        } else {
          if ($statusbanner[$i]=="delete") 
        {
          $bannerde= Banner::find($request->idBanner[$i])->delete();
          continue;
        }
          $banner= Banner::where('id','=',$request->idBanner[$i])->first();
        }
        $user=Auth::user();
        $banner->users_id=$user->id;
        $banner->pages_id=$page->id;
        $banner->title=$request->judulBanner[$i];
        $banner->link=$request->linkBanner[$i];
        $banner->pixel_id=$request->bannerpixel[$i];

        if($request->hasFile('bannerImage.'.$i)) {
          $dir = 'banner/'.Auth::user()->email.'/'.$banner->title;
          //$filename = $request->file('bannerImage')[$i]->getClientOriginalName();
          $filename = $banner->title.'.jpg';

          $path1=Storage::putFileAs($dir,$request->file('bannerImage')[$i],$filename);  
          $banner->images_banner=$path1;
        } 
        
        $banner->save(); 
      }
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
  	$title=$request->title;
  	$link=$request->url;
    $id=$request->idlink;
    $deletelink=$request->deletelink;
    $sort_link = '';
    for ($i=0; $i <count($title); $i++)
    { 
      if($id[$i]=='new')
      {
        $url=new Link();
      }
      else
      {
        if ($deletelink[$i]=='delete') {
          $linkku=Link::find($id[$i])->delete();
          continue;
        }
        $url=Link::where('id','=',$id[$i])->first();
      }

      $url->pages_id=$page->id;
      $url->names=null;
      $url->users_id=$user->id;
      $url->title=$title[$i];
      $url->link=$link[$i];
      $url->save();

      if($sort_link=='')
      {
        $sort_link = $url->id.'-12';
      } else
      {
        $sort_link = $sort_link.';'.$url->id.'-12';
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
        $sort_msg .= $msg.';';
      }
    }
      
    $sort_sosmed = '';
    if($request->has('sosmed')){
      $countsosmed = count($request->sosmed);
      $mod = count($request->sosmed)%3;
      $div = floor(count($request->sosmed)/3);
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
      foreach ($request->sosmed as $sosmed) {
        if($sort_sosmed==''){
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
        }

        $count = $count+1;
        if($count>=3)
        {
          $count=0;
          $countdiv=1;
        }
      }
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

    $arr['message'] ='Letakkan link berikut di Bio Instagram <a href="omn.lkz/'.$names.'">omn.lkz/'.$names.'</a><i class="fas fa-file"></i';
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

  public function make_file($date,$pageid,$name){
    $filename = 'clicked/'.Auth::user()->email.'/'.$date.'/'.$pageid.'/'.$name.'/counter.txt';

    $counter = 0;

    if(file_exists('storage/app/'.$filename)){
      $myfile = fopen('storage/app/'.$filename, "r") or die("Unable to open file!");
      $content = (int)fread($myfile, filesize('storage/app/'.$filename));
      $counter = $content + 1;
      fclose($myfile);
    } else {
      $counter = 1;
    }

    Storage::put($filename,$counter);
  }

  public function click($mode,$id){
    if($mode=='link'){
      $link = Link::find($id);
      $link->counter = $link->counter+1;
      $link->save();

      $this->make_file(date('d-m-Y'),$link->pages_id,'link-'.$link->title);
      $this->make_file(date('d-m-Y'),$link->pages_id,'total-click');
      $this->make_file(date('d-m-Y'),'all','total-click');
      $this->make_file(date('m-Y'),$link->pages_id,'link-'.$link->title);
      $this->make_file(date('m-Y'),$link->pages_id,'total-click');
      $this->make_file(date('m-Y'),'all','total-click');

      $pixel = Pixel::find($link->pixel_id);

      //jalanin pixel
      //echo "<script>";
      echo $pixel->script;
      //echo "</script>";

      return redirect($link->link);

    } else if($mode=='banner'){
      $banner = Banner::find($id);
      $banner->counter = $banner->counter+1;
      $banner->save();

      $this->make_file(date('d-m-Y'),$banner->pages_id,'banner-'.$banner->title);
      $this->make_file(date('d-m-Y'),$banner->pages_id,'total-click');
      $this->make_file(date('d-m-Y'),'all','total-click');
      $this->make_file(date('m-Y'),$banner->pages_id,'banner-'.$banner->title);
      $this->make_file(date('m-Y'),$banner->pages_id,'total-click');
      $this->make_file(date('m-Y'),'all','total-click');

      $pixel = Pixel::find($banner->pixel_id);

      //jalanin pixel
      //echo "<script>";
      echo $pixel->script;
      //echo "</script>";

      return redirect($banner->link);

    } else {
      $pages = Page::find($id);

      switch ($mode) {
        case "wa":
          $pages->wa_link_counter = $pages->wa_link_counter+1;
          $link = $pages->wa_link;
          $idpixel = $pages->wa_pixel_id;
        break;
        case "telegram":
          $pages->telegram_link_counter = $pages->telegram_link_counter+1;
          $link = $pages->telegram_link;
          $idpixel = $pages->telegram_pixel_id;
        break;
        case "skype":
          $pages->skype_link_counter = $pages->skype_link_counter+1;
          $link = $pages->skype_link;
          $idpixel = $pages->skype_pixel_id;
        break;
        case "youtube":
          $pages->youtube_link_counter = $pages->youtube_link_counter+1;
          $link = $pages->youtube_link;
          $idpixel = $pages->youtube_pixel_id;
        break;
        case "fb":
          $pages->fb_link_counter = $pages->fb_link_counter+1;
          $link = $pages->fb_link;
          $idpixel = $pages->fb_pixel_id;
        break;
        case "twitter":
          $pages->twitter_link_counter = $pages->twitter_link_counter+1;
          $link = $pages->twitter_link;
          $idpixel = $pages->twitter_pixel_id;
        break;
        case "ig":
          $pages->ig_link_counter = $pages->ig_link_counter+1;
          $link = $pages->ig_link;
          $idpixel = $pages->ig_pixel_id;
        break;
      }
      $pages->save();

      $this->make_file(date('d-m-Y'),$pages->id,$mode);
      $this->make_file(date('d-m-Y'),$pages->id,'total-click');
      $this->make_file(date('d-m-Y'),'all','total-click');
      $this->make_file(date('m-Y'),$pages->id,$mode);
      $this->make_file(date('m-Y'),$pages->id,'total-click');
      $this->make_file(date('m-Y'),'all','total-click');

      $pixel = Pixel::find($idpixel);
      //jalanin pixel
      //echo "<script>";
      echo $pixel->script;
      //echo "</script>";

      return redirect($link);

    }
  }

}
