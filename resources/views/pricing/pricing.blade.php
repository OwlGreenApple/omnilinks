@extends('layouts.app')
@section('content')
<script src="{{ asset('js/custom.js') }}"></script>

<section class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="">Omnilinkz <strong>Pricing Plans</strong></h1>
      </div>
    </div>
  </div>
</section>

<div class="offset-md-1 col-md-10 pricing-position" align="center">
  <!-- Header -->

  <!-- SMALL COLUMN -->
  <div class="row header-pricing d-lg-none d-md-none d-none">
    <div class="col-md-4 col-4 pr-0 pl-0">
      <div class="card">
        <div class="card-body pricing">
          <h5 class="pricing-board">
            <b class="sbold small">
              PRO
            </b>  
          </h5>
          <span class="harga harga-small free">
            Rp&nbsp;195.000 <br> <sub> /30&nbsp;Hari</sub>
          </span><br>
          @if(!Auth::check())
          <a class="link-free" href="{{url('checkout/1')}}">
          @endif
            <button class="btn btn-block btn-upgrade-big small update">
              BELI
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
          <h5 class="pricing-board">
            <b class="sbold small">
              POPULAR
            </b>  
          </h5>
          <span class="harga harga-small pro">
            Rp&nbsp;395.000 <br><sub> /90&nbsp;Hari</sub>
          </span><br>
          <a class="link-pro" href="{{url('checkout/2')}}">
            <button class="btn btn-block btn-upgrade-big small update">
              BELI
            </button>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-4 pr-0 pl-0">
      <div class="card">
        <div class="card-body pricing">
          <h5 class="pricing-board">
            <b class="sbold small">
              ELITE
            </b>    
          </h5>
          <span class="harga harga-small premium">
             Rp&nbsp;695.000 <br><sub> /180&nbsp;Hari</sub>
          </span><br>
          <a class="link-premium" href="{{url('checkout/3')}}">
            <button class="btn btn-block btn-upgrade-big small update">
              BELI
            </button>  
          </a>
        </div>
      </div>
      <a href="#super">Show More</a>
    </div>

  </div>

  <!-- Large Pricing Box -->

  <div class="row mb-md-0 mb-5 pricing-box bg-pricing">

    <!-- LARGE COL 1  -->
    <div class="col-lg-3 col-md-12 col-12 pl-md-0 pr-md-0 pricing-fix-col">
      <div class="card secondary col-box">
        <div class="card-body price-box">

          <div class="col-md-12 pricing-pro pro-fix" align="center">
             <h3>
              <b>
                pro
              </b>  
            </h3>
          </div>

          <div class="col-md-12 price-col">
            <span class="harga">
              Rp&nbsp;195.000
            </span><br>
            <span class="harga-real free">
              /30 Hari
            </span><br>
            <div class="col-lg-10"><hr color="#3c65af"></div>
          </div>

          <div class="col-md-12 pb-3 price-col">
            <p class="list" style="width : 1px; height : 35px;"></p>
            <p class="list"><b>3 Bio Link</b></p>
            <p class="list">Lebih dari <b>25 Theme Background</b></p>
            <p class="list">Pasang <b>1 Banner Promo</b></p>
          </div>

           <div class="col-md-12 mb-4 pb-3 price-col">
           <a class="link-pro" href="{{url('checkout/1')}}">
            <button class="btn btn-upgrade-big update">
              BELI SEKARANG
            </button>
          </a>
          </div>
      
        </div>
      </div>
    </div> 

    <!-- LARGE COL 2 -->

    <div class="col-lg-3 col-md-12 col-12 pl-md-0 pr-md-0 pricing-fix-col">
      <div class="card secondary col-box">
        <div class="card-body price-box">

          <div class="col-md-12 pricing-board pricing-board-fix" align="center">
            <div class="float-left pricing-board-brand">
                 <h3>
                  <b>
                    popular
                  </b>  
                </h3>
            </div>

            <div class="float-right pricing-fix-padding"><img src="{{ url('/image/ribbon-best-value.png') }}" /></div>
            <div class="clearfix"></div>
          </div>

          <div class="col-md-12 price-col">
            <span class="harga">
              Rp&nbsp;395.000
            </span><br>
            <span class="harga-real free">
              /90 Hari
            </span><br>
            <div class="col-lg-10"><hr color="#3c65af"></div>
          </div>

          <div class="col-md-12 pb-3 price-col">
            <p class="list"><b class="price-save">Hemat 32%</b></p>
            <p class="list"><b>3 Bio Link</b></p>
            <p class="list">Lebih dari <b>25 Theme Background</b></p>
            <p class="list">Pasang <b>1 Banner Promo</b></p>
          </div>

          <div class="col-md-12 mb-4 pb-3 price-col">
           <a class="link-pro" href="{{url('checkout/2')}}">
            <button class="btn btn-upgrade-big update">
              BELI SEKARANG
            </button>
          </a>
          </div>
      
        </div>
      </div>
    </div> 

    <!-- LARGE COL 3 -->

    <div class="col-lg-3 col-md-12 col-12 pl-md-0 pr-md-0 pricing-fix-col pricing-fix-elite">
      <div class="card primary col-box">
        <div class="card-body price-box">

          <div class="col-md-12 pricing-board pricing-elite" align="center">
             <h1>
              <b>
                elite
              </b>  
            </h1>
          </div>

          <div class="col-md-12 pricing-board-super" align="center">
            <div class="left-ribbon"></div>
            <div class="best-seller">
                 <h3>
                  <b>
                    best seller
                  </b>  
                </h3>
            </div>
            <div class="right-ribbon"></div>
            <div class="clearfix"></div>
          </div>


          <div class="col-md-12 price-col">
            <span class="harga">
              Rp&nbsp;695.000
            </span><br>
            <span class="harga-real free">
              /180 Hari
            </span><br>
            <div class="col-lg-10"><hr color="#3c65af"></div>
          </div>

          <div class="col-md-12 pb-3 price-col">
            <p class="list"><b class="price-save">Hemat 41%</b></p>
            <p class="list"><b>10 Bio Link</b></p>
            <p class="list">Lebih dari <b>100 Theme Background</b></p>
            <p class="list">Pasang <b>5 Banner Promo</b></p>
          </div>

          <div class="col-md-12 mb-4 pb-3 price-col">
           <a class="link-pro" href="{{url('checkout/3')}}">
            <button class="btn btn-upgrade-big update">
              BELI SEKARANG
            </button>
          </a>
          </div>
      
        </div>
      </div>
    </div> 

    <!-- LARGE COL 4 -->
     <div class="col-lg-3 col-md-12 col-12 pl-md-0 pr-md-0 pricing-fix-col">
      <div class="card secondary col-box">
        <div class="card-body price-box">
          <div class="col-md-12 pricing-board pricing-board-super" align="center">
            <div class="float-left pricing-board-brand pricing-board-brand-super">
                 <h3>
                  <b>
                    super
                  </b>  
                </h3>
            </div>

            <div class="float-right pricing-fix-padding-super"><img class="pricing-fix-super" src="{{ url('/image/ribbon-super-value.png') }}" /></div>
            <div class="clearfix"></div>
          </div>
		  
		  <span id="super"></span>

          <div class="col-md-12 price-col">
            <span class="harga">
              Rp&nbsp;1.095.000
            </span><br>
            <span class="harga-real free">
              /360 Hari
            </span><br>
            <div class="col-lg-10"><hr color="#3c65af"></div>
          </div>

          <div class="col-md-12 pb-3 price-col">
            <p class="list"><b class="price-save">Hemat 53%</b></p>
            <p class="list"><b>10 Bio Link</b></p>
            <p class="list">Lebih dari <b>100 Theme Background</b></p>
            <p class="list">Pasang <b>5 Banner Promo</b></p>
          </div>

          <div class="col-md-12 mb-4 pb-3 price-col">
           <a class="link-pro" href="{{url('checkout/4')}}">
            <button class="btn btn-upgrade-big update">
              BELI SEKARANG
            </button>
          </a>
          </div>
      
        </div>
      </div>
    </div>

    <!-- NOTES COLUMN -->
    <div class="col-md-12 notes-wrap">
          <!-- RESPONSIVE -->
         <div class="col-lg-3 notes-responsive">
          <li>Unlimited Respon Klik</li>
          <li>Unlimited FB, Twitter,Google</li>
          <li>Retargeting</li>
          <li>Background Animation&nbsp;<i class="fa fa-star fa-lg clipped"></i></li>
          <li>WA Chat&nbsp;<i class="fa fa-star fa-lg clipped"></i></li>
          <li>Custom Bio Link</li>
          <li>Support by Live Chat & Email</li>
          <li>Bio Link Bebas Iklan</li>
          <li>Data Analytic Per Button</li>
          <li>Sembunyikan Logo Omnilinkz</li>
          <li class="nostyle">&nbsp;</li>
          <li class="nostyle"><i class="fa fa-star fa-lg clipped"></i>&nbsp;:&nbsp;Khusus paket elite dan super</li>
        </div> 

      <div class="row ml-0 mr-0">
        <!-- col -1 -->
         <div class="col-lg-3 notes-col">
          <li>Unlimited Respon Klik</li>
          <li>Unlimited FB, Twitter,Google</li>
          <li>Retargeting</li>
          <li>Custom Bio Link</li>
          <li>Support by Live Chat & Email</li>
          <li>Bio Link Bebas Iklan</li>
          <li>Data Analytic Per Button</li>
          <li>Sembunyikan Logo Omnilinkz</li>
        </div> 

        <!-- col -2 -->
         <div class="col-lg-3 notes-col">
          <li>Unlimited Respon Klik</li>
          <li>Unlimited FB, Twitter,Google</li>
          <li>Retargeting</li>
          <li>Custom Bio Link</li>
          <li>Support by Live Chat & Email</li>
          <li>Bio Link Bebas Iklan</li>
          <li>Data Analytic Per Button</li>
          <li>Sembunyikan Logo Omnilinkz</li>
        </div> 

        <!-- col -3 -->
         <div class="col-lg-3 notes-col">
          <li>Unlimited Respon Klik</li>
          <li>Unlimited FB, Twitter,Google</li>
          <li>Retargeting</li>
          <li>Background Animation</li>
          <li>WA Chat</li>
          <li>Custom Bio Link</li>
          <li>Support by Live Chat & Email</li>
          <li>Bio Link Bebas Iklan</li>
          <li>Data Analytic Per Button</li>
          <li>Sembunyikan Logo Omnilinkz</li>
        </div>

        <!-- col -4 -->
         <div class="col-lg-3 notes-col">
          <li>Unlimited Respon Klik</li>
          <li>Unlimited FB, Twitter,Google</li>
          <li>Retargeting</li>
          <li>Background Animation</li>
          <li>WA Chat</li>
          <li>Custom Bio Link</li>
          <li>Support by Live Chat & Email</li>
          <li>Bio Link Bebas Iklan</li>
          <li>Data Analytic Per Button</li>
          <li>Sembunyikan Logo Omnilinkz</li>
        </div>
      </div>  <!-- end row -->
    </div> <!-- END NOTES -->
  </div><!-- end large pricing column -->

  <!-- TAGS -->
    <div class="col-lg-10 tags">
      <li><b>Coba 7 Hari Gratis Paket Limited</b></li>
      <li><b>1 Bio</b> Per Akun</li>
      <li><b>7 Hari</b> Pasang FB Retargeting</li>
      <li>Respon <b>1000 Klik</b></li>
      <li><a href="{{ route('register') }}"><b>Daftar Sekarang</b></a></li>
    </div>
  <!-- END TAGS -->

