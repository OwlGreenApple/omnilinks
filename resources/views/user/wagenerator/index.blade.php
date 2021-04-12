@extends('layouts.app')

@section('content')

<section class="bg-generator">
  <div class="container row mx-auto">
    <div class="col-lg-6">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            
            <form>
              <div class="form-group text-dark">
                <label><h5><b>Masukkan No WA Anda</b></h5></label>
                <input type="text" class="form-control" />
                <small>Pastikan nomor anda dimulai dengan area kode negara, contoh : 62 811 3481 598 untuk negara Indonesia</small>
              </div>

              <div class="form-group text-dark">
                <label><h5><b>Isi Pesan yang Anda Inginkan</b></h5></label>
                <input type="text" class="form-control" />
              </div>
             
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
    </div>

    <div class="col-lg-6">
      GRATIS buat click to chat <br/>
      Whatsapp link generator<br />
      Gunakan FREE whatsapp WA click to chat link generator ini<br/> 
      untuk membuat click to whatsapp link dengan mudah.<br/> 
      Kombinasikan link ini dengan Omnilinkz untuk <br/> 
      meningkatkan konversi penjualan anda!<br/> 
      <br/> 
      Dapatkan promo terbaru Omnilinkz<br/> 
      Klik Disini
    </div>
  </div>
</section>

@endsection