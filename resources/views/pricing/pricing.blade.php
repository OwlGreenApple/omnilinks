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
            <sup>Rp</sup> 0<sub> /bln<br> gratis <br>selamanya</sub>
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
            <sup>Rp</sup> 85.000<sub> /bln<br>per tahun 1.020.000</sub>
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
            <sup>Rp</sup> 95.000<sub> /bln<br>per tahun 1.140.000</sub>
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
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Dapatkan 1 Bio Link
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang FB Pixel gratis selama 1 bulan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang Google Retargeting gratis selama 1 bulan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Atur tampilan sesuai warna pilihanmu
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Hubungi Support kami via email 
              </div>
            </div>
            
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Respon klik pada link gratis hingga 1000 klik
              </div>
            </div>
            
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Temukan Iklan di Display Omnilinkz
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
              Biaya Per Tahun Rp 1.020.000
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
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Dapatkan 3 Bio Link
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang FB Pixel Gratis Selamanya
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang Google Retargeting Gratis Selamanya
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pilih lebih dari 100 Template Themes Gambar dan Animasi
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Hubungi Support kami via email & live chat
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Unlimited Respon klik pada penggunaan link
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Display Omnilinkz bebas iklan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang 1 Banner Promosi di Display
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Ubah ID Biolink sesuai kebutuhan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Dapatkan data analytic rekam jejak link
              </div>
            </div>

            <!--<div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Dapatkan 10 Single Link
              </div>
            </div>-->

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Bisa hapus Logo Omnilinkz
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
              Biaya Per Tahun 1.140.000
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
            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Dapatkan 10 Bio Link
              </div>
            </div>                 

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang FB Pixel Gratis Selamanya
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang Google Retargeting Gratis Selamanya
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pilih lebih dari 100 Template Themes Gambar dan Animasi
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Hubungi Support kami via email & live chat
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Unlimited Respon klik pada penggunaan link
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Display Omnilinkz bebas iklan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Pasang 5 Banner Promosi di Display
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Ubah ID Biolink sesuai kebutuhan
              </div>
            </div>

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Dapatkan data analytic rekam jejak link
              </div>
            </div>

            <!--<div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Dapatkan Unlimited Single Link
              </div>
            </div>-->

            <div class="row mb-2">
              <div class="offset-md-1 offset-1 col-md-2 col-2 green-color">
                <i class="fas fa-check"></i>
              </div>
              <div class="col-md-9 col-9 text-left">
                Bisa hapus Logo Omnilinkz
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


@endsection