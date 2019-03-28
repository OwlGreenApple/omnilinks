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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('css/template.css')}}">
	<link rel="stylesheet" href="{{asset('css/dash.css')}}">
	<title>Link</title>
	</head>
	@if(is_null($pages->template))
	<body style=" color:#fff; {{$pages->color_picker}}" class="a {{$pages->rounded}} {{$pages->outline}}">
	@else
	<body class="{{$pages->template}} {{$pages->rounded}} {{$pages->outline}}" >
	@endif
	<header class="container notif">
		<div class="row">
			<div class="col-md-3 col-3">
				@if(is_null($pages->image_pages))
				 <img src="https://pngimage.net/wp-content/uploads/2018/06/no-avatar-png.png" style="border-radius: 50%;">
				 @else
				  <img src="<?php echo url(Storage::disk('local')->url('app/'.$pages->image_pages));?>" style="border-radius: 50%; width: 200px; height: 200px;">
				 @endif
			</div>
			<div class="col-md-3 col-3">
				<ul style="bottom: 31px; font-size: large; margin-left: 112px;">
				  <li style="display: block; margin-bottom: 50px;">{{$pages->page_title}}</li>
				  <li style="display: block; margin-bottom: 50px;">{{$pages->link_utama}}</li>
				  <li style="display: block">{{$pages->telpon_utama}}</li>
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
        <div onclick="plusSlides(1)" class="nextPrevBtn rightArrow"><span class="arrow arrowRight"></span></div>
        <div class="captionTextHolder"><p class="captionText slideTextFromTop"></p></div>
        @if(!$banner->count())
         <div class="imageHolder">
            <img src="https://smkn7-smr.sch.id/uploads/konten/no_image.jpg">
            <p class="captionText"></p>
        </div>
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


	<div class="container biolink-page" style="margin-top: 20px">
	<header></header>
	<div class="row" style="margin-bottom: 50px;">
	@if(!is_null($pages->wa_link) || !is_null($pages->wa_pixel_id))
	  <div class="{{$pages->colom}}">
        <a href="#" title="wa" class="btn btn-light"><i class="fab fa-whatsapp"></i></a>
	  </div>
	  @endif
	  @if(!is_null($pages->skype_link) || !is_null($pages->skype_pixel_id))
      <div class="{{$pages->colom}}">
        <a href="#" title="Skype" class="btn btn-light"><i class="fab fa-skype"></i></a>
	  </div>
	  @endif
	  @if(!is_null($pages->telegram_link) || !is_null($pages->telegram_pixel_id))
      <div class="{{$pages->colom}}">
        <a href="#" title="Telegram" class="btn btn-light"><i class="fab fa-telegram-plane"></i></a>
      </div>
      @endif	
	</div>

<div class="row">
	@foreach($link as $link)
	<div class="col-md-12 col-12" style="margin-bottom: 20px;"> 
	<a href="{{$link->link}}" title="" class="btn btn-light"><span>{{$link->title}}</span></a>
	</div>
	@endforeach
	</ul>
	</div>
	<div class="row rows">

	@if(!is_null($pages->twitter_link)|| !is_null($pages->twitter_pixel_id))
	   <div class="col-md-3 col-3 linked">
	   <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
	   </div>
   @endif
   @if(!is_null($pages->fb_link)|| !is_null($pages->fb_pixel_id))
	   <div class="col-md-3 col-3 linked">
	   <a href="#" title="fb"><i class="fab fa-facebook-f"></i></a>
	   </div>
   @endif
   @if(!is_null($pages->youtube_link)|| !is_null($pages->youtube_pixel_id))
	   <div class="col-md-3 col-3 linked">
	   <a href="#" title="Youtube"><i class="fab fa-youtube"></i></a>
	   </div>
	@endif
	@if(!is_null($pages->ig_link)|| !is_null($pages->ig_pixel_id))
	   <div class="col-md-3 col-3 linked">
	   <a href="#" title="ig"><i class="fab fa-instagram"></i></a>	
	   </div>
	 @endif
	</div>
</div>
@if(!is_null($pages->powerede))
<div class="powered-omnilinks"><a href=""><span style="font-size: small;">Powered by</span><br>&nbsp;&nbsp;<span class="logo">Omnilinks</span>
</a>
</div>
@else
<div></div>
@endif

<script src="{{asset('js/myScript.js')}}"></script>
</body>

</html>