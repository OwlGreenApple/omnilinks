<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/pdf.css') }}" rel="stylesheet">

<span class="col-xs-12 footer" align="center" style="background-color: #106BC8; color: #fff">
  omnilinkz.com - {{ date("Y") }}
</span>

<div class="col-xs-12">
  <div class="row" style="margin-bottom: 50px">
    <div class="col-xs-6" align="left" >
      <img src="{{asset('image/omnilinkz-logo.png')}}">
    </div>
    <div class="col-xs-6" align="right">
      Periode : 
      <div class="date-box">
        <b>{{ date("F Y") }}</b>
      </div>
    </div>
  </div>  

  <div class="row" style="margin-bottom: 50px">
    <div class="col-xs-3" align="center">
      <img class="pageimg" src="<?php echo url(Storage::disk('local')->url('app/'.$page->image_pages)); ?>">
    </div>

    <div class="col-xs-9">
      <span class="titel">
        <b>omn.lkz/{{$page->names}}</b> <br>
        Title : <b>{{$page->page_title}}</b> <br>
        Pixels : <br>
        Created on : {{ date("F d, Y", strtotime($page->created_at))  }} 
      </span>
    </div>
  </div>

  <!-- Banner --> 
  @if($banners->count())
    <div class="row" style="margin-bottom: 20px">
      <div class="date-box">
        <b>BANNERS</b>
      </div>
    </div>

    @foreach($banners as $banner)
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class="fab fa-font-awesome-flag"></i>&nbsp;&nbsp;
          {{$banner->title}}        
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click[$banner->title]}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$banner->link}}        
        </div>
      </div>
    @endforeach
  @endif

  <!-- Messenger -->
  @if(($page->wa_pixel_id!=0 and !is_null($page->wa_pixel_id)) or ($page->telegram_pixel_id!=0 and !is_null($page->telegram_pixel_id)) or ($page->skype_pixel_id!=0 and !is_null($page->skype_pixel_id)))
    <div class="row" style="margin-bottom: 20px; margin-top: 30px">
      <div class="date-box">
        <b>MESSENGERS</b>
      </div>
    </div>

    @if($page->wa_pixel_id!=0 and !is_null($page->wa_pixel_id))
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class='fab fa-whatsapp'></i>&nbsp;&nbsp;
          WhatsApp
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click['wa']}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$page->wa_link}}        
        </div>
      </div>        
    @endif

    @if($page->telegram_pixel_id!=0 and !is_null($page->telegram_pixel_id))
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class='fab fa-telegram'></i>&nbsp;&nbsp;
          Telegram
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click['telegram']}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$page->telegram_link}}        
        </div>
      </div>          
    @endif

    @if($page->skype_pixel_id!=0 and !is_null($page->skype_pixel_id))
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class='fab fa-skype'></i>&nbsp;&nbsp;
          Skype
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click['skype']}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$page->skype_link}}        
        </div>
      </div>
    @endif
  @endif

  <!-- Link -->
  @if($links->count())
    <div class="row" style="margin-bottom: 20px; margin-top: 30px">
      <div class="date-box">
        <b>LINKS</b>
      </div>
    </div>

    @foreach($links as $link)
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class="fas fa-link"></i>&nbsp;&nbsp;
          {{$link->title}}        
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click[$link->title]}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$link->link}}        
        </div>
      </div>
    @endforeach
  @endif

  <!-- Social Media -->
  @if(($page->fb_pixel_id!=0 and !is_null($page->fb_pixel_id)) or ($page->ig_pixel_id!=0 and !is_null($page->ig_pixel_id)) or ($page->twitter_pixel_id!=0 and !is_null($page->twitter_pixel_id)) or ($page->youtube_pixel_id!=0 and !is_null($page->youtube_pixel_id)))
    <div class="row" style="margin-bottom: 20px; margin-top: 30px">
      <div class="date-box">
        <b>SOCIAL MEDIA</b>
      </div>
    </div>

    @if($page->fb_pixel_id!=0 and !is_null($page->fb_pixel_id))
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class='fab fa-facebook-f'></i>&nbsp;&nbsp;
          Facebook       
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click['fb']}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$page->fb_link}}        
        </div>
      </div>
    @endif

    @if($page->ig_pixel_id!=0 and !is_null($page->ig_pixel_id))
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class='fab fa-instagram'></i>&nbsp;&nbsp;
          Instagram       
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click['ig']}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$page->ig_link}}        
        </div>
      </div>
    @endif

    @if($page->twitter_pixel_id!=0 and !is_null($page->twitter_pixel_id))
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class='fab fa-twitter'></i>&nbsp;&nbsp;
          Twitter
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click['twitter']}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$page->twitter_link}}        
        </div>
      </div>
    @endif

    @if($page->youtube_pixel_id!=0 and !is_null($page->youtube_pixel_id))
      <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-4">
          <i class='fab fa-youtube'></i>&nbsp;&nbsp;
          Youtube
        </div>
        <div class="col-xs-4" align="center">
          <b>{{$click['youtube']}} clicks</b>        
        </div>
        <div class="col-xs-4" style="border:1px solid black">
          {{$page->youtube_link}}        
        </div>
      </div>
    @endif
  @endif 

  <div class="row">
    <hr>

    <div class="col-xs-4">
      <b>TOTAL</b>
    </div>
    <div class="col-xs-4" align="center">
      <b>{{array_sum($click)}} clicks</b>        
    </div>
  </div>         
</div>






 