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
  <i>Anda mendapatkan </i><br>
  <strong>KUPON 50% OFF SPECIAL</strong> <br>
  <i>Paket Pro & Elite</i> <br>
  <strong>Kupon 50% OFF: "{{$coupon_code}}" </strong><br>
<br>
  <strong>*Segera gunakan kupon ini</strong>  <br>
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
<i><strong>*Gunakan kupon first time user ini & upgrade sekarang juga</strong></i><br>
.<br>
<?php } ?>
<br>

<br>
Semoga bermanfaat,<br>
<br>
Michael Sugiharto

