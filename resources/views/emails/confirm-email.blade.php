Hi {{$user->name}}, <br>
<br>
Ini adalah data login anda : <br>
Email : {{$user->email}}
<br>
Pass  : {{$password}}
<br>
<br>

<?php if ($price=="") { ?>
  <i>Selamat, </i><br>
  <i>Anda mendapatkan Paket Elite </i><br>
  <strong>Hanya 295 rb saja (3 bulan paket Elite)</strong> <br>
  <strong>Gunakan kupon ini: "{{$coupon_code}}" </strong><br>
  <strong>Atau klik link <a href="{{url('checkout/'.$coupon_code)}}">ini</a> </strong>  <br>
<br>
  (kupon akan expired sesudah 1x24 jam)<br>
  <br>
  *kupon ini hanya bisa berlaku untuk email ini saja.
  <br>
<?php } ?>
<br>


<strong>Klik link dibawah</strong> utk  konfirmasi registrasi & upgrade sekarang. <br>
<STRONG><a href="{{$url}}"> Link Confirmation </a></STRONG> <br>
<br>
<?php if ($price=="") { ?>
.<br>
<i><strong>*Gunakan kupon first time user ini & upgrade sekarang juga</strong></i><br>
.<br>
<?php } ?>
<br>

<br>
Semoga bermanfaat,<br>
<br>
Michael Sugiharto

