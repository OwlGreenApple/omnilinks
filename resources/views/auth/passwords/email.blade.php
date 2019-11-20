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

            <form method="POST"  id="signup-form" class="signup-form" action="{{ route('password.email') }}">
              @csrf
              <div class="form-group row">
                <div class="col-md-12 col-12">
                  <label for="email" class="text">
                    {{ __('E-Mail Address') }}
                  </label>
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
                  <button type="submit" class="col-md-12 col-12 btn btn-primary bsub ">
                    {{ __('Reset Password') }}
                  </button>
                  @if (Route::has('password.request'))
                  @endif
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