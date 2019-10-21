@extends('layouts.app')
@section('content')
<link href="{{ asset('css/style-pricing.css') }}" rel="stylesheet">
<script src="{{ asset('js/custom.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    setTimeout(function(){
      var right = $('.right-div').css('height');
      var left = $('.left-div').css('height');
      $('.left-div').css('height',right);
    }, 100);
  });

  
</script>

<section class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Omnilinkz Pricing Plans</h1>
        
        <p class="pg-title">
          Pilih paket aktivasi Omnilinkz bergantung pada kebutuhan media sosial Anda 
        </p>

        <div class="row mt-5" align="center">
          <div class="col-12">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-secondary btn-pricing year upgrade-radio active" style="outline: none;box-shadow: 0 1px 5px 0 rgba(183,183,183,0.50);">
                <input type="radio" name="options" id="option2" autocomplete="off"> 
                TAHUNAN
              </label>
              <label class="btn btn-secondary btn-pricing month upgrade-radio" style="outline: none; box-shadow: 0 1px 5px 0 rgba(183,183,183,0.50);">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> 
                BULANAN
              </label>
            </div>

            <br>

            <p class="pg-title small pt-0 mt-3">
              Hemat <b>Hingga 52%</b> Dengan Paket Tahunan
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<div class="offset-md-1 col-md-10" align="center">
  <!-- Header -->
  <div class="row header-pricing d-lg-none d-md-none d-none">
    <div class="col-md-4 col-4 pr-0 pl-0">
      <div class="card">
        <div class="card-body pricing">
          <h5 class="gray-color">
            <b class="sbold small">
              FREE
            </b>  
          </h5>
          <span class="harga harga-small free">
            <sup>Rp</sup> 0<sub> /bln</sub>
          </span><br>
          @if(!Auth::check())
          <a class="link-free" href="{{url('register')}}">
          @endif
            <button class="btn btn-block btn-upgrade-big small free">
              DAFTAR
            </button>
          @if(!Auth::check())
          </a>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-4 col-4 pr-0 pl-0">
      <div class="card">
        <div class="card-body pricing">
          <h5 class="green-color">
            <b class="sbold small">
              BASIC
            </b>  
          </h5>
          <span class="harga harga-small pro">
            <sup>Rp</sup> 85.000<sub> /bln</sub>
          </span><br>
          <a class="link-pro" href="{{url('checkout/2')}}">
            <button class="btn btn-block btn-upgrade-big small pro">
              BELI
            </button>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-4 pr-0 pl-0">
      <div class="card">
        <div class="card-body pricing">
          <h5 class="orange-color">
            <b class="sbold small">
              ELITE
            </b>    
          </h5>
          <span class="harga harga-small premium">
            <sup>Rp</sup> 95.000<sub> /bln</sub>
          </span><br>
          <a class="link-premium" href="{{url('checkout/4')}}">
            <button class="btn btn-block btn-upgrade-big small premium">
              BELI
            </button>  
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-md-0 mb-5 pricing-box">
    <div class="col-lg-4 col-md-12 col-12 pl-md-0 pr-md-0">
      <div class="card secondary left-div">
        <div class="card-body upgrade-details">
          <div class="col-md-12" align="center">
            <span class="gray-color">
              <h3>
                <b class="sbold">
                  FREE
                </b>  
              </h3>
            </span>
          </div>

          <div class="col-md-12 pb-3">
            <span class="harga free">
              <sup>Rp</sup> 0<sub> /bln</sub>
            </span><br>
            <span class="harga-real free">
              selamanya
            </span><br>
            <p class="hemat monthly mt-4">
              <i class="fas fa-redo-alt"></i>
              &nbsp;Harga Bulanan
            </p>
          </div>

          @if(!Auth::check())
          <a class="link-free" href="{{url('register')}}">
          @endif
            <button class="btn btn-block btn-upgrade-big free">
              DAFTAR SEKARANG
            </button>
          @if(!Auth::check())
          </a>
          @endif

          <div class="upgrade-details2">
            <!--<div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                1
              </div>  
              <div class="col-md-9 col-9 text-left">
                Omnilinkz URL
                &nbsp;
                <span class="tooltipstered" title="Omnilinkz">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Premium ID
                &nbsp;
                <span class="tooltipstered" title="Premium ID">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Single Link
                &nbsp;
                <span class="tooltipstered" title="Single Link">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color pl-0 pr-0">
                1000
              </div>
              <div class="col-md-9 col-9 text-left">
                Clicks/Bulan
                &nbsp;
                <span class="tooltipstered" title="Clicks/Bulan">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Profile Image
                &nbsp;
                <span class="tooltipstered" title="Profile Image">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Store Brand
                &nbsp;
                <span class="tooltipstered" title="Store Brand">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Banner Promo
                &nbsp;
                <span class="tooltipstered" title="Banner Promo">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Omnlinkz Brand
                &nbsp;
                <span class="tooltipstered" title="Omnilinkz Brand">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Click to WA Creator
                &nbsp;
                <span class="tooltipstered" title="Click to WA Creator">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                WhatsApp
                &nbsp;
                <span class="tooltipstered" title="WhatsApp">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                FB Messenger
                &nbsp;
                <span class="tooltipstered" title="FB Messenger">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Line
                &nbsp;
                <span class="tooltipstered" title="Line">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Skype
                &nbsp;
                <span class="tooltipstered" title="Skype">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Telegram
                &nbsp;
                <span class="tooltipstered" title="Telegram">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                FB Pixel
                &nbsp;
                <span class="tooltipstered" title="FB Pixel">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Google Retargetting
                &nbsp;
                <span class="tooltipstered" title="Google Retargetting">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Twitter Retargetting
                &nbsp;
                <span class="tooltipstered" title="Twitter Retargetting">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Google Analytics
                &nbsp;
                <span class="tooltipstered" title="Google Analytics">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color pl-0 pr-0">
                Email
              </div>
              <div class="col-md-9 col-9 text-left">
                Priority Support
                &nbsp;
                <span class="tooltipstered" title="Priority Support">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                5
              </div>
              <div class="col-md-9 col-9 text-left">
                Themes
                &nbsp;
                <span class="tooltipstered" title="Themes">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Jumlah Klik
                &nbsp;
                <span class="tooltipstered" title="Jumlah Klik">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>
            
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Chart Analytic
                &nbsp;
                <span class="tooltipstered" title="Chart Analytic">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>-->

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Limit 1 Bio Link
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Tersedia hanya 5 variasi tema, membuat background lebih berwarna
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Kontak CS hanya via email
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Limit terbatas hanya hingga 1000 klik saja
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Penggunaan FB Pixel terbatas hanya sebulan saja
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 

    <div class="col-lg-4 col-md-12 col-12 pl-md-0 pr-md-0">
      <div class="card primary card-ribbon">

        <div class="corner-ribbon top-right green">
          FAVORITE
        </div>

        <div class="card-body upgrade-details">
          <div class="col-md-12" align="center green-color">
            <span class="green-color">
              <span class="icon-upgrade green-color">
                <i class="fas fa-trophy"></i>
              </span>
              <h3 class="pt-3">
                <b class="sbold">
                  BASIC
                </b>  
              </h3>
            </span>
          </div>

          <div class="col-md-12 pb-3">
            <span class="harga pro">
              <sup>Rp</sup> 85.000<sub> /bln</sub>
            </span><br>
            <span class="harga-real pro">
              Biaya Per Tahun @ Rp 1.020.000
            </span><br>
            <p class="hemat monthly mt-4">
              <i class="fas fa-redo-alt"></i>
              &nbsp;Harga Bulanan
            </p>
          </div>

          <a class="link-pro" href="{{url('checkout/2')}}">
            <button class="btn btn-block btn-upgrade-big pro">
              BELI PAKET
            </button>
          </a>

          <div class="upgrade-details2">
            <!--<div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                3
              </div>  
              <div class="col-md-9 col-9 text-left">
                Omnilinkz URL
                &nbsp;
                <span class="tooltipstered" title="Omnilinkz">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                3
              </div>
              <div class="col-md-9 col-9 text-left">
                Premium ID
                &nbsp;
                <span class="tooltipstered" title="Premium ID">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-infinity"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Single Link
                &nbsp;
                <span class="tooltipstered" title="Single Link">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-infinity"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Clicks/Bulan
                &nbsp;
                <span class="tooltipstered" title="Clicks/Bulan">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Profile Image
                &nbsp;
                <span class="tooltipstered" title="Profile Image">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Store Brand
                &nbsp;
                <span class="tooltipstered" title="Store Brand">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                1
              </div>
              <div class="col-md-9 col-9 text-left">
                Banner Promo
                &nbsp;
                <span class="tooltipstered" title="Banner Promo">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Omnlinkz Brand
                &nbsp;
                <span class="tooltipstered" title="Omnilinkz Brand">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Click to WA Creator
                &nbsp;
                <span class="tooltipstered" title="Click to WA Creator">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                WhatsApp
                &nbsp;
                <span class="tooltipstered" title="WhatsApp">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                FB Messenger
                &nbsp;
                <span class="tooltipstered" title="FB Messenger">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Line
                &nbsp;
                <span class="tooltipstered" title="Line">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Skype
                &nbsp;
                <span class="tooltipstered" title="Skype">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Telegram
                &nbsp;
                <span class="tooltipstered" title="Telegram">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                FB Pixel
                &nbsp;
                <span class="tooltipstered" title="FB Pixel">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Google Retargetting
                &nbsp;
                <span class="tooltipstered" title="Google Retargetting">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Twitter Retargetting
                &nbsp;
                <span class="tooltipstered" title="Twitter Retargetting">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Google Analytics
                &nbsp;
                <span class="tooltipstered" title="Google Analytics">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color pl-0 pr-0">
                Chat
              </div>
              <div class="col-md-9 col-9 text-left">
                Priority Support
                &nbsp;
                <span class="tooltipstered" title="Priority Support">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                50
              </div>
              <div class="col-md-9 col-9 text-left">
                Themes
                &nbsp;
                <span class="tooltipstered" title="Themes">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Jumlah Klik
                &nbsp;
                <span class="tooltipstered" title="Jumlah Klik">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>
            
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Chart Analytic
                &nbsp;
                <span class="tooltipstered" title="Chart Analytic">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>-->

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Bisa gunakan 3 Bio Link
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Tersedia 1 slide banner saja 
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Ubah id akunmu sesuai kebutuhan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Tersedia 50 variasi tema, membuat background lebih berwarna
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Hubungi CS via email & chat 
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Respon klik pada penggunaan link tidak terhingga
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Ketahui rekam jejak link dengan fitur analytic
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Gunakan FB Pixel sampai kapan pun 
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Gunakan Google retargetting sampai kapan pun
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Bisa hapus logo Omnilinkz
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Display akun Omnilinkz bebas iklan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Tersedia 10 Single Link
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-12 col-12 pl-md-0 pr-md-0">
      <div class="card secondary card-ribbon right-div">
        <div class="card-body upgrade-details">
          <div class="col-md-12" align="center">
            <span class="orange-color">
              <h3>
                <b class="sbold">
                  ELITE
                </b>    
              </h3>
            </span>
          </div>
                
          <div class="col-md-12 pb-3">
            <span class="harga premium">
              <sup>Rp</sup> 95.000<sub> /bln</sub>
            </span><br>
            <span class="harga-real premium">
              Biaya Per Tahun @ 1.140.000
            </span><br>
            <p class="hemat monthly mt-4">
              <i class="fas fa-redo-alt"></i>
              &nbsp;Harga Bulanan
            </p>
          </div>

          <a class="link-premium" href="{{url('checkout/4')}}">
            <button class="btn btn-block btn-upgrade-big premium">
              BELI PAKET
            </button>  
          </a>

          <div class="upgrade-details2">
            <!--<div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                10
              </div>  
              <div class="col-md-9 col-9 text-left">
                Omnilinkz URL
                &nbsp;
                <span class="tooltipstered" title="Omnilinkz">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                10
              </div>
              <div class="col-md-9 col-9 text-left">
                Premium ID
                &nbsp;
                <span class="tooltipstered" title="Premium ID">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-infinity"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Single Link
                &nbsp;
                <span class="tooltipstered" title="Single Link">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-infinity"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Clicks/Bulan
                &nbsp;
                <span class="tooltipstered" title="Clicks/Bulan">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Profile Image
                &nbsp;
                <span class="tooltipstered" title="Profile Image">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Store Brand
                &nbsp;
                <span class="tooltipstered" title="Store Brand">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                5
              </div>
              <div class="col-md-9 col-9 text-left">
                Banner Promo
                &nbsp;
                <span class="tooltipstered" title="Banner Promo">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <span class="red-color">
                  <i class="fas fa-times-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Omnilinkz Brand
                &nbsp;
                <span class="tooltipstered" title="Omnilinkz Brand">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Click to WA Creator
                &nbsp;
                <span class="tooltipstered" title="Click to WA Creator">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                WhatsApp
                &nbsp;
                <span class="tooltipstered" title="WhatsApp">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                FB Messenger
                &nbsp;
                <span class="tooltipstered" title="FB Messenger">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Line
                &nbsp;
                <span class="tooltipstered" title="Line">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Skype
                &nbsp;
                <span class="tooltipstered" title="Skype">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Telegram
                &nbsp;
                <span class="tooltipstered" title="Telegram">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                FB Pixel
                &nbsp;
                <span class="tooltipstered" title="FB Pixel">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Google Retargetting
                &nbsp;
                <span class="tooltipstered" title="Google Retargetting">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Twitter Retargetting
                &nbsp;
                <span class="tooltipstered" title="Twitter Retargetting">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Google Analytics
                &nbsp;
                <span class="tooltipstered" title="Google Analytics">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color pl-0 pr-0">
                Chat
              </div>
              <div class="col-md-9 col-9 text-left">
                Priority Support
                &nbsp;
                <span class="tooltipstered" title="Priority Support">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                50
              </div>
              <div class="col-md-9 col-9 text-left">
                Themes
                &nbsp;
                <span class="tooltipstered" title="Themes">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1  col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Jumlah Klik
                &nbsp;
                <span class="tooltipstered" title="Jumlah Klik">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>
            
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2">
                <span class="green-color">
                  <i class="fas fa-check-circle"></i>
                </span>
              </div>
              <div class="col-md-9 col-9 text-left">
                Chart Analytic
                &nbsp;
                <span class="tooltipstered" title="Chart Analytic">
                  <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
            </div>-->

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Slot link hingga 10 Bio Link
              </div>
            </div>                 

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Tersedia 5 slide banner
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Ubah id akunmu sesuai kebutuhan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Tersedia 50 variasi tema, membuat background lebih berwarna
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Hubungi CS via email & chat
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Respon klik pada penggunaan link tidak terhingga
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Ketahui rekam jejak link dengan fitur analytic
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Gunakan FB Pixel sampai kapan pun
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Gunakan Google retargetting sampai kapan pun
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Bisa hapus logo Omnilinkz
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Display akun Omnilinkz bebas iklan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Single Link tak terhingga
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // get initial position of the element
  var elm = $('.pricing-box');
  if (elm.length) {
    var fixmeTop = elm.offset().top;
  }

  $(window).scroll(function() {                  
    // get current position
    var currentScroll = $(window).scrollTop(); 

    // apply position: fixed if you
    if (currentScroll >= fixmeTop) {           
      $('.header-pricing').addClass('d-md-flex d-flex');
      $('.header-pricing').removeClass('d-md-none d-none');
    } else {
      $('.header-pricing').addClass('d-md-none d-none');
      $('.header-pricing').removeClass('d-md-flex d-flex');
    }
  });

  $("body").on("click", ".btn-pricing.month,.hemat.monthly", function(e) {
    $('.hemat').toggleClass('monthly');
    $('.hemat').toggleClass('yearly');

    $('.btn-pricing.month').addClass('active');
    $('.btn-pricing.year').removeClass('active');

    $('.harga.pro').html('<sup>Rp</sup> 155.000 <sub>/bln</sub>');
    $('.harga-real.pro').html('<b>Dibayar Per Bulan</b>');

    $('.harga.premium').html('<sup>Rp</sup> 195.000 <sub>/bln</sub>');
    $('.harga-real.premium').html('<b>Dibayar Per Bulan</b>');

    $('.hemat').html('<i class="fas fa-redo-alt"></i>&nbsp;Harga Tahunan');

    $('.link-pro').attr('href', "{{url('checkout/1')}}");
    $('.link-premium').attr('href', "{{url('checkout/3')}}");
  });

  $("body").on("click", ".btn-pricing.year,.hemat.yearly", function(e) {
    $('.hemat').toggleClass('monthly');
    $('.hemat').toggleClass('yearly');

    $('.btn-pricing.month').removeClass('active');
    $('.btn-pricing.year').addClass('active');

    $('.harga.pro').html('<sup>Rp</sup> 85.000 <sub>/bln</sub>');
    $('.harga-real.pro').html('Biaya Per Tahun @ Rp 1.020.000');

    $('.harga.premium').html('<sup>Rp</sup> 95.000 <sub>/bln</sub>');
    $('.harga-real.premium').html('Biaya Per Tahun @ Rp 1.140.000');

    $('.hemat').html('<i class="fas fa-redo-alt"></i>&nbsp;Harga Bulanan');

    $('.link-pro').attr('href', "{{url('checkout/2')}}");
    $('.link-premium').attr('href', "{{url('checkout/4')}}");
  });
