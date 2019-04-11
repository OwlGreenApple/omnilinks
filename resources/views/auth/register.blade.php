@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="container" style="padding-top: 50px; padding-bottom:50px;">
  <div class="row justify-content-center">
    <div class="col-md-6 col-12">
      <div class="card-custom-register">
        <div class="card cardpadreg">
          <h5 class="Daftar-Disini">Daftar Disini</h5>
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <input type="hidden" name="price" value="<?php if (isset ($price)) {echo $price;} ?>">
              <input type="hidden" name="namapaket" value="<?php if (isset ($namapaket)) {echo $namapaket;} ?>">
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
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="agree-term" class="label-agree-term">
                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term mr-1" />
                    I agree with
                    <a href="{{url('statics/terms-conditions')}}" class="term-service">
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
                  <hr class="own">
                  <h3 class="have">Sudah Punya Akun?&nbsp;<a href="{{ __('login')}}">Masuk Disini</a></h3>
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