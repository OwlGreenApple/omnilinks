@extends('layouts.app')

@section('content')
<link href="{{ asset('css/style-thankyou.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<?php if ( env('APP_ENV') !== "local" ) { ?>
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
  </script>
  <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=960162064377270&ev=PageView&noscript=1"
  /></noscript>

  <script>
    fbq('track', 'Purchase');
  </script>
  <!-- End Facebook Pixel Code -->
  
  <!-- Event snippet for Website sale conversion page --> 
  <script> 
    gtag('event', 'conversion', { 'send_to': 'AW-482312235/fOOYCJzK2ugBEKuA_uUB', 'transaction_id': '' }); 
  </script>  
<?php } ?>
<div class="container konten konten-register">
  <div class="offset-sm-2 col-sm-8">
    <div class="card h-80 card-payment" style="margin-bottom: 50px">
      <div class="card-body">
          <span class="icon-thankyou" style="font-size: 60px;color: #106BC8">
            <i class="fas fa-check-circle"></i>
          </span>
          <h1>Thank You<br> For Your Payment</h1>
          <hr class="orn" style="color: #106BC8">
          <div class="form-group">
          <p class="pg-title">Silahkan, tunggu proses konfirmasi dari admin <br>maksimum 1x24jam kerja. <br>
          <br>
          </p>
          </div>
          <div class="form-group offset-md-2 col-md-8 col-12">
            <a href="{{url('/')}}" class="free-underline">
              <input type="button" class=" btn btn-primary bsub btn-block" value="Kembali ke Dashboard" style="margin-top:-10px;" />
            </a>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