</script>  

<!--<section class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Omnilinkz</h1>
        <hr class="orn">
        <p class="pg-title">Pilih paket Omnilinkz </p>
        <div class="row" align="center">
          <div class="col-12">
            <div class="onoffswitch">
              <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked="checked">
              <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner" data-id="1"></span>
                <span class="onoffswitch-switch"></span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="comparison">
  <table>
    <thead>
      <tr>
        <th class="tl ">
        </th>
        <th class="qbse compare-heading ">
          FREE TRIAL
        </th>
        <th class="qbse compare-heading ">
          PRO
        </th>
        <th class="qbse compare-heading ">
          PREMIUM
        </th>
      </tr>
      <tr class="">
        <th class="price-info ">
          <div class="price-now features">
            <span>Features</span>
          </div>
        </th>
        <th class="price-info ">
          <div class="price-now"><span>0,-</span></div>
          <div>
            <a href="{{url('register')}}">
              <button type="submit" class="btn btn-default btn-primary-free">
                SELECT
              </button>
            </a>
          </div>
        </th>
        <th class="price-info ">
          <div class="price-now"><span class="nprice price_pro">155,000,-</span></div>

          <div class="monthly-button">
            <a href="{{url('checkout/1')}}">
              <button class="btn select-price btn-default btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/2')}}">
              <button class="btn select-price btn-default btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </th>
        <th class="price-info ">
          <div class="price-now"><span class="nprice price_premium">195,000,-</span></div>

          <div class="monthly-button">
            <a href="{{url('checkout/3')}}">
              <button class="btn btn-default select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/4')}}">
              <button class="btn btn-default select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Omnilinkz
          <span class="tooltipstered" title="Omnlinkz">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Omnilinkz
          <span class="tooltipstered" title="Omnilinkz">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">1</span></td>
        <td><span class="tickblue">5</span></td>
        <td><span class="tickblue">Unlimited</span></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">
          Single Link
          <span class="tooltipstered" title="Single Link">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Single Link
          <span class="tooltipstered" title="Single Link">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">2</span></td>
        <td><span class="tickblue">5</span></td>
        <td><span class="tickblue">Unlimited</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Clicks /Hari
          <span class="tooltipstered" title="Clicks /Hari">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Clicks /Hari
          <span class="tooltipstered" title="Clicks /Hari">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">10</span></td>
        <td><span class="tickblue">Unlimited</span></td>
        <td><span class="tickblue">Unlimited</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Profile Image
          <span class="tooltipstered" title="Profile Image">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Profile Image
          <span class="tooltipstered" title="Profile Image">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Store Brand
          <span class="tooltipstered" title="Store Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Store Brand
          <span class="tooltipstered" title="Store Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Banner Promo
          <span class="tooltipstered" title="Banner Promo">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Banner Promo
          <span class="tooltipstered" title="Banner Promo">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">1</span></td>
        <td><span class="tickblue">5</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Click to WA Creator
          <span class="tooltipstered" title="Click to WA Creator">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Click to WA Creator
          <span class="tooltipstered" title="Click to WA Creator">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Whatsapp
          <span class="tooltipstered" title="Whatsapp">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Whatsapp
          <span class="tooltipstered" title="Whatsapp">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          FB Messenger
          <span class="tooltipstered" title="FB Messenger">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          FB Messenger
          <span class="tooltipstered" title="FB Messenger">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Line
          <span class="tooltipstered" title="Line">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Line
          <span class="tooltipstered" title="Line">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Skype
          <span class="tooltipstered" title="Skype">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Skype
          <span class="tooltipstered" title="Skype">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          WeChat
          <span class="tooltipstered" title="WeChat">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          WeChat
          <span class="tooltipstered" title="WeChat">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Telegram
          <span class="tooltipstered" title="Telegram">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Telegram
          <span class="tooltipstered" title="Telegram">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          FB Pixel
          <span class="tooltipstered" title="FB Pixel">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          FB Pixel
          <span class="tooltipstered" title="FB Pixel">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Google Retargetting
          <span class="tooltipstered" title="Google Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Google Retargetting
          <span class="tooltipstered" title="Google Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Twitter Retargetting
          <span class="tooltipstered" title="Twitter Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Twitter Retargetting
          <span class="tooltipstered" title="Twitter Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Google Analytics
          <span class="tooltipstered" title="Google Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Google Analytics
          <span class="tooltipstered" title="Google Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Priority Support
          <span class="tooltipstered" title="Priority Support">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Priority Support
          <span class="tooltipstered" title="Priority Support">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Themes
          <span class="tooltipstered" title="Themes">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Themes
          <span class="tooltipstered" title="Themes">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">5</span></td>
        <td><span class="tickblue">50</span></td>
        <td><span class="tickblue">50</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Hide Omnilinkz Brand
          <span class="tooltipstered" title="Hide Omnilinkz Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Hide Omnilinkz Brand
          <span class="tooltipstered" title="Hide Omnilinkz Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Report Analytics
          <span class="tooltipstered" title="Report Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Report Analytics
          <span class="tooltipstered" title="Report Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">Buy Now</td>
      </tr>
      <tr>
        <td></td>
        <td>
          <div>
            <a href="{{url('register')}}">
              <button class="btn btn-default select-price btn-primary-free" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </td>
        <td>
          <div class="monthly-button">
            <a href="{{url('checkout/1')}}">
              <button class="btn select-price btn-success btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/2')}}">
              <button class="btn select-price btn-success btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </td>
        <td>
          <div class="monthly-button">
            <a href="{{url('checkout/3')}}">
              <button class="btn btn-success select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/4')}}">
              <button class="btn btn-success select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>-->
@endsection