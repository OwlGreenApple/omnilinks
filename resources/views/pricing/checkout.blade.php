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
        $('#kupon').val("");
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

          $('#pesan').html(data.message);
          $('#pesan').show();
          if (data.message=="") {
            $('#pesan').hide();
          }
          
          if (data.status == 'success') {
            $('.total').html('Rp. ' + data.total);
            $('#pesan').removeClass('alert-danger');
            $('#pesan').addClass('alert-success');
          } 
          else if (data.status == 'success-paket') {
            $('.total').html('Rp. ' + data.total);
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
              if (data.coupon=="SPECIAL12") {
                labelPaket = "Paket Special Promo 1212 - IDR 295.000";
              }
              $('#select-auto-manage').append('<option value="'+data.paketid+'" data-price="'+data.dataPrice+'" data-paket="'+data.dataPaket+'" selected="selected">'+labelPaket+'</option>');
            }
            $('#select-auto-manage').val(data.paketid);
          }
          else {
            $('#pesan').removeClass('alert-success');
            $('#pesan').addClass('alert-danger');
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
                    <option class="" data-price="155000" data-paket="Basic Monthly" value="1" <?php if ($id==1) echo "selected" ; ?>>
                      Basic Bulanan - IDR 155.000,-/bulan
                    </option>
                    <option class="" data-price="195000" data-paket="Elite Monthly" value="3" <?php if ($id==3) echo "selected" ; ?>>
                      Elite Bulanan - IDR 195.000,-/bulan
                    </option>
                    <option class="" data-price="1020000" data-paket="Basic Yearly" value="2" <?php if ($id==2) echo "selected" ; ?>>
                      Basic Tahunan - IDR 1.020.000,-/tahun (Hemat 52%)
                    </option>
                    <option class="" data-price="1140000" data-paket="Elite Yearly" value="4" <?php if ($id==4) echo "selected" ; ?>>
                      Elite Tahunan - IDR 1.140.000,-/tahun (Hemat 52%)
                    </option>
                    @if(Auth::check())
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
                  <input type="submit" name="submit" id="submit" class="col-md-12 col-12 btn btn-primary bsub btn-block" value="Order Sekarang" />
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection