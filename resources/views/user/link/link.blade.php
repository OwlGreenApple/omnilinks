<?php 
	use App\Link;
	use App\Banner;
 ?>
<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta property="og:type" content="article">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/template.css')}}">
	<link rel="stylesheet" href="{{asset('css/dash.css')}}">
	<style type="text/css">
		.rows{
			margin-top: -15px;
			padding-right: 25px;
			padding-left: 23px;
		}
		.row{
			margin-right: -10px;

		}
	</style>
	<title>Link</title>
	</head>
	@if(is_null($pages->template))
	<body style=" color:#fff; {{$pages->color_picker}}" class="a {{$pages->rounded}} {{$pages->outline}}">
	@else
	<body class="{{$pages->template}} {{$pages->rounded}} {{$pages->outline}}" >
	@endif
	<header class="container">
		<div class="row">
			<div class="col-md-3 col-3 p-4">
				@if(is_null($pages->image_pages))
				 <img src="https://pngimage.net/wp-content/uploads/2018/06/no-avatar-png.png" class="imagetitle">
				 @else
				  <img src="<?php echo url(Storage::disk('local')->url('app/'.$pages->image_pages));?>" class="imagetitle" >
				 @endif
			</div>
			<div class="col-md-8 col-8 p-4">
				<ul class="ultitle">
				@if(is_null($pages->page_title))
				  <li style="display: block; margin-bottom: 1px;"><p class="font-weight-bold">NO PAGE TITLE</p></li>
				 @else
				  <li style="display: block; margin-bottom: 1px;">{{$pages->page_title}}</li>
				 @endif
				 @if(is_null($pages->link_utama))
				  <li style="display: block; margin-bottom: -15px;"><p class="font-weight-bold">NO LINK TITLE</p></li>
				 @else
				  <li style="display: block; margin-bottom: -15px; font-size:smaller;  word-break: break-all;" ><p class="font-weight-bold">{{$pages->link_utama}}</p></li>
				 @endif
				 @if(is_null($pages->telpon_utama))
				  <li style="display: block"><p class="font-weight-bold">NO PHONE</p></li>
				 @else
				  <li style="display: block; margin-top: -4px;"><p class="font-weight-bold">{{$pages->telpon_utama}}</p></li>
				 @endif
				</ul>
			</div>
		</div>
	</header>
<?php
  $link=Link::where('pages_id','=',$pages->id)
        ->orderBy('created_at','ascend')
        ->get();
  $banner=Banner::where('pages_id','=',$pages->id)
        ->orderBy('created_at','ascend')
        ->get();
 ?>
	<div class="galleryContainer">
    <div class="slideShowContainer">
        <div onclick="plusSlides(-1)" class="nextPrevBtn leftArrow"><span class="arrow arrowLeft"></span></div>
        <div onclick="plusSlides(1)" class="nextPrevBtn rightArrow" id="right"><span class="arrow arrowRight"></span></div>
        <div class="captionTextHolder"><p class="captionText slideTextFromTop"></p></div>
        @if(is_null($banner[0]->images_banner))
      <div></div>
        @else
        @foreach($banner as $banner)
        <div class="imageHolder">
            <img src="<?php echo url(Storage::disk('local')->url('app/'.$banner->images_banner));?>">
            <p class="captionText"></p>
        </div>
       @endforeach
       @endif
    </div>
    <div id="dotsContainer"></div>
  </div>

<div class="container biolink-page" style="margin-top: 33px">
	<header></header>
	<div class="row" style="margin-bottom: 13px;">
	@if(!is_null($pages->wa_link) || $pages->wa_pixel_id!=0)
	  <div class="{{$pages->colom}}">
        <a href="#" title="wa" class="btn btn-light"><i class="fab fa-whatsapp"></i><span style="font-size: medium;"> Whatsapp</span></a>
	  </div>
	  @endif
	  @if(!is_null($pages->skype_link) || $pages->skype_pixel_id!=0)
      <div class="{{$pages->colom}}">
        <a href="#" title="Skype" class="btn btn-light"><i class="fab fa-skype"></i><span style="font-size: medium;"> Skype</span></a>
	  </div>
	  @endif
	  @if(!is_null($pages->telegram_link) || $pages->telegram_pixel_id!=0)
      <div class="{{$pages->colom}}">
        <a href="#" title="Telegram" class="btn btn-light"><i class="fab fa-telegram-plane"></i><span style="font-size: medium;"> Telegram</span></a>
      </div>
      @endif
      @if(!is_null($pages->wa_link) || $pages->wa_pixel_id!=0 and !is_null($pages->skype_link) || $pages->skype_pixel_id!=0 and !is_null($pages->telegram_link) || $pages->telegram_pixel_id!=0)
      <div></div>
      @endif	
	</div>

<div class="row">
	@foreach($link as $link)
	<div class="col-md-12 col-12" style="margin-bottom: 10px; margin-top: -5px;"> 
	<a href="" title="" class="btn btn-light"><span>{{$link->title}}</span></a>
	</div>
	@endforeach
	<div class="col-md-12 col-12" style="margin-bottom: 10px; margin-top: -5px;"> 
	<a href="" title="" class="btn btn-light"><span>tes</span></a>
	</div>
</div>

	<div class="row rows">
	@if(!is_null($pages->fb_link) || $pages->fb_pixel_id!=0)
	   <div class="{{$pages->colom_sosmed}} linked">
	   <a href="#" title="fb"><i class="fab fa-facebook-f"></i></a>
	   </div>
	@endif

	 @if(!is_null($pages->ig_link) || $pages->ig_pixel_id!=0)
	   <div class="{{$pages->colom_sosmed}} linked">
	   <a href="#" title="ig"><i class="fab fa-instagram"></i></a>	
	   </div>  
     @endif

	@if(!is_null($pages->twitter_link) || $pages->twitter_pixel_id!=0)
	   <div class="{{$pages->colom_sosmed}} linked">
	   <a href="#" title="Twitter"><i class="fab fa-twitter-square"></i></a>
	   </div>
	 @endif
	 
	 @if(!is_null($pages->youtube_link) || $pages->youtube_pixel_id!=0)
  	   <div class="{{$pages->colom_sosmed}} linked">
	   <a href="#" title="Youtube"><i class="fab fa-youtube"></i></a>
	   </div>
     @endif
    
	</div>
</div>
@if(!is_null($pages->powerede))
<div class="powered-omnilinks"><a href=""><span style="font-size: small;">Powered by</span><br>&nbsp;&nbsp;<img style="width: 100px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
</a>
</div>
@else
<div></div>
@endif
<div></div>
<script src="{{asset('js/myScript.js')}}"></script>
</body>

</html>