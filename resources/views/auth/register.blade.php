@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="container" style="padding-top: 120px; padding-bottom:50px;">
  <div class="row justify-content-center">
    <div class="col-md-12" style="margin-bottom: 50px">
      <img class="mx-auto d-block" src="image/omnilinkz-logo-wh.png" width="240px;" height="auto">
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
                <div class="col-md-12 col-12">
                  <label for="name" class="text">{{ __('Nama Lengkap') }}</label>
                  <input id="name" type="text" class="col-md-12 col-12 form-control form-input{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                  @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="email" class="text">{{ __('Masukkan Email') }}</label>
                  <input id="email" type="email" class="col-md-12 col-12 form-control form-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                  @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="username" class="text">{{__('Masukkan Username') }}</label>
                  <input type="text" id="username" class="col-md-12 col-12 form-control form-input" name="username" placeholder="Username" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="password" class="text">{{ __('Masukkan Password') }}</label>
                  <input id="password" type="password" class="col-md-12 col-12 form-control form-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
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
              <div class="form-group row">
                <div class="col-md-12">
                  <label class="text" for="gender">
                    Gender:&nbsp;
                  </label>
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
                <div class="col-md-12">
                  <label for="agree-term" class="label-agree-term">
                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term mr-1" required />
                    I agree with
                    <a href="{{url('/helps')}}" class="term-service">
                      Terms and Conditions
                    </a>
                  </label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <button type="submit" class="btn btn-primary bsub btn-block">
                    REGISTER
                  </button>

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
@endsection