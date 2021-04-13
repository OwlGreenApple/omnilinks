@extends('layouts.app')

@section('content')

<section class="bg-generator">
  <div class="container row mx-auto">

    <div class="col-lg-6">
      <div class="wa-gen-form">
      <div class="modal-dialog col-lg-10" role="document">
        <div class="modal-content">
          <!-- images icon -->
          <div class="icon-generator">
            <img src="{{ asset('css/images/whatsapp.png') }}" />
            <img class="abs_image" src="{{ asset('css/images/omnilinkz.png') }}" />
          </div>

          <div class="modal-body">
            <form class="mb-4 mx-auto">
              <div class="form-group text-dark no-wa mb-0">
                <label><b>Masukkan Nomor WA Anda</b></label>
                <input type="number" min="0" class="form-control mb-2" name="number" />
                <span class="sml">Pastikan nomor anda dimulai dengan area kode negara, <br/>contoh : 62 811 3481 598 untuk negara Indonesia</span>
              </div>

              <div class="form-group text-dark mt-1">
                <label class="mb-0"><b>Isi Pesan yang Anda Inginkan</b></label>
                <input type="text" class="form-control" name="text" />
              </div>
             
              <button type="button" class="btn btn-wa-generator w-100"><b>Buat Link</b></button>

              <span id="wa-link">
                <hr />
      
                <div class="row">
                   <div class="col-lg-12">
                    <div class="input-group">
                      <input type="text" class="form-control" name="copy">
                      <span class="input-group-btn">
                        <button class="btn btn-copy" type="submit"><img src="{{ asset('css/images/copy-icon.png') }}" />Copy Link</button>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
              </span>
          
            <div class="copied text-dark text-center mb-0">Button Copied!</div>
            </form>

          </div>
        </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
    </div>

    <div class="col-lg-6 wa-gen-text">
      <exbold>GRATIS buat click to chat</exbold> <br/>
      <exbold>Whatsapp link generator</exbold><br />
      <div class="reg-font">
        Gunakan FREE whatsapp WA click to chat link generator ini<br/> 
        untuk membuat click to whatsapp link dengan mudah.<br/> 
        Kombinasikan link ini dengan Omnilinkz untuk <br/> 
        meningkatkan konversi penjualan anda!<br/> 
        <br/> 
        Dapatkan promo terbaru Omnilinkz<br/> 
        Klik Disini
      </div>
    </div>
  </div>
</section>

<div class="white-bg"></div>

<script type="text/javascript">
  $(function(){

    $(".btn-wa-generator").click(function(){
      var number = $("input[name='number']").val();
      number = number.replace(/\+/g,'');

      var text = $("input[name='text']").val();
      text = text.replace(/\s/g,'%20');

      var url = "https://api.whatsapp.com/send?phone="+number+"&text="+text+"";

      $(".btn-copy").attr('data-link',url);
      $("input[name='copy']").val(url);
      $("#wa-link").show();

    });

    $( "body" ).on( "click", ".btn-copy", function(e) 
    {
      e.preventDefault();
      e.stopPropagation();

      //var id = $(this).attr("data-id");
      var link = $(this).attr("data-link");

      var tempInput = document.createElement("input");
      tempInput.style = "position: absolute; left: -1000px; top: -1000px";
      tempInput.value = link;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      document.body.removeChild(tempInput);
      // $('#copy-link').modal('show');
      $(".copied").show();
      setTimeout(function(){
         $(".copied").fadeOut(2000);
      },1500);
    });

  });
</script>

@endsection