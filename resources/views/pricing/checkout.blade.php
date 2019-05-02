@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<script type="text/javascript">
  $(document).ready(function() {
      $( "#select-auto-manage" ).change(function() {
        var price = $(this).find("option:selected").attr("data-price");
        var namapaket = $(this).find("option:selected").attr("data-paket");

        $("#price").val(price);
        $("#namapaket").val(namapaket);
        check_kupon();
      });
      $( "#select-auto-manage" ).change();
    });

    $("body").on("click", ".btn-kupon", function() {
      check_kupon();
    });

    function check_kupon(){
      $.ajax({
        type: 'POST',
        url: "<?php echo url('/check-kupon') ?>",
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

          if (data.status == 'success') {
            $('.total').html('Rp. ' + data.total);
            $('#pesan').hide();
          } else {
            $('#pesan').html(data.message);
            $('#pesan').removeClass('alert-success');
            $('#pesan').addClass('alert-danger');
            $('#pesan').show();
          }
        }
      });
    }
</script>
<div class="container" style="margin-top:50px; margin-bottom:100px">
  <div class="row justify-content-center">
    <div class="col-md-8 col-12">
      <div class="card-custom">
        <div class="card cardpad">

          <div id="pesan" class="alert"></div>

          <?php if (Auth::check()) {?>
          <form method="POST" action="{{url('confirm-payment')}}">
            <?php } else {?>
            <form method="POST" action="{{url('register-payment')}}">
              <?php }?>
              {{ csrf_field() }}
              <input type="hidden" id="price" name="price">
              <input type="hidden" id="namapaket" name="namapaket">
              <h2 class="Daftar-Disini">Choose Your Packages</h2>
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <label class="text" for="formGroupExampleInput">Pilih Paket:</label>
                  <select class="form-control" name="idpaket" id="select-auto-manage">
                    <option class="" data-price="197000" data-paket="Basic Monthly" value="1" <?php if ($id==1) echo "selected" ; ?>>
                      Basic Monthly - IDR 197.000,-/mo
                    </option>
                    <option class="" data-price="297000" data-paket="Elite Monthly" value="3" <?php if ($id==3) echo "selected" ; ?>>
                      Elite Monthly - IDR 297.000,-/mo
                    </option>
                    <option class="" data-price="660000" data-paket="Basic Yearly" value="2" <?php if ($id==2) echo "selected" ; ?>>
                      Basic Yearly - IDR 660.000,-/year
                    </option>
                    <option class="" data-price="900000" data-paket="Elite Yearly" value="4" <?php if ($id==4) echo "selected" ; ?>>
                      Elite Yearly - IDR 900.000,-/year
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-12">
                  <label class="label-title-test" for="formGroupExampleInput">
                    Masukkan Kode Kupon:
                  </label>

                  <div class="col-md-12 row">
                    <div class="col-md-11 pl-0">
                      <input type="text" class="form-control form-control-lg" name="kupon" id="kupon" placeholder="Masukkan Kode Kupon Disini" style="width:100%" />  
                    </div>
                    <div class="col-md-1 pl-0">
                      <button type="button" class="btn btn-primary btn-kupon">
                        Apply
                      </button>  
                    </div>  
                  </div>  
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
                  <label for="agree-term" class="label-agree-term text">I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <input type="submit" name="submit" id="submit" class="col-md-12 col-12 btn btn-primary bsub btn-block" value="Confirm Your Payment" />
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection