<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Omnilinks</title>

  <!-- Scripts -->
  <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{asset('js/pricing.js')}}"></script>
  <script src="{{ asset('jquery-ui-1.12.1/jquery-ui.js') }}"></script>
  
  <link rel="dns-prefetch" href="//fonts.gstatic.com">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset('css/landing.css?v=1')}}">

</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel  ">
      <div class="container-fluid">
        <?php if(Auth::check()){?>
        <a class="navbar-brand" href="{{ url('/dash') }}">
          <?php } else{?>
          <a class="navbar-brand" href="{{ url('/') }}">
            <?php }?>
            <img src="{{asset('image/omnilinkz-logo.png')}}" width="180px;" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              @guest
              <li class="nav-item">
                <a class="nav-link navlog" href="{{ route('login') }}">{{ __('LOG IN') }}</a>
              </li>
              @if (Route::has('register'))
              <li class="nav-item">
                <a class="btn btn-md btn-primary btn-prim-custom" href="{{ route('register') }}">{{ __('GET STARTED FOR FREE') }}</a>
              </li>
              @endif
              @else

              <div class="dropdown pull-right">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:blue;" v-pre>
                  Halo, {{ Auth::user()->username }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">edit</a>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">log out</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </ul>
          </div>
          @endguest
      </div>
    </nav>
  </div>
  @yield('content')

  <footer class="infooter font-small">
    <div class="container text-md-left">
      <div class="row">
        <div class="col-md-3 mx-auto">
          <ul class="list-unstyled">
            <h5 style="color:#ffffff;">Omnilinkz </h5>
            <li><a href="{{asset('/about')}}" class="linkfooter">About Us</a></li>
            <li><a href="{{asset('/pricing')}}" class="linkfooter">Pricing</a></li>
            <li><a href="{{asset('/faq')}}" class="linkfooter">Faq</a></li>
          </ul>
        </div>
        <div class="col-md-3 mx-auto">
          <ul class="list-unstyled">
            <h5 style="color:#ffffff;">Helps</h5>
            <li><a href="{{asset('/helps')}}" class="linkfooter">Terms And Condition</a></li>
            <li><a href="{{asset('/helps')}}" class="linkfooter">Privacy And Policy</a></li>
            <li><a href="#" class="linkfooter">Blog</a></li>
          </ul>
        </div>
        <div class="col-md-3 mx-auto">
          <ul class="list-unstyled">
            <h5 style="color:#ffffff;">Contact us</h5>
            <li class="linkfooter"><a onclick="window.location.href='mailto:support@omnilinkz.com.address?subject=Hi Omnilinkz';" style="cursor:pointer;">support@omnilinkz.com</a></li>
            <li><a href="#" onclick='window.open("http://facebook.com");return false;'><i class="fab fa-facebook linkfooter"></i></a><a href="#" onclick='window.open("http://instagram.com");return false;'><i class="fab fa-instagram linkfooter" style="margin-left:5px;"></i></a></li>
          </ul>
        </div>
        <div class="col-md-3 mx-auto">
          <ul class="list-unstyled">
            <h5 style="color:#ffffff;">Copyright</h5>
            <li class="linkfooter">© 2019 Omnilinkz</li>
            <li class="linkfooter">All Right Reserved</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  </div>
<<<<<<< Updated upstream
</body>

</html>
=======
  </footer>   
   </div>

  </body>
</html>
>>>>>>> Stashed changes
