@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/about.css')}}">
  <header class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="omni-title">ABOUT OMNILINKZ</h1>
          <!--<h3 class="omni-sub">Sub Heading Title Goes Here</h3>-->
        </div>
      </div>
    </div>
  </header>
<div class="container" style="margin-bottom: 120px;">
  <div class="row justify-content-center">
    <div class="col-md-8 col-12">
      <div class="card">
          <div class="card-header">
            <h2 class="omni-about">Omnilinkz</h2>
          </div>
          <div class="card-body">
            <p class="textabout">
              Omnilinkz.com merupakan tools bisnis online berupa link yang menampung banyak link lainnya. Omnilinkz mempermudah Anda mencantumkan banyak link pada bio profile Instagram.
              <br><br>
              Anda bisa menggunakan Omnilinkz secara gratis. Namun untuk bisa merasakan fitur-fitur lengkap pada Omnilinkz.com, Anda wajib melakukan upgrade pada akun Anda.
            </p>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection