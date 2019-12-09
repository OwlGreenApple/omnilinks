Hi {{$user->name}}, <br>
<br>
Ini adalah data login anda : <br>
Email : {{$user->email}}
<br>
Pass  : {{$password}}
<br>
<br>

<?php if ($price=="") { ?>
  Gunakan KUPON 50% OFF SPECIAL <br>
  Hanya untuk First time user saja <br>
  Kupon : "{{$coupon_code}}" <br>
<br>
  *Hanya berlaku untuk paket tahunan <br>
  (kupon akan expired sesudah 3x24 jam)<br>
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
*Gunakan kupon first time user ini & upgrade sekarang juga<br>
.<br>
<?php } ?>
<br>

<br>
Semoga bermanfaat,<br>
<br>
Michael Sugiharto

