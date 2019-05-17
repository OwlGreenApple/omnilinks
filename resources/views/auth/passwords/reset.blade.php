@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container container-custom">
  <div class="row justify-content-center">

    <div class="col-md-12">
      <img class="mx-auto d-block" src="{{asset('image/omnilinkz-logo-wh.png')}}" width="240px;" height="auto">
    </div>

    <div class="col-md-6 col-12 ">
      <div class="card-custom">
        <div class="card cardfor">
          <h5 class="Daftar-Disini">Reset Password</h5>
          <div class="card-body">
            @if (session('error') )
              <div class="col-md-12 alert alert-danger">
                {{session('error')}}
              </div>
            @endif
            @if (session('success') )
              <div class="col-md-12 alert alert-success">
                {{session('success')}}
              </div>
            @endif

            <form method="POST"  id="signup-form" class="signup-form" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="email" class="text">
                    {{ __('E-Mail Address') }}
                  </label>

                  <input id="email" type="email" class="col-md-12 col-12 form-control form-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="password" class="text">
                    {{ __('Password') }}
                  </label>

                  <input id="password" type="password" class="col-md-12 col-12 form-control form-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
             
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="password-confirm" class="text">
                    {{ __('Confirm Password') }}
                  </label>

                  <input id="password-confirm" type="password" class="col-md-12 col-12 form-control form-input" name="password_confirmation" required>

                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <button type="submit" class="col-md-12 col-12 btn btn-primary bsub ">
                    {{ __('Reset Password') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header headercard">
          {{ __('Reset Password') }}
        </div>
        <div class="card-body">
          <form method="POST"  id="signup-form" class="signup-form" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control form-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Reset Password') }}
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>-->
@endsection