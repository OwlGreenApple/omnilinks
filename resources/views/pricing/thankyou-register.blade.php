@extends('layouts.app')

@section('content')
<link href="{{ asset('css/style-thankyou.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container konten konten-register">
  <div class="offset-sm-2 col-sm-8">
    <div class="card h-80 card-payment" style="margin-bottom: 50px">
      <div class="card-body">
          <span class="icon-thankyou" style="font-size: 60px;color: #106BC8">
            <i class="fas fa-check-circle"></i>
          </span>
          <h1>Thank You<br> For Coming Back</h1>
          <hr class="orn" style="color: #106BC8">
          <div class="form-group">
          <p class="pg-title">Selamat, Anda mendapat kesempatan membeli <br>
          <br>
          <strong>PAKET SPECIAL ELITE</strong><br>
          <strong>3 Bulan: 295Rb</strong><br>
          <i style="color:#106AC7!important;font-size:18px;">(diskon 100Rb)</i><br>
          @if(!is_null($coupon_code))
            <br>
            <img src="{{url('image/coupons.jpg')}}" style="width:auto;height:32px;">
            Kode Kupon anda :<br>
          <strong><i style="color:#FF0000!important;">{{$coupon_code}} </i></strong> <br>
            <br>
            <i style="font-size:15px;color:#106AC7!important;">*PS: kupon expired dalam 2x24 jam</i>
          @endif
          </p>
          </div>
          <div class="form-group offset-md-2 col-md-8 col-12">
            <a href="<?php 
            if (!is_null($coupon_code)){
              echo url('checkout/'.$coupon_code);
            }
            else {
              echo "#";
            }
            ?>" class="free-underline">
              <input type="button" class=" btn btn-primary bsub btn-block" value="Gunakan Kupon Sekarang" style="margin-top:-10px; background-color:#FF0000!important;" />
            </a>
            <a href="{{url('/')}}" class="free-underline">
              <i style="font-size:15px;color:#106AC7!important;">Nanti saja, lanjutkan free trial </i>
            </a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
