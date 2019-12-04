Hi {{$user->name}}, <br>
<br>
Ini adalah data login anda : <br>
email : {{$user->email}}
<br>
pass  : {{$password}}
<br>
<br>
Silahkan klik link dibawah untuk mengkonfirmasi registrasi Anda <br>
<STRONG><a href="{{$url}}"> Link Confirmation </a></STRONG> <br>
<br>
<?php if ($price=="") { ?>
  Hemat 50% dengan Kode Kupon "{{$coupon_code}}" <br>
<br>
  *Hanya berlaku untuk paket tahunan <br>
<?php } ?>
<br>
Jika butuh bantuan jangan ragu hubungi kami di<br>
support@omnilinkz.com<br>
<br>
Salam sukses,<br>
<br>
Team Omnilinkz

