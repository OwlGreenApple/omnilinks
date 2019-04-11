@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="container container-custom">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <img class="mx-auto d-block" src="image/omnilinkz-logo-wh.png" width="240px;" height="auto">
    </div>
    <div class="col-md-6 col-12 ">
      <div class="card-custom">
        <div class="card cardpad">
          <h5 class="Daftar-Disini">Halo!</h5>
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  @if (session('error') )
                  <div class="col-md-12 alert alert-danger">
                    <strong>Warning!</strong> {{session('error')}}
                  </div>
                  @endif
                  @if (session('success') )
                  <div class="col-md-12 alert alert-success">
                    <strong>Success!</strong> {{session('success')}}
                  </div>
                  @endif
                  <label for="email" class="text">
                    Masukkan Email 
                  </label>
                  <input id="email" type="email" class="col-md-12 col-12 form-control form-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
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
                    Masukkan Password
                  </label>
                  <input id="password" type="password" class="col-md-12 col-12 form-control form-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                  @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <button type="submit" class="col-md-12 col-12 btn btn-primary bsub ">
                    LOG IN
                  </button>
                  @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                    Lupa Password?
                  </a>
                  @endif
                  <hr class="own">
                  <h3 class="have">Belum punya akun? <a href="{{ __('register')}}">Daftar Disini!</a></h3>
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