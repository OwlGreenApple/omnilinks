@extends('layouts.app')

@section('content')
<?php use App\Helpers\Helper; ?>

<link rel="stylesheet" href="{{asset('css/tutorial.css')}}">
<script type="text/javascript" src="{{ asset('/public/node-waves/waves.js') }}"></script>

<div class="container mb-5 main-cont" style="">
  <div class="row">
    <div class="col-md-12">
      <div class="tab-content">
        <div class="embed-responsive embed-responsive-16by9 tab-pane fade in active" id="home_animation_1" role="tabpanel" >
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/RtpiCPeXY6g?rel=0&amp;showinfo=0"></iframe>
        </div>
        <div class="embed-responsive embed-responsive-16by9 tab-pane  " id="profile-animation-1" role="tabpanel" >
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_jUCvWKuJ-g?rel=0&amp;showinfo=0"></iframe>
        </div>								
        <div class="embed-responsive embed-responsive-16by9 tab-pane  " id="tampilan_animation_1" role="tabpanel" >
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/6XBwRB3dUhY?rel=0&amp;showinfo=0"></iframe>
        </div>

        <div class="embed-responsive embed-responsive-16by9 tab-pane  " id="pixel_animation_1" role="tabpanel" >
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/wgruzLhPqAo?rel=0&amp;showinfo=0"></iframe>
        </div>								
        <div class="embed-responsive embed-responsive-16by9 tab-pane  " id="wa_animation_1" role="tabpanel" >
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/dHdgh90nGv4?rel=0&amp;showinfo=0"></iframe>
        </div>								
      </div>
    </div>
  </div>
  <div class="clearfix"></div><br/>
  <div class="row" id="videoTabs" >
    <div class="col-md-4 col-sm-12 col-xs-12" >
      <a href="#home_animation_1" data-toggle="tab" aria-expanded="true" class="info-box btn-video">
        <div class="icon">
          <img src="{{asset('/image/filmIcon.png')}}" class="filmIcon">
        </div>
        <div class="content">
          <p class="text-white">Tutorial Membuat Bio Link</p>
        </div>
      </a>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12" >
      <a href="#profile-animation-1" role="tab" data-toggle="tab" aria-expanded="false" class="info-box btn-video">
        <div class="icon">
          <img src="{{asset('/image/filmIcon.png')}}" class="filmIcon">
        </div>
        <div class="content">
          <p class="text-white">Tutorial Setting Tab Link</p>
        </div>
      </a>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12" >
      <a href="#tampilan_animation_1" data-toggle="tab" aria-expanded="false" class="info-box btn-video">
        <div class="icon">
          <img src="{{asset('/image/filmIcon.png')}}" class="filmIcon">
        </div>
        <div class="content">
          <p class="text-white">Tutorial Setting Tab Tampilan</p>
        </div>
      </a>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <a href="#pixel_animation_1" data-toggle="tab" aria-expanded="false" class="info-box btn-video">
        <div class="icon">
          <img src="{{asset('/image/filmIcon.png')}}" class="filmIcon">
        </div>
        <div class="content">
          <p class="text-white">Tutorial Setting Tab Pixel</p>
        </div>
      </a>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12" >
      <a href="#wa_animation_1" data-toggle="tab" aria-expanded="false" class="info-box btn-video">
        <div class="icon">
          <img src="{{asset('/image/filmIcon.png')}}" class="filmIcon">
        </div>
        <div class="content">
          <p class="text-white">Tutorial Setting Tab Wa Link Creator</p>
        </div>
      </a>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <a href="#teks_animation_1" data-toggle="tab" aria-expanded="false" class="info-box btn-video">
        <div class="icon">
          <img src="{{asset('/image/filmIcon.png')}}" class="filmIcon">
        </div>
        <div class="content">
          <p class="text-white">Tutorial Teks Omnilinkz</p>
        </div>
      </a>
    </div>
  </div>  
</div>


<script type="text/javascript">

  $(document).ready(function() {
  });


</script>
@endsection