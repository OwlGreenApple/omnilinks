<?php
use Illuminate\Support\Facades\Storage;

    function getActivProofPackage()
    {
      $package = array(
        1 => ['package'=>'ActivProof 1','price'=>50000,'credit'=>45000,'cpl'=>'3','paket'=>17000],
        2 => ['package'=>'ActivProof 2','price'=>100000,'credit'=>100000,'cpl'=>'2.7','paket'=>38000],
        3 => ['package'=>'ActivProof 3','price'=>150000,'credit'=>160000,'cpl'=>'2.3','paket'=>66000],
        4 => ['package'=>'ActivProof 4','price'=>200000,'credit'=>230000,'cpl'=>'2','paket'=>100000],
      );

      return $package;
    }

?>