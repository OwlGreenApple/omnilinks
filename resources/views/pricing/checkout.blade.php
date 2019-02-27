@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/style.css?v=1')}}">
  <script type="text/javascript">
    $(document).ready(function() {
      $( "#select-auto-manage" ).change(function() {
        $("#price").val($(this).find("option:selected").attr("data-price"));
        $("#namapaket").val($(this).find("option:selected").attr("data-paket"));
      });
      $( "#select-auto-manage" ).change();
    });
  </script>
<div class="container" style="padding-top:50px; padding-bottom:50px">
    <div class="row justify-content-center">
      <div class="col-md-8 col-12">
        <div class="card-custom">
          <div class="card cardpad">
            <?php if (Auth::check()) {?>
              <!-- ditaruh di session -->
              <form method="POST" action="{{url('confirm-payment')}}">
            <?php } else {?>
              <form method="GET" action="{{url('register-payment')}}">
            <?php }?>
              {{ csrf_field() }}
              <input type="hidden" id="price" name="price">
              <input type="hidden" id="namapaket" name="namapaket">
              <h2 class="Daftar-Disini">Choose Your Packages</h2>
              <div class="form-group">
                <div class="col-12 col-md-12">
                <label class="text" for="formGroupExampleInput">Pilih Paket:</label>
                <select class="form-control" name="select-auto-manage" id="select-auto-manage">
                    <option class="" data-price="197000" data-paket="Pro Monthly" value="{{$id}}" <?php if ($id==1) echo "selected"; ?>>Pro Monthly - IDR 197.000,-/mo</option>
                    <option class="" data-price="297000" data-paket="Premium Monthly" value="{{$id}}" <?php if ($id==3) echo "selected"; ?>>Premium Monthly - IDR 297.000,-/mo</option>
                    <option class="" data-price="2364000" data-paket="Pro Yearly" value="{{$id}}" <?php if ($id==2) echo "selected"; ?>>Pro Yearly - IDR 2.364.000,-/year</option>
                    <option class="" data-price="3564000" data-paket="Premium Yearly" value="{{$id}}" <?php if ($id==4) echo "selected"; ?>>Premium Yearly - IDR 3.564.000,-/year</option>
                </select>
              </div>
              </div>
              <div class="form-group">
              <div class="col-12 col-md-12">
                <label class="text" for="formGroupExampleInput">Masukkan Kode Kupon:</label>
                <input type="text" class="form-control form-input" name="text" id="text" placeholder="Masukkan Kode Kupon Disini Jika Punya"/>
              </div>
            </div>
              <div class="form-group">
              <div class="col-12 col-md-12">
                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                <label for="agree-term" class="label-agree-term text">I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
              </div>
              </div>
              <div class="form-group">
              <div class="col-12 col-md-12">
                <input type="submit" name="submit" id="submit" class="col-md-12 col-12 btn btn-primary bsub btn-block" value="Confirm Your Payment" />
                <hr class="own">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

