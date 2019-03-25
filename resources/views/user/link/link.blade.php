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
 <script src="{{ asset('js/jquery112.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/linkmain.css')}}">
	<link rel="stylesheet" href="{{asset('css/dash.css')}}">
	<title>Link</title>
	</head>d
	<body class="gradient1-theme rounded-buttons outlined-buttons">

	<header class="container notif">
		<div class="row">
			<div class="col-md-3">
				<img src="<?php echo url(Storage::disk('local')->url('app/'.$pages->image_pages)); ?>"  class="imga" style="width: 70px;">
			</div>
			<div class="col-md-3">
				<p>{{$pages->page_title}}</p>
				<p>{{$pages->link_utama}}</p>
				<p>{{$pages->telpon_utama}}</p>
			</div>
		</div>
	</header>
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
	<div class="container biolink-page">
	<header></header>
	
	<ul class="links messengers links-num-6">
	<li class="link"><a href="/prPx" title="Email" class="btn"><i class="fas fa-envelope"></i><span>Email</span></a></li>
	<li class="link"><a href="/prPx" title="Email" class="btn"><i class="fas fa-envelope"></i></a></li>
	<li class="link"><a href="/ABpr" title="Skype" class="btn"><i class="fab fa-skype"></i></a></li>

	<li class="link"><a href="/Ohlr" title="Telegram" class="btn"><i class="fab fa-telegram-plane"></i></a></li>
	<li class="link"><a href="/s9DA" title="WhatsApp" class="btn"><i class="fab fa-whatsapp"></i></a></li>

	<li class="link"><a href="/u605" title="Messenger" class="btn"><i class="fab fa-facebook-messenger"></i></a></li>
	</ul>

	<ul class="links buttons">
	@foreach($links as $link) 
	<li class="link"><a href="{{$link->link}}" title="" class="btn"><span>{{$link->title}}</span></a>
	  </li>
	@endforeach
	</ul>

	<ul class="links social_links links-num-7">
		<li class="link"><a href="/EdT0" title="Twitter"></a><i class="fab fa-twitter"></i></li>
		<li class="link"><a href="/5V3m" title="fb"><i class="fab fa-facebook-f"></i></a></li>
		<li class="link"><a href="/4rCk" title="Youtube"><i class="fab fa-facebook-f"></i></a></li>
		<li class="link"><a href="/9FhK" title="ig"><i class="fab fa-instagram"></i></a></li>
	</ul>
</div>
<div class="powered-by-shorby"><a href="">powered by&nbsp;&nbsp;<span class="shorby-logo">Omnilinks</span>
</a>
</div>

<script src="{{asset('js/myScript.js')}}"></script>
</body>

</html>