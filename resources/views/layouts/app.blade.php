<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Omnilinkz</title>

  <!-- Icon -->
  <link rel='shortcut icon' type='image/png' href="{{ asset('image/favicon.png') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
  <!--<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{asset('js/pricing.js')}}"></script>
  <script src="{{ asset('jquery-ui-1.12.1/jquery-ui.js') }}"></script>
  <script src="{{ asset('js/angular.js') }}"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>-->
  <script src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>
  <script type="text/javascript" src="{{asset('tooltipster/dist/js/tooltipster.bundle.min.js')}}"></script>
  <script src="{{ asset('datatables/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('datatables/Responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('js/moment.js') }}"></script>
  <script src="{{ asset('js/datetime-moment.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/canvasjs/canvasjs.min.js') }}"></script>
  <script src="{{asset('js/all.js')}}"></script>
  <script src="{{asset('selectize/selectize.js')}}"></script>

  <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">-->

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
  <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
  <link rel="stylesheet" type="text/css" href="{{asset('tooltipster/dist/css/tooltipster.bundle.min.css')}}" />
  <link href="{{ asset('datatables/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet"></link>
  <link href="{{ asset('datatables/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet"></link>

  <link rel="stylesheet" href="{{asset('css/landing.css')}}">
  <link rel="stylesheet" href="{{asset('selectize/selectize.css')}}">
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81228145-4"></script>
  <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'UA-81228145-4');
  </script>

  <script>
    $(document).ready(function() {
      $('.tooltipstered').tooltipster({
        contentAsHTML: true,
        trigger: 'ontouchstart' in window || navigator.maxTouchPoints ? 'click' : 'hover',
      });
    });
  </script>
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <!--<?php if(Auth::check()){?>
          <a class="navbar-brand" href="{{ url('/dash') }}">
        <?php } else{?>
          <a class="navbar-brand" href="{{ url('/') }}">
        <?php }?>-->
          <a class="navbar-brand" href="https://omnilinkz.com">
            <img src="{{asset('image/omnilinkz-logo.png')}}" width="180px;" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <?php if(!Request::is('checkout')) { ?>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              @if(Auth::check())
                <!--
                <li class="nav-item dropdown pull-right">
                  <a class="nav-link navlog" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Create Link
                    <i class="fas fa-angle-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item btncreate-bio" href="">
                      Create Bio Link
                    </a>
                    @if(Auth::user()->membership!='free')
                      <a class="dropdown-item <?php if(Request::is('singlelink')) echo 'active' ?>" href="{{ url('singlelink') }}">
                        Create Single Link
                      </a>
                    @endif 
                  </div>
                </li>-->

                <li class="nav-item">
                  <a class="nav-link navlog" href="{{url('/')}}">
                    {{ __('Dashboard') }}
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link navlog" href="{{url('ads-manager')}}">
                    {{ __('Ads') }}
                  </a>
                </li>                
              @endif

              <li class="nav-item dropdown pull-right">
                <a class="nav-link navlog" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ __('Pricing') }} &nbsp;
                  <i class="fas fa-angle-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item <?php if(Request::is('pricing')) echo 'active' ?>" href="{{ url('pricing') }}">
                    Daftar Harga
                  </a>
                  <a class="dropdown-item <?php if(Request::is('orders')) echo 'active' ?>" href="{{ url('orders') }}">
                    Konfirmasi Pembayaran
                  </a>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link navlog" href="{{env('APP_URL2').'/blog'}}">
                  {{ __('Blog') }}
                </a>
              </li>
              @guest
                <li class="nav-item">
                  <a class="nav-link navlog" href="{{ route('login') }}">{{ __('Log in') }}</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="btn btn-md btn-primary btn-prim-custom" href="{{ route('register') }}">{{ __('START FREE') }}</a>
                  </li>
                @endif
              @else
                <li class="nav-item dropdown pull-right">
                <!--<div class="dropdown pull-right">-->
                  <a class="nav-link blue-txt" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #116BC7">
                    Halo, {{ Auth::user()->username }} &nbsp;
                    <i class="fas fa-angle-down"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if(Auth::user()->is_admin==1)
                      <a class="dropdown-item <?php if(Request::is('list-user')) echo 'active' ?>" href="{{ url('list-user') }}">
                        List User
                      </a>
                      <a class="dropdown-item <?php if(Request::is('list-order')) echo 'active' ?>" href="{{ url('list-order') }}">
                        List Order
                      </a>
                      <a class="dropdown-item <?php if(Request::is('list-coupon')) echo 'active' ?>" href="{{ url('list-coupon') }}">
                        List Kupon
                      </a>
                    @else 
                      <a class="dropdown-item <?php if(Request::is('orders')) echo 'active' ?>" href="{{ url('orders') }}">
                        Order
                      </a>
                    @endif

                    <a class="dropdown-item <?php if(Request::is('edit-profile')) echo 'active' ?>" href="{{ url('edit-profile') }}">
                      Edit Profile
                    </a>
                    
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                      Log Out
                    </a>
                  </div>
                <!--</div>-->
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              @endguest
            </ul>
            <?php } ?>
          </div>
      </div>
    </nav>

    
      @yield('content')  
    

    <footer class="infooter font-small">
      <div class="container text-md-left menu-nomobile">
        <div class="row">
          <div class="col-md-3 mx-auto">
            <ul class="list-unstyled">
              <h5 style="color:#ffffff;">Omnilinkz </h5>
              <li>
                <!--<a href="{{asset('/about')}}" class="linkfooter">
                  About Us
                </a>-->
                <a href="{{env('APP_URL2')}}" class="linkfooter">
                  Home
                </a>
              </li>
              <li>
                <a href="{{asset('/pricing')}}" class="linkfooter">
                  Pricing
                </a>
              </li>
              <li>
                <!--<a href="{{asset('/faq')}}" class="linkfooter">
                  FAQ
                </a>-->
                <a href="{{env('APP_URL2').'/blog'}}" class="linkfooter">
                  Blog
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3 mx-auto">
            <ul class="list-unstyled">
              <h5 style="color:#ffffff;">
                Helps
              </h5>
              <li>
                <a href="{{asset('/helps')}}" class="linkfooter">
                  Terms & Conditions
                </a>
              </li>
              <li>
                <a href="{{asset('/helps')}}" class="linkfooter">
                  Privacy Policy
                </a>
              </li>
              <li>
                <a href="{{asset('/helps')}}" class="linkfooter">
                  Earnings & Legal Disclaimers
                </a>
              </li>
              <!--<li>
                <a href="#" class="linkfooter">Blog</a>
              </li>-->
            </ul>
          </div>
          <div class="col-md-3 mx-auto">
            <ul class="list-unstyled">
              <h5 style="color:#ffffff;">
                Contact us
              </h5>
              <li class="linkfooter">
                <a onclick="window.location.href='mailto:info@omnilinkz.com.address?subject=Hi Omnilinkz';" style="cursor:pointer;">
                  info@omnilinkz.com
                </a>
              </li>
              <li>
                <a href="https://www.facebook.com/Omnilinkz" target="_blank">
                  <i class="fab fa-facebook linkfooter"></i>
                </a>
                <a href="https://www.instagram.com/omnilinkz/" target="_blank">
                  <i class="fab fa-instagram linkfooter" style="margin-left:5px;"></i>
                </a>
              </li>
              <li>
                <a href="https://activomni.com" class="linkfooter">
                Part of Activomni.com
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3 mx-auto">
            <ul class="list-unstyled">
              <h5 style="color:#ffffff;">
                Copyright
              </h5>
              <li class="linkfooter">
                Omnilinkz.com | 2019
              </li>
              <li class="linkfooter">
                All Rights Reserved
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="menu-mobile text-center linkfooter p-3">
        <b>Omnilinkz</b><br>
        <a href="{{env('APP_URL2')}}" class="linkfooter">
          Home
        </a> | 
        <a href="{{url('pricing')}}" class="linkfooter">
          Pricing
        </a> | 
        <a href="{{env('APP_URL2').'/blog'}}" class="linkfooter">
          Blog
        </a> | 
        <a href="{{url('/helps')}}" class="linkfooter">
          Terms & Conditions
        </a> | 
        <a href="{{url('/helps')}}" class="linkfooter">
          Privacy Policy
        </a>
        <br>
        <br>
        <b>Copyright</b><br>
        Omnilinkz.com | 2019 All Rights Reserved. | 
        <a onclick="window.location.href='mailto:info@omnilinkz.com.address?subject=Hi Omnilinkz';" style="cursor:pointer;">
          info@omnilinkz.com
        </a>
        <br>
        <br>
        <a href="https://activomni.com" class="linkfooter">
        Part of Activomni.com
        </a>
      </div>
    </footer>
  </div> 

  <!--Loading Bar-->
  <div class="div-loading">
    <div id="loader" style="display: none;"></div>  
  </div> 
@if (Auth::check()) 
  @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
    <script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'cfe946cc-282f-46a1-b3d5-80e3a76e166d', f: true }); done = true; } }; })();</script>
  @endif
@endif

 <!-- script checker -->
 <div style="visibility: hidden" id="script-code"></div>

</body>

</html>
