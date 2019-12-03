@extends('layouts.app')

@section('content')
<link href="{{ asset('css/style-thankyou.css') }}" rel="stylesheet">

<div class="container konten">
    <div class="container">
      <div class="row">
        <div class="offset-sm-2 col-sm-8 text-center" style="border:1px solid #ACCBEC; padding: 30px 0px 70px 0px;">
          <span class="icon-thankyou" style="font-size: 60px;color: #106BC8">
            <i class="fas fa-check-circle"></i>
          </span>
          <h1>Thank You<br> For Your Purchasing</h1>
          <hr class="orn" style="color: #106BC8">
          <p class="pg-title">Setelah Anda menyelesaikan langkah-langkah konfirmasi berikut, segera lakukan pembayaran untuk mendapatkan akses langsung ke akun Omnilinks Anda!</p>
        </div>
      </div>
    </div>
  </div>

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
<!-- Facebook Pixel Code page View All Pages-->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '960162064377270');
  fbq('track', 'PageView');
  fbq('track', 'InitiateCheckout');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=960162064377270&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->  
@endsection