</div> <!-- end header -->

<!-- THUMBNAIL -->
<div class="col-lg-12 bg-thumbnail">
    <h3>Omnilinkz telah dipercaya oleh Ribuan Pebisnis Online</h3>
    <h3>Hanya dalam kurun waktu kurang dari satu bulan</h3>

    <h4><img src="{{asset('/image/stars.png')}}"/>&nbsp;4.5/5 avg. reviews</h4>
</div>
<!-- END -- THUMBNAIL -->

<!-- FAQ -->
<div class="col-lg-12 bg-faq">
  <div class="container">
  <h3 align="center">Frequently Asked Question</h3>
  <!-- col -->
    <div class="row">
        <div class="col-lg-6 faq-col">
          <div class="col-lg-12">
            <h5 class="omnhide">Apa itu Omnilinkz?</h5>
            <p class="collapse">
              Omnilinkz adalah Tool untuk membuat All In One Call To Action Link pengganti Bio Link Instagram Anda. Bisa juga dipakai untuk Facebook page, Twitter dan semua social media profile link.
            </p> 
          </div>

          <div class="col-lg-12">
            <h5 class="omnhide">Bagaimana cara penggunaannya?</h5>
            <p class="collapse">
              Penggunaanya sangat mudah, hanya perlu 5-10 menit untuk membuat 1 Bio Link baru. Dijamin Newbiefriendly. Dan juga di dalam Dashboard ada Video tutorial yang akan menuntun anda selangkah demi selangkah.
            </p> 
          </div>

          <div class="col-lg-12">
            <h5 class="omnhide">Apakah bisa coba Omnilinkz Gratis?</h5>
            <p class="collapse">
              Iya, Anda bisa coba Omnilinkz paket Limited GRATIS 7 hari. Anda mendapatkan 1000 klik GRATIS, cukup bagi pebisnis pemula. Anda juga bisa upgrade naik ke fitur yang lebih spesial jika anda inginkan sesuai dengan kapasitas bisnis anda.
            </p> 
          </div> 

          <div class="col-lg-12">
            <h5 class="omnhide">Apa keunggulan Omnilinkz?</h5>
            <p class="collapse">
              1. Anda dapat membuat 1,3 & 10 Bio Link ( sesuai paket anda )<br/>
              2. Setiap Link di Bio Link yang telah dibuat, bisa ditanamkan kode FB Pixel, Google Retargetting & Analytics<br/>
              3. Pasang Banner Promo untuk menarik perhatian customer<br/>
              4. Click to WA Creator, langsung dari dalam dashboard<br/>
              5. ​​Anda bisa mencoba Omnilinkz 7 hari GRATIS<br/>
              6. Dedicated Support & 100% karya anak bangsa<br/>
            </p> 
          </div> 

          <div class="col-lg-12">
            <h5 class="omnhide">Apa itu Bio Link?</h5>
            <p class="collapse">
              Bio Link adalah salah satu fitur utama Omnilink. Di fitur ini Anda bisa Share semua Link & Kontak penting Anda dalam 1 URL (Bio Link) sehingga Anda tidak perlu mengganti Link Profile di Instagram Anda lagi.
            </p> 
          </div>

        </div>
        <!-- -->
        <div class="col-lg-6 faq-col">
           <div class="col-lg-12">
            <h5 class="omnhide">Bisakah mengubah Bio Link yang sudah diedit?</h5>
            <p class="collapse">
              Tentu saja, Anda bisa mengubah dan menghapus Bio Link yang telah dibuat. Untuk mengubah link di Bio Link anda bisa upgrade ke paket selanjutnya.
            </p> 
          </div>

          <div class="col-lg-12">
            <h5 class="omnhide">Bagaimana cara mendaftar?</h5>
            <p class="collapse">
              Langsung saja Klik <a href="{{route('register')}}">► [DAFTAR DISINI]</a> , pilih paket & ikuti petunjuk nya step by step
            </p> 
          </div>

          <div class="col-lg-12">
            <h5 class="omnhide">Apakah ada Support yang bisa membantu?</h5>
            <p class="collapse">
              Omnilinkz mempunyai Dedicated Support Team yang siap membantu anda menggunakan Support Email. Jika Anda ingin mendapatkan Support Chat prioritas, anda tinggal upgrade ke paket selanjutnya.
            </p> 
          </div>

          <div class="col-lg-12">
            <h5 class="omnhide">Apa saja paket Omnilinkz?</h5>
            <p class="collapse">
              Omnilinkz mempunyai 4 Paket ( Pro, Populer & Elite, Super) silahkan Klik <a href="{{url('pricing')}}">► [DAFTAR PAKET]</a> untuk detail yang lebih jelas untuk setiap paketnya
            </p> 
          </div> 

          <div class="col-lg-12">
            <h5 class="omnhide">Bagaimana cara konfirmasi pembayaran?</h5>
            <p class="collapse">
             Silahkan Klik disini <a href="{{url('orders')}}">► [KONFIRMASI PEMBAYARAN]</a> Baca & Ikuti langkah yang tertera di halaman tersebut.
            </p> 
          </div>

        </div>
    </div>
  <!-- end col -->

   <!-- SUPPORT -->
    <div class="col-lg-12 support">
      <h3>Butuh Bantuan <b>Tim Support</b> kami? <a onclick="window.location.href='mailto:info@omnilinkz.com';" class="btn btn-support"><b>Hubungi Kami Segera</b></a></h3>
    </div>

  </div>
</div>
<!-- END FAQ -->

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
  provelys('data', 'campaignId', '16066');
  provelys('config', 'widget', 1);
  </script>
  <!-- End Provely Conversions App Display Code -->
  
  <!-- Facebook Pixel Code Activomni Initiate Checkout -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '181710632734846');
    fbq('track', 'InitiateCheckout');
  </script>
  <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=181710632734846&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Facebook Pixel Code -->
  
<?php } ?>
@endsection