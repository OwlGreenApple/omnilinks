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
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/template.css')}}">
  <link rel="stylesheet" href="{{asset('css/dash.css')}}">
  <title>Link</title>
</head>

@if(is_null($pages->template))
<body style=" color:#fff; background-color:{{$pages->color_picker}};" class="a ">
@else
<body class="{{$pages->template}} " >
@endif
  
  <style type="text/css">
    .rows{
      margin-top: 20px;
      margin-bottom: 20px;
      padding-right: 25px;
      padding-left: 25px;
    }
    .row{
      /*margin-right: -10px;*/
    }
    .mrglink{
      margin-bottom: 20px; /*margin-top: -5px;*/
    }
  </style>

  <header class="container">
    <div class="row">
      <div class="col-md-2 offset-md-3 col-3 offset-1 pt-4 pb-4 text-center">
        @if(!is_null($pages->image_pages))
          <img src="<?php echo url(Storage::disk('local')->url('app/'.$pages->image_pages));?>" class="imagetitle" >
        @endif
      </div>

      <div class="col-md-4 col-7 pt-4 pb-4" style="margin-top: 12px">
        <ul class="ultitle">
          @if(!is_null($pages->page_title))
            <li style="display: block; margin-bottom: 1px; font-size: large;">
              {{$pages->page_title}}
            </li>
          @endif
          @if(!is_null($pages->link_utama))
            <li style="display: block; margin-bottom: -15px; font-size:smaller;  word-break: break-all;" >
              <p class="font-weight-bold">
                {{$pages->link_utama}}
              </p>
            </li>
          @endif
          @if(!is_null($pages->telpon_utama))
            <li style="display: block; margin-top: -4px;">
              <p class="font-weight-bold">
                {{$pages->telpon_utama}}
              </p>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </header>

<?php
$link = Link::where('pages_id','=',$pages->id)
          ->orderBy('created_at','descend')
          ->get();
$banner = Banner::where('pages_id','=',$pages->id)
          ->orderBy('created_at','ascend')
          ->get();
?>

  <div class="galleryContainer">
    <div class="slideShowContainer">
      <div onclick="plusSlides(-1)" class="nextPrevBtn leftArrow">
        <span class="arrow arrowLeft"></span>
      </div>
      <div onclick="plusSlides(1)" class="nextPrevBtn rightArrow" id="right">
        <span class="arrow arrowRight"></span>
      </div>
      <div class="captionTextHolder">
        <p class="captionText slideTextFromTop"></p>
      </div>
      @if($banner->count())
        @if(!is_null($banner[0]->images_banner))
          @foreach($banner as $banner)
          <div class="imageHolder">
            <a href="{{url('click/banner/'.$banner->id)}}" target="_blank">
              <img src="<?php echo url(Storage::disk('local')->url('app/'.$banner->images_banner));?>">
              <p class="captionText"></p> 
            </a>
          </div>
          @endforeach
          @else
          <div></div>
        @endif
      @endif
    </div>
    <div id="dotsContainer"></div>
  </div>

  <div class="container biolink-page" style="margin-top: 33px">
	  <header></header>
	  <div class="links messengers {{$pages->colom}} row" style="margin-bottom: 20px;">

      @if(!is_null($pages->wa_link))
        <div class="link">
          <a href="{{url('click/wa/'.$pages->id)}}" title="wa" class="btn btnview" target="_blank">
              <i class="fab fa-whatsapp"></i>
              <span class="textbutton"> WhatsApp</span>
          </a>
        </div>
      @endif

      @if(!is_null($pages->skype_link))
        <div class="link">
          <a href="{{url('click/skype/'.$pages->id)}}" title="Skype" class="btn btnview" target="_blank">
            <i class="fab fa-skype"></i>
            <span class="textbutton"> Skype</span>
          </a>
        </div>
      @endif

      @if(!is_null($pages->telegram_link))
        <div class="link">
          <a href="{{url('click/telegram/'.$pages->id)}}" title="Telegram" class="btn btnview" target="_blank">
            <i class="fab fa-telegram"></i>
            <span class="textbutton" > Telegram</span>
          </a>
        </div>
      @endif

      @if(!is_null($pages->wa_link) || $pages->wa_pixel_id!=0 and !is_null($pages->skype_link) || $pages->skype_pixel_id!=0 and !is_null($pages->telegram_link) || $pages->telegram_pixel_id!=0)
        <div></div>
      @endif	
    </div>

    <div class="row">
      @if($link->count())
      	@foreach($link as $link)
        	<div class="col-md-12 col-12 mrglink"> 
            <a href="{{url('click/link/'.$link->id)}}" title="" class="btn btnview" target="_blank">
              <span>{{$link->title}}</span>
            </a>
          </div>
        @endforeach
      @endif
      <div class="col-md-12 col-12 mrglink"> 
        <a href="#" title="" class="btn btnview">
          <span>tes</span>
        </a>
      </div>
    </div>

    <div class="row rows">
    	@if(!is_null($pages->fb_link) || $pages->fb_pixel_id!=0)
        <div class="{{$pages->colom_sosmed}} linked">
          <a href="{{url('click/fb/'.$pages->id)}}" title="fb" target="_blank">
            <i class="fab fa-facebook-square"></i>
          </a>
        </div>
      @endif

      @if(!is_null($pages->ig_link) || $pages->ig_pixel_id!=0)
        <div class="{{$pages->colom_sosmed}} linked">
          <a href="{{url('click/ig/'.$pages->id)}}" title="ig" target="_blank">
            <i class="fab fa-instagram"></i>
          </a>	
        </div>  
      @endif

      @if(!is_null($pages->twitter_link) || $pages->twitter_pixel_id!=0)
        <div class="{{$pages->colom_sosmed}} linked">
          <a href="{{url('click/twitter/'.$pages->id)}}" title="Twitter" target="_blank">
            <i class="fab fa-twitter-square"></i>
          </a>
        </div>
      @endif

      @if(!is_null($pages->youtube_link) || $pages->youtube_pixel_id!=0)
        <div class="{{$pages->colom_sosmed}} linked">
          <a href="{{url('click/youtube/'.$pages->id)}}" title="Youtube" target="_blank">
            <i class="fab fa-youtube"></i>
          </a>
        </div>
      @endif
    </div>
  </div>

  @if(!is_null($pages->powered))
    <div class="powered-omnilinks">
      <a href="">
        <span style="font-size: small;">powered by</span>
        <br>
        <img style="width: 150px; margin-bottom: 50px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
      </a>
    </div>
  @else
    <div></div>
  @endif

  <div></div>

  <script src="{{asset('js/myScript.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      <?php if (!is_null($pages->rounded)) { ?>
        $('.btn').css("background-color","<?php echo $pages->rounded; ?>");
      <?php } ?>
      <?php if (!is_null($pages->outline)) { ?>
        $('.btn').css("border-color","<?php echo $pages->outline; ?>");
      <?php } ?>
      
      <?php if($pages->is_rounded) {?>
        $("body").addClass("roundedview");
      <?php } ?>
      <?php if($pages->is_outlined) {?>
        $("body").addClass("outlinedview");
      <?php } ?>


    });
  
  </script>
</body>
</html>