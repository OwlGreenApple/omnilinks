@extends('layouts.app')

@section('content')
  <?php

  ?>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
    <div class="notification container notif">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
        untuk terus menggunakan Omnilinks
       </div>
    </div>
    <div class="container">
        <div class="row">
          <div class="col">
              <a href="{{asset('/dash/new')}}" class="btn-primary btncreate">CREATE BIO LINK</a>
              <a href="{{asset('/dash/newsingle')}}" class="btn-warning btnsingle">CREATE SINGLE LINK</a>
              <div style="padding-top: 49px; margin-left: 20px; font-size: 20px;">
                <p>Omnilinkz Chart</p>
                <input type="text" name="search" placeholder="Cari Link / Judul">
              </div>
          <div class="card carddash">
        <div class="card-body" >
        <h1 class="textdash">This is No Data To Show</h1>
        </div>
    </div>
  </div>  
</div>
</div>
@endsection