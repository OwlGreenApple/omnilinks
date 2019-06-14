@extends('layouts.app')
@section('content')
<script type="text/javascript">
  $(document).ready(function() {
    function toggleIcon(e) {
      $(e.target)
        .prev('.card-header').find(".fa").toggleClass('fa-caret-right fa-caret-down');
    }
    $('.accordion').on('hidden.bs.collapse', toggleIcon);
    $('.accordion').on('shown.bs.collapse', toggleIcon);
  });
</script>

<link rel="stylesheet" href="{{asset('css/about.css')}}">

<header class="content-header" style="padding-bottom: 80px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="omni-title mb-5">OMNILINKZ FAQ PAGES</h1>
        <p class="col-md-10 col-12 mx-auto" style="font-size: 19px; font-weight: 400;text-align: justify;">
          &emsp;Berikut ini daftar serangkaian pertanyaan umum yang terkait dengan Omnilinkz. Lihat dan baca pertanyaan di sini terlebih dahulu sebelum menanyakan ke admin supaya Anda bisa menghemat banyak waktu.
        </p>
      </div>
    </div>
  </div>
</header>

<section class="content" style="min-height: calc(100vh - 635px)">
  <div class="container">
    <div class="row">
      <div class="col-10 mx-auto">
        <div class="accordion" id="faqExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btx btn btn-link btn-block text-left btn-faq" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <b class="faq-head">
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>
                    Apa itu Omnilinkz?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapseOne" class="fade collapse" aria-labelledby="headingOne" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Omnilinkz adalah tools yang membantu Anda mencantumkan banyak link hanya pada 1 link saja pada bio Instagram. 
                <br><br>
                Anda bisa menambahkan banyak channel media chat seperti WhatsApp, LINE, Telegram dan lain sebagainya. Anda juga bisa menambahkan news terkini hingga link check out produk yang sedang promo diskon.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btx btn btn-link btn-block text-left btn-faq collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <b class="faq-head"> 
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>
                    Siapa Pengguna Omnilinkz?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Omnilinkz cocok dipakai untuk selebgram, pebisnis, vloger, blogger dan siapapun yang menekuni dunia iklan, endorse, dan Instagram.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btx btn btn-link btn-block text-left collapsed btn-faq" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <b class="faq-head"> 
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>
                    Bagaimana cara menggunakan Omnilinkz?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
              <div class="card-body faq-txt">
                Klik alamat laman Omnilinkz. Pilih registrasi di kanan atas. <br>
                Isi data lengkap, klik registrasi. <br>
                Cek email untuk Dapatkan username & password <br>
                Gunakan username & password untuk login <br>
                <br>
                Selamat, registrasi Anda telah sukses.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingfour">
              <h5 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed btn-faq" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                  <b class="faq-head">
                    <span class="blue-icon">
                      <i class="fa fa-caret-right"></i>&nbsp;
                    </span>
                    Apa saja kemudahan yang didapat dari penggunaan Omnilinkz?
                  </b>
                </button>
              </h5>
            </div>
            <div id="collapsefour" class="fade collapse" aria-labelledby="headingfour" data-parent="#faqExample">
              <div class="card-body faq-txt">
                - Anda bisa menambahkan chaneel media komunikasi seperti WhatsApp, LINE, Telegram dan lain-lain. <br>
                - Anda bisa menaruh link news terkini maupun konten video terbaru. <br>
                - Link memiliki tracking dengan google retargeting. <br>
                - Media promosi melalui media visual pada banner dan headlines. <br>
                - Mempermudah konsumen maupun followers dalam proses check out produk di online shop Anda. 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--container-->
<section class="secfoot">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2>Can’t find what you’re looking for?</h2>

        <a href="mailto:omnilinkzcom@gmail.com?subject=Mail from Our Site"> 
          <button type="button" class="btn btn-primary btn-lg btn-email">
            EMAIL US
          </button>
        </a>
      </div>
    </div>
  </div>
</section>

@endsection