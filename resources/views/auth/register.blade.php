@extends('layouts.app')
@section('content')
<script>
  function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which :event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
  }
  $(document).ready(function() {
      $('#wa-number').keypress(function(e){
        if (this.value.length == 0 && e.which == 48 ){
          return false;
        }
      });
      $('#wa-number').on('input propertychange paste', function (e) {
          //var reg = /^0+/gi;
          var reg = /((^|, )(0|62|[+]0|[+]62|[+]))/gi;
          if (this.value.match(reg)) {
              this.value = this.value.replace(reg,'');
          }
      });
  });
</script>
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="container" style="padding-top: 120px; padding-bottom:50px;">
  <div class="row justify-content-center">
    <div class="col-md-12" style="margin-bottom: 50px">
      <img class="mx-auto d-block" src="{{asset('image/omnilinkz-logo-wh.png')}}" width="240px;" height="auto">
    </div>

    <div class="col-md-6 col-12">
      <div class="card-custom-register">
        <div class="card cardpadreg">
          <h5 class="Daftar-Disini">Daftar Disini</h5>
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <input type="hidden" name="price" value="<?php if (isset ($price)) {echo $price;} ?>">
              <input type="hidden" name="namapaket" value="<?php if (isset ($namapaket)) {echo $namapaket;} ?>">
              <input type="hidden" name="kupon" value="<?php if (isset($coupon_code)) {echo $coupon_code;} ?>">
              <input type="hidden" name="idpaket" value="<?php if (isset($idpaket)) {echo $idpaket;} ?>">

              <div class="form-group row">
                @if (session('error') )
                <div class="col-md-12 alert alert-danger">
                  <strong>Warning!</strong>{{session('error')}}
                </div>
                @endif
                @if (session('success') )
                <div class="col-md-12 alert alert-success">
                  <strong>Success!</strong> {{session('success')}}
                </div>
                @endif
                <label for="name" class="text">{{ __('Nama Lengkap') }}</label>
                <div class="input-group">
                  <input id="name" type="text" class="col-md-12 col-12 form-control form-input{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                  @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="text">{{ __('Masukkan Email') }}</label>
                <div class="input-group">
                  <input id="email" type="email" class="col-md-12 col-12 form-control form-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                  @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <!--
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="username" class="text">{{__('Masukkan Username') }}</label>
                  <input type="text" id="username" class="col-md-12 col-12 form-control form-input" name="username" placeholder="Username" required>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="password" class="text">{{ __('Masukkan Password') }}</label>
                <div class="input-group" id="show_password">
                  <input id="password" type="password" class="form-control form-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password min 6 character" required style="width: auto !important">
                  
                  <div class="input-group-append" for="password">
                    <label class="input-group-text">
                      <span class="icon-pass">
                        <i class="fas fa-eye-slash" aria-hidden="true"></i>
                      </span>
                    </label>
                  </div>
                  
                  @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="password-confirm" class="text">{{ __('Konfirmasi Password') }}
                  </label>
                  <input id="password-confirm" type="password" class="col-md-12 col-12 form-control form-input" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
              </div>
              -->
              <div class="form-group row">
                <label for="wa-number" class="text">{{ __('Masukkan No WA') }}</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text wa-number-style">
                      +62
                    </div>
                  </div>

                  <input id="wa-number" type="text" class="col-md-12 col-12 form-control form-input{{ $errors->has('wa_number') ? ' is-invalid' : '' }}" name="wa_number" placeholder="No WA ex: 812323...." onkeypress="return hanyaAngka(event)" required>
                  @if ($errors->has('wa_number'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('wa_number') }}</strong>
                  </span>
                  @endif

                </div>
              </div>

              <div class="form-group row">
                  <label class="text" for="gender">
                    Gender:&nbsp;
                  </label>
                <div class="input-group">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" checked>
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="0">
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="input-group">
                  <label for="agree-term" class="label-agree-term">
                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term mr-1" required />
                    I agree with
                    <a href="{{url('/helps')}}" target="_blank" class="term-service">
                      Terms and Conditions
                    </a>
                  </label>
                </div>
              </div>
              <div class="form-group row">
                <div class="input-group">
                  <button type="submit" class="btn btn-primary bsub btn-block">
                    REGISTER
                  </button>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <?php if(!isset($price)) { ?>
                    <hr class="own">
                    <h3 class="have">Sudah Punya Akun?&nbsp;<a href="{{ __('login')}}">Masuk Disini</a></h3>
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
 $(document).ready(function() {
   $("#show_password .icon-pass").on('click', function(e) {
      if($('#show_password input').attr("type") == "text"){
        $('#show_password input').attr('type', 'password');
        $('#show_password .icon-pass').html('<i class="fas fa-eye-slash" aria-hidden="true"></i>');
      } else if($('#show_password input').attr("type") == "password"){
        $('#show_password input').attr('type', 'text');
        $('#show_password .icon-pass').html('<i class="fas fa-eye" aria-hidden="true"></i>');
      }
    });

    $("#show_password_confirm .icon-pass-confirm").on('click', function(e) {
      if($('#show_password_confirm input').attr("type") == "text"){
        $('#show_password_confirm input').attr('type', 'password');
        $('#show_password_confirm .icon-pass-confirm').html('<i class="fas fa-eye-slash" aria-hidden="true"></i>');
      } else if($('#show_password_confirm input').attr("type") == "password"){
        $('#show_password_confirm input').attr('type', 'text');
        $('#show_password_confirm .icon-pass-confirm').html('<i class="fas fa-eye" aria-hidden="true"></i>');
      }
    });
  });  
</script>

<?php if ( env('APP_ENV') !== "local" ) { ?>

<!-- Provely Conversions App Display Code -->
<script>(function(w,n) {
if (typeof(w[n]) == 'undefined'){ob=n+'Obj';w[ob]=[];w[n]=function(){w[ob].push(arguments);};
d=document.createElement('script');d.type = 'text/javascript';d.async=1;
d.src='https://s3.amazonaws.com/provely-public/w/provely-2.0.js';x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(d,x);}
})(window, 'provelys', '');
provelys('config', 'baseUrl', 'app.provely.io');
provelys('config', 'https', 1);
provelys('data', 'campaignId', '16066');
provelys('config', 'widget', 1);
</script>
<!-- End Provely Conversions App Display Code -->

<!-- Provely Conversions App Data Code -->
<script>(function(w,n) {
if (typeof(w[n]) == 'undefined'){ob=n+'Obj';w[ob]=[];w[n]=function(){w[ob].push(arguments);};
d=document.createElement('script');d.type = 'text/javascript';d.async=1;
d.src='https://s3.amazonaws.com/provely-public/w/provely-2.0.js';x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(d,x);}
})(window, 'provelys', '');
provelys('config', 'baseUrl', 'app.provely.io');
provelys('config', 'https', 1);
provelys('data', 'campaignId', '16066');
provelys('config', 'track', 1);
</script>
<!-- End Provely Conversions App Data Code -->
<?php } ?>
@endsection