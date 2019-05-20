<!DOCTYPE html>

<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta property="og:type" content="article">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/template.css')}}">
  <link rel="stylesheet" href="{{asset('css/dash.css')}}">
  <link rel="stylesheet" href="{{asset('css/redirect.css')}}">

  <title>Link</title>
</head>

@if(is_null($pages->template))
<body style=" color:#fff; background-color:{{$pages->color_picker}};" class="a ">
@else
<body class="{{$pages->template}} " >
@endif
  
  <div class="col-md-12 col-12 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-7 col-7 mb-4 row">
        <div class="offset-md-1 offset-1 col-md-5 col-5 text-right">
          @if(!is_null($pages->image_pages))
            <img src="<?php echo url(Storage::disk('local')->url('app/'.$pages->image_pages));?>" class="imagetitle" >
          @endif
        </div>
        
        <div class="col-md-5 col-5">
          @if(!is_null($pages->page_title))
            <span class="header-txt title">
              {{$pages->page_title}}
            </span>
          @endif
          @if(!is_null($pages->link_utama))
            <span class="header-txt txt">
              {{$pages->link_utama}}
            </span>
          @endif
          @if(!is_null($pages->telpon_utama))
            <span class="header-txt txt">
              {{$pages->telpon_utama}}
            </span>
          @endif
        </div>
      </div>

      <div class="col-md-7 mb-5 row">
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
      </div>

      <div class="col-md-7 mb-3 row">
        <?php foreach ($sort_msg as $msg) { ?>
          <div class="col">
            @if($msg=='wa' and !is_null($pages->wa_link))
              <a href="{{url('click/wa/'.$pages->id)}}" title="wa" target="_blank">
                <button class="btn btn-block">
                  <i class="fab fa-whatsapp"></i>
                  <span class="textbutton"> WhatsApp</span>
                </button>
              </a>
            @endif 

            @if($msg=='skype' and !is_null($pages->skype_link))
              <a href="{{url('click/skype/'.$pages->id)}}" title="Skype" target="_blank">
                <button class="btn btn-block">
                  <i class="fab fa-skype"></i>
                  <span class="textbutton"> Skype</span>
                </button>
              </a>
            @endif  

            @if($msg=='telegram' and !is_null($pages->telegram_link))
              <a href="{{url('click/telegram/'.$pages->id)}}" title="Telegram" target="_blank">
                <button class="btn btn-block">
                  <i class="fab fa-telegram"></i>
                  <span class="textbutton" > Telegram</span>
                </button>
              </a>
            @endif  
          </div>
        <?php } ?>
      </div>

      <div class="col-md-7 mb-4">
        @if($links->count())
          @foreach($links as $link)
            <div class="col-md-12 col-12 mb-3"> 
              <a href="{{url('click/link/'.$link->id)}}" title=""  target="_blank">
                <button class="btn btn-block">
                  <span class="textbutton">
                    {{$link->title}}
                  </span>
                </button>
              </a>
            </div>
          @endforeach
        @endif
      </div>

      <div class="col-md-7 mb-5 row">
        <?php foreach ($sort_sosmed as $sosmed) { ?>
          <div class="col text-center icon-sosmed">
            @if( $sosmed=='fb' and (!is_null($pages->fb_link) || $pages->fb_pixel_id!=0))
              <a href="{{url('click/fb/'.$pages->id)}}" title="fb" target="_blank">
                <i class="fab fa-facebook-square"></i>
              </a>
            @endif
          
            @if($sosmed=='ig' and (!is_null($pages->ig_link) || $pages->ig_pixel_id!=0))
              <a href="{{url('click/ig/'.$pages->id)}}" title="ig" target="_blank">
                <i class="fab fa-instagram"></i>
              </a> 
            @endif

            @if($sosmed=='twitter' and (!is_null($pages->twitter_link) || $pages->twitter_pixel_id!=0))
              <a href="{{url('click/twitter/'.$pages->id)}}" title="Twitter" target="_blank">
                <i class="fab fa-twitter-square"></i>
              </a>
            @endif

            @if($sosmed=='youtube' and (!is_null($pages->youtube_link) || $pages->youtube_pixel_id!=0))
              <a href="{{url('click/youtube/'.$pages->id)}}" title="Youtube" target="_blank">
                <i class="fab fa-youtube"></i>
              </a>
            @endif 
          </div>
        <?php } ?>
      </div>

      <div class="col-md-7 text-center">
        @if(!is_null($pages->powered))
          <span style="font-size: small;">powered by</span>
          <br>
          <img style="width: 150px; margin-bottom: 50px;" src="{{asset('image/omnilinkz-logo-wh.png')}}">
        @endif
      </div>
    </div>
  </div>

<script src="{{asset('js/myScript.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    <?php if($pages->is_rounded) {?>
      $(".btn").addClass("btn-rounded");
    <?php } ?>

    <?php if($pages->is_outlined) {?>
      $(".btn").addClass("btn-outlined");
    <?php } ?>

    <?php if (!is_null($pages->rounded)) { ?>
      $('.btn').css("background-color","<?php echo $pages->rounded; ?>");
    <?php } ?>

    <?php if (!is_null($pages->outline)) { ?>
      $('.btn').css("border-color","<?php echo $pages->outline; ?>");
    <?php } ?>
  });
</script>

</body>
</html>