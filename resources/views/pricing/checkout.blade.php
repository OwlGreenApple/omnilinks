@extends('layouts.app')
@section('content')
<?php 
  use App\Coupon;
  $showPackage = false;
  if (is_numeric($id)){
    $showPackage = true;
  }
  $coupon = Coupon::where('kodekupon',$id)
            ->first();
  if (!is_null($coupon)){
    if(($coupon->valid_to=='') || ($coupon->valid_to=='expired-membership') || ($coupon->valid_to=='all') ){
      $showPackage = true;
    }
  }
?>
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container" style="margin-top:50px; margin-bottom:100px">
  <div class="row justify-content-center">
    <div class="col-md-8 col-12">
      <div class="card-custom">
        <div class="card cardpad">


          @if (session('error') )
            <div class="col-md-12 alert alert-danger">
              {{session('error')}}
            </div>
          @endif

          <?php if (Auth::check()) {?>
          <form method="POST" action="{{url('confirm-payment')}}">
            <?php } else {?>
            <form method="POST" action="{{url('register-payment')}}">
              <?php }?>
              {{ csrf_field() }}
              <input type="hidden" id="price" name="price">
              <input type="hidden" id="namapaket" name="namapaket">
              <h2 class="Daftar-Disini">Pilih Paket Anda</h2>
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <label class="text" for="formGroupExampleInput">Pilih Paket:</label>
                  <select class="form-control" name="idpaket" id="select-auto-manage">
                    @if($showPackage) 
                      @if($type=="normal-package")

                        <option class="" data-price="195000" data-paket="Pro" value="1" <?php if ($id==1) echo "selected" ; ?>>
                          Pro - IDR 195.000,-/1 Tahun
                        </option>
                        <option class="" data-price="225000" data-paket="Popular" value="2" <?php if ($id==2) echo "selected" ; ?>>
                          Popular - IDR 225.000,-/1 Tahun
                        </option>
                        <option class="" data-price="255000" data-paket="Elite" value="3" <?php if ($id==3) echo "selected" ; ?>>
                          Elite - IDR 255.000,-/1 Tahun
                        </option>
                        <option class="" data-price="295000" data-paket="Super" value="4" <?php if ($id==4) echo "selected" ; ?>>
                          Super - IDR 295.000,-/1 Tahun
                        </option> 
                      @endif
                      @if(Auth::check() && $type=="ads-package")
                        <option class="" data-price="62500" data-paket="Top Up 5000" value="5" <?php if ($id==5) echo "selected" ; ?>>
                          Top Up 5000 points
                        </option>
                        <option class="" data-price="115000" data-paket="Top Up 10000" value="6" <?php if ($id==6) echo "selected" ; ?>>
                          Top Up 10000 points
                        </option>
                        <option class="" data-price="210000" data-paket="Top Up 20000" value="7" <?php if ($id==7) echo "selected" ; ?>>
                          Top Up 20000 points
                        </option>
                        <option class="" data-price="237000" data-paket="Top Up 25000" value="8" <?php if ($id==8) echo "selected" ; ?>>
                          Top Up 25000 points
                        </option>
                        <option class="" data-price="425000" data-paket="Top Up 50000" value="9" <?php if ($id==9) echo "selected" ; ?>>
                          Top Up 50000 points
                        </option>
                        <option class="" data-price="562000" data-paket="Top Up 75000" value="10" <?php if ($id==10) echo "selected" ; ?>>
                          Top Up 75000 points
                        </option>
                        <option class="" data-price="650000" data-paket="Top Up 100000" value="11" <?php if ($id==11) echo "selected" ; ?>>
                          Top Up 100000 points
                        </option>
                      @endif
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-12">
                  <label class="label-title-test" for="formGroupExampleInput">
                    Masukkan Kode Kupon:
                  </label>

                  <input type="text" class="form-control form-control-lg" name="kupon" id="kupon" placeholder="Kode Kupon Anda" style="width:100%">  
                  <button type="button" class="btn btn-primary btn-kupon  form-control-lg col-md-3 col-sm-12 col-xs-12 mt-3">
                    Apply
                  </button>  
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-12">
                  <div id="pesan" class="alert"></div>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-md-12 col-12">
                  <label class="label-title-test" for="formGroupExampleInput">
                    Total: 
                  </label>
                  <div class="col-md-12 pl-0">
                    <span class="total" style="font-size:18px"></span>
                  </div>  
                </div>
              </div>
              <!--<div class="form-group">
                <div class="col-12 col-md-12">
                  <label class="text" for="formGroupExampleInput">Masukkan Kode Kupon:</label>
                  <input type="text" class="form-control form-input" name="text" id="text" placeholder="Masukkan Kode Kupon Disini Jika Punya" />
                </div>
              </div>-->
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                  <label for="agree-term" class="label-agree-term text">I agree all statements in <a href="{{url('/helps')}}" class="term-service" target="_blank">Terms of service</a></label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <input type="submit" name="submit" id="submit" class="col-md-12 col-12 btn btn-primary bsub btn-block" value="Order Sekarang" @if(substr($id,0,7)=='special') style="background-color:#ff0000!important;" @endif/>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  function check_kupon(){
    $.ajax({
      type: 'POST',
      url: "{{url('/check-kupon')}}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        harga : $('#price').val(),
        kupon : $('#kupon').val(),
        idpaket : $( "#select-auto-manage" ).val(),
      },
      dataType: 'text',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);

        $('#pesan').html(data.message);
        $('#pesan').show();
        if (data.message=="") {
          $('#pesan').hide();
        }
        
        if (data.status == 'success') {
          $('.total').html('Rp. ' +data.pricing+' '+ data.total);
          $('#pesan').removeClass('alert-danger');
          $('#pesan').addClass('alert-success');
        } 
        else if (data.status == 'success-paket') 
        {
          $('.total').html('Rp. ' +data.pricing+' '+ data.total);
          $('#pesan').removeClass('alert-danger');
          $('#pesan').addClass('alert-success');
          
          flagSelect = false;
          $("#select-auto-manage option").each(function() {
            console.log($(this).val());
            if ($(this).val() == data.paketid) {
              flagSelect = true;
            }
          });

          if (flagSelect == false) {
            labelPaket = data.paket;
            if (data.kodekupon=="SPECIAL12") {
              labelPaket = "Paket Special Promo 1212 - IDR 295.000";
            }
            $('#select-auto-manage').append('<option value="'+data.paketid+'" data-price="'+data.dataPrice+'" data-paket="'+data.dataPaket+'" selected="selected">'+labelPaket+'</option>');
          }
          $("#price").val(data.dataPrice);
          $("#namapaket").val(data.dataPaket);
          
          $('#select-auto-manage').val(data.paketid);
          $( "#select-auto-manage" ).change();
        }
        else {
          $('#pesan').removeClass('alert-success');
          $('#pesan').addClass('alert-danger');
        }
      }
    });
  }
  
  $(document).ready(function() {
    <?php 
    // if (is_numeric($id)){
    // if(substr($id,0,7) <> "special") {
    if($showPackage){
    ?>
      $( "#select-auto-manage" ).change(function() {
        var price = $(this).find("option:selected").attr("data-price");
        var namapaket = $(this).find("option:selected").attr("data-paket");

        $("#price").val(price);
        $("#namapaket").val(namapaket);
        // $('#kupon').val("");
        // check_kupon();
      });
      
      <?php 
        if (!is_null($coupon)){
          if ($coupon->package_id > 0 ){
      ?>
        $("#select-auto-manage").val(<?php echo $coupon->package_id; ?>);
      <?php }} ?>
      
      $( "#select-auto-manage" ).change();
    <?php } ?>
    $("body").on("click", ".btn-kupon", function() {
      check_kupon();
    });

    // $("#kupon").val("<?php if(substr($id,0,7)=='special') { echo $id; } ?>");
    $("#kupon").val("<?php if (!is_numeric($id)) { echo $id; } ?>");
    $(".btn-kupon").trigger("click");
  });
    
</script>

<?php if ( env('APP_ENV') !== "local" ) { ?>
   <!-- Facebook Pixel Code Activomni Add payment info -->
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
    fbq('track', 'AddPaymentInfo');
  </script>
  <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=181710632734846&ev=PageView&noscript=1"
  /></noscript>
<?php } ?>
@endsection