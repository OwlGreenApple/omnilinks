@extends('layouts.app')

@section('content')

<header class="heads">
  <div class="container">
    <div class="row row-property">
      <div class="col-md-5 order-sm-12">
        <img class="mx-auto d-block img-property" src="image/mockup-top.png">
      </div>
      <div class="col-md-7 order-sm-1">
        <div class="h-100 d-flex justify-content-center flex-column">
          <h1 class="title-top">All-In-One Instagram<br>Bio Link</h1>
          <h3 class="sub-title">Sub Heading Title Goes Here</h3>

          <a href="{{url('register')}}">
            <button type="button" class="btn btn-lg btn-primary btn-custom">
              GET STARTED
            </button>  
          </a>
          
        </div>
      </div>
    </div>
  </div>
</header>

<section class="content-one">
  <div class="container container-one">
    <div class="row">
      <div class="col-sm-6 img-bg-one">
        <img class="mx-auto d-block img-content-one" src="image/img-thumb-one.png">
      </div>
      <div class="col-sm-6" style="background-color:#fff;">
        <div class="h-100 d-flex justify-content-center flex-column text-content-one">
          <h2 class="title-top-content-one">MULTIPLE LINK ON<br>YOUR BIO</h2>
          <h3 class="sub-title-content-one">Sub Heading Title Goes Here</h3>

          <a href="{{url('register')}}">  
            <button type="button" class="btn btn-lg btn-primary btn-custom">
              GET STARTED
            </button>
          </a>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="content-two">
  <div class="container container-two">
    <div class="row">
      <div class="col-sm-6 order-sm-12 img-bg-two">
        <img class="mx-auto d-block img-content-two" src="image/img-thumb-two.png">
      </div>
      <div class="col-sm-6 order-sm-1" style="background-color:#fff;">
        <div class="h-100 d-flex justify-content-center flex-column text-content-two">
          <h2 class="title-top-content-two">OMNILINKZ DATA<br>ANALYTICS</h2>
          <h3 class="sub-title-content-two">Sub Heading Title Goes Here</h3>

          <a href="{{url('register')}}">
            <button type="button" class="btn btn-lg btn-primary btn-custom">
              GET STARTED
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content-three">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="title-btm mx-auto d-block">START MAKE YOUR OWN NOW</h2>
      </div>
      <div class="col-md-6">
        <a href="{{url('register')}}">
          <button type="button" class="btn btn-lg btn-primary btn-custom mx-auto d-block">
            GET STARTED
          </button>
        </a>
      </div>
    </div>
  </div>
</section>

@endsection