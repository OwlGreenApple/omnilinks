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
          <h1>Thank You<br> For Your Registration</h1>
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
            <i style="font-size:15px;color:#106AC7!important;">*PS: kupon expired dalam 1x24 jam</i>
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
          </div>
        </div>
      </div>
    </div>
</div>
<!--
  <div class="container konten">
    <div class="offset-sm-2 col-sm-8">
      <div class="card h-80 card-payment" style="margin-bottom: 50px
      ">
        <div class="card-body">
          <p class="card-text">
            Silahkan melakukan Transfer Bank ke
          </p> 
          <h2>8290812845</h2>
          <p class="card-text">
            BCA <b>Sugiarto Lasjim</b>
          </p>
          <p class="card-text">
            Setelah Transfer, silahkan Klik tombol konfirmasi di bawah ini <br> atau Email bukti Transfer anda ke <b>omnilinkzcom@gmail.com</b> <br>
            Admin kami akan membantu anda max 1x24 jam
          </p>

          <a href="{{url('orders')}}">
            <button class="btn btn-success btn-confirm-thankyou">
              KONFIRMASI TRANSFER BANK
            </button>
          </a>
        </div>
      </div>  
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="card h-80">
          <div class="card-body">
            <span style="font-size: 48px; color: Dodgerblue;"><i class="fas fa-envelope-open-text"></i></span>
            <h5 class="card-title">Check Your Email</h5>
            <p class="card-text">Terima Kasih telah memilih Omnilinks. Cek pesan di inbox email yang telah anda daftarkan.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card h-80">
          <div class="card-body">
            <span style="font-size: 48px; color: Dodgerblue;"><i class="fas fa-search"></i></span>
            <h5 class="card-title">Find Our Email</h5>
            <p class="card-text">Temukan pesan email yang dikirim oleh Omnilinks mengenai konfirmasi pembayaran.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card h-80">
          <div class="card-body">
            <span style="font-size: 48px; color: Dodgerblue;"><i class="far fa-credit-card"></i></span>
            <h5 class="card-title">Payment</h5>
            <p class="card-text">Buka email tersebut dan lakukan pembayaran. Klik link di dalamnya untuk konfirmasi pembayaran anda. Selesai!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  -->
@endsection
