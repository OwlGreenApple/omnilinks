@extends('layouts.app')
@section('content')
<link href="{{ asset('css/kupon.css') }}" rel="stylesheet">
<script src="{{ asset('js/custom.js') }}"></script>


<!-- MAIN -->
<div class="col-lg-12 bg-kupon fix-col">
  <!-- banner promo -->
  <div class="col-lg-12 banner-promo fix-col">
      banner
  </div>

  <!-- SEARCH BOX -->
  <div class="container searchbox">
    <div class="row">
      <div class="col-lg-6">
          <div class="input-group">
          <input type="text" class="form-control" placeholder="Cari Kupon">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="button">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="form-inline float-right">
          <label>Urutkan</label>
          <select class="form-control" id="sel1" name="sellist1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
          </select>
        </div>
      </div>
    </div>
   <div class="clearfix"></div>
  </div>
  <!-- END SEARCH BOX -->

  <!-- COUPON -->
  <div class="container fix-col">
    <div class="col-lg-4 col-md-12 col-12">
      <div class="col-box">
          <div class="col-md-12 pricing-board pro-fix" align="center">
             <h3><b>pro</b></h3>
          </div>

          <div class="col-md-12">
            tingkatkan penjualan mu diawal tahun<br/>lebih hemat 50%
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-lg-6">image</div>
              <div class="col-lg-6">Berlaku Hingga<br/> 1- 5 Januari 2020</div>
            </div>
            <div class="row">
              <div class="col-lg-4">image</div>
              <div class="col-lg-4">Berlaku Hingga<br/> 1- 5 Januari 2020</div>
              <div class="col-lg-4"><a type="button" class="btn btn-default">Salin Kode</a></div>
            </div>
          </div>

           <div class="col-md-12 mb-4 pb-3 price-col">
            <a class="link-pro" href="{{url('checkout/1')}}">
              <button class="btn btn-upgrade-big update">
               Lihat Detail
              </button>
            </a>
          </div>
    
      </div>
    </div> 
  </div>
  <!-- END COUPON -->

  <!-- end main bg -->
</div>

<!-- FAQ -->
<div class="col-lg-12 bg-faq">
  <div class="container">
   <!-- SUPPORT -->
    <div class="col-lg-12 support">
      <h3>Butuh Bantuan <b>Tim Support</b> kami? <a onclick="window.location.href='mailto:info@omnilinkz.com';" class="btn btn-support"><b>Hubungi Kami Segera</b></a></h3>
    </div>
  </div>
</div>

<!---- JAVASCRIPT ---->

<script type="text/javascript">
  // get initial position of the element
  var elm = $('.pricing-box');
  if (elm.length) {
    var fixmeTop = elm.offset().top;
  }

  $(document).ready(function(){
    $(".omnhide").eq(0).click(function(){$('.collapse').eq(1).collapse("toggle");});
    $(".omnhide").eq(1).click(function(){$('.collapse').eq(2).collapse("toggle");});
    $(".omnhide").eq(2).click(function(){$('.collapse').eq(3).collapse("toggle");});
    $(".omnhide").eq(3).click(function(){$('.collapse').eq(4).collapse("toggle");});
    $(".omnhide").eq(4).click(function(){$('.collapse').eq(5).collapse("toggle");});
    $(".omnhide").eq(5).click(function(){$('.collapse').eq(6).collapse("toggle");});
    $(".omnhide").eq(6).click(function(){$('.collapse').eq(7).collapse("toggle");});
    $(".omnhide").eq(7).click(function(){$('.collapse').eq(8).collapse("toggle");});
    $(".omnhide").eq(8).click(function(){$('.collapse').eq(9).collapse("toggle");});
    $(".omnhide").eq(9).click(function(){$('.collapse').eq(10).collapse("toggle");});
    $(".omnhide").eq(10).click(function(){$('.collapse').eq(11).collapse("toggle");});
  });
 

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

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      $('.harga.pro').html('<sup>Rp</sup> 85.000 <sub>/bln<br>per tahun 1.020.000</sub>');
      $('.harga.premium').html('<sup>Rp</sup> 95.000 <sub>/bln<br>per tahun 1.040.000</sub>');
    }
    else {
      $('.harga.pro').html('<sup>Rp</sup> 85.000 <sub>/bln');
      $('.harga-real.pro').html('Biaya Per Tahun Rp 1.020.000');

      $('.harga.premium').html('<sup>Rp</sup> 95.000 <sub>/bln');
      $('.harga-real.premium').html('Biaya Per Tahun Rp 1.140.000');
    }

    $('.hemat').html('<i class="fas fa-redo-alt"></i>&nbsp;Harga Bulanan');

    $('.link-pro').attr('href', "{{url('checkout/2')}}");
    $('.link-premium').attr('href', "{{url('checkout/4')}}");
  });

  // Cause column height so much
  $(document).ready(function() {
    setTimeout(function(){
      var rightH = $('.right-div').css('height');
      // var left = $('.left-div').css('height');
      $('.left-div').css('height',rightH);
    }, 100);
  });

  
</script>

<?php if ( env('APP_ENV') !== "local" ) { ?>
<!-- Provely Conversions App Display Code -->
<script>(function(w,n) {
if (typeof(w[n]) == 'undefined'){ob=n+'Obj';w[ob]=[];w[n]=function(){w[ob].push(arguments);};
d=document.createElement('script');d.type = 'text/javascript';d.async=1;
d.src='https://s3.amazonaws.com/provely-public/w/provely-2.0.js';x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(d,x);}
})(window, 'provelys', '');
provelys('config', 'baseUrl', 'app.provely.io');
provelys('config', 'https', 1);
provelys('data', 'campaignId', '16446');
provelys('config', 'widget', 1);
</script>
<!-- End Provely Conversions App Display Code -->
<?php } ?>
@endsection