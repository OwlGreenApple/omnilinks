@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css?v=1')}}">
<div class="container" style="padding-top: 50px; padding-bottom:50px;">
    <div class="row justify-content-center">
    <div class="col-md-8 col-12 ">
        <div class="card-custom">
            <div class="card cardpad">
            <h5 class="Daftar-Disini">Login Here</h5>
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
                            <label for="email" class="text">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="col-md-12 col-12 form-control form-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Input Email" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        <div class="form-group row">
                        <div class="col-md-12 col-12">
                            <label for="password" class="text">{{ __('Password') }}</label>
                                <input id="password" type="password" class="col-md-12 col-12 form-control form-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Input Password" required>
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
                                <button type="submit" class="col-md-12 col-12 btn btn-primary bsub btn-block">
                                    {{ __('Login') }}
                                </button>
                        @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <hr class="own">
                                <h3 class="have">Sudah punya akun? <a href="{{ __('register')}}">Daftar Disini</a></h3>
                                </div>
                                
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
