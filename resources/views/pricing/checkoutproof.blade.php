@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container" style="margin-top:50px; margin-bottom:100px">
  <div class="row justify-content-center">
    <div class="col-md-8 col-12">
      <div class="card-custom">
        <div class="card cardpad">

          <div class="notif"><!-- display notif --></div>

          <form id="proof_order">
              <h2 class="Daftar-Disini">Pilih Paket Anda</h2>
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <label class="text">Pilih Paket:</label>
                  <select class="form-control" name="idproof" >
                    @php $pg = 1 @endphp
                    <option data-price="{!! getActivProofPackage()[$pg]['price'] !!}" data-paket="{!! getActivProofPackage()[$pg]['package'] !!}" value="{{ $id }}"  @if($id==$pg) selected @endif>{!! getActivProofPackage()[$pg]['package'] !!} - IDR {!! getActivProofPackage()[$pg]['price'] !!} - {!! getActivProofPackage()[$pg]['credit'] !!} Credit</option> 

                    @php $pg = 2 @endphp
                    <option data-price="{!! getActivProofPackage()[$pg]['price'] !!}" data-paket="{!! getActivProofPackage()[$pg]['package'] !!}" value="{{ $id }}"  @if($id==$pg) selected @endif>{!! getActivProofPackage()[$pg]['package'] !!} - IDR {!! getActivProofPackage()[$pg]['price'] !!} - {!! getActivProofPackage()[$pg]['credit'] !!} Credit</option>  

                    @php $pg = 3 @endphp
                    <option data-price="{!! getActivProofPackage()[$pg]['price'] !!}" data-paket="{!! getActivProofPackage()[$pg]['package'] !!}" value="{{ $id }}"  @if($id==$pg) selected @endif>{!! getActivProofPackage()[$pg]['package'] !!} - IDR {!! getActivProofPackage()[$pg]['price'] !!} - {!! getActivProofPackage()[$pg]['credit'] !!} Credit</option> 

                    @php $pg = 4 @endphp
                    <option data-price="{!! getActivProofPackage()[$pg]['price'] !!}" data-paket="{!! getActivProofPackage()[$pg]['package'] !!}" value="{{ $id }}"  @if($id==$pg) selected @endif>{!! getActivProofPackage()[$pg]['package'] !!} - IDR {!! getActivProofPackage()[$pg]['price'] !!} - {!! getActivProofPackage()[$pg]['credit'] !!} Credit</option> 
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12 col-12">
                  <label class="label-title-test">
                    Total: 
                  </label>
                  <div class="col-md-12 pl-0">
                    <span class="total" style="font-size:18px"></span>
                  </div>  
                </div>
              </div>
             
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                  <label for="agree-term" class="label-agree-term text">I agree all statements in <a href="{{url('/helps')}}" class="term-service" target="_blank">Terms of service</a></label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-12 col-md-12">
                  <input type="submit" name="submit" id="submit" class="col-md-12 col-12 btn btn-primary bsub btn-block" value="Order Sekarang" style="background-color:#ff0000!important;" @endif/>
                </div>
              </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    change_selection();
    display_price();
  });

  function change_selection()
  {
    $("select[name='idproof']").change(function(){
      display_price();
    });
  }

  function display_price()
  {
    var price = $("select[name='idproof'] option:selected").attr('data-price');
    $(".total").html('IDR '+price);
  }

  function order(){
    $.ajax({
      type: 'POST',
      url: "{{url('/check-kupon')}}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        price : $("select[name='idproof'] option:selected").attr('data-price'),
        package : $("select[name='idproof'] option:selected").attr('data-paket')
      },
      dataType: 'json',
      beforeSend: function() {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        if(result.msg == 0)
        {
            $(".notif").html('div class="alert alert-danger">Server kami terlalu sibuk, mohon coba lagi nanti.</div>');
        }

        if(result.msg == 1)
        {
            $(".notif").html('div class="alert alert-success">Order anda sudah diproses.</div>');
            location.href="{{ url('thankyou') }}";
        }
      },
      error : function(xhr){
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr,responseText);
      }
    });
  }
</script>
@endsection