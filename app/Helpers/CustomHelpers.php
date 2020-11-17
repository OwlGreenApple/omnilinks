<?php
use Illuminate\Support\Facades\Storage;

    function getActivProofPackage()
    {
      $package = array(
        1 => ['package'=>'ActivProof 1','price'=>50000,'credit'=>45000],
        2 => ['package'=>'ActivProof 2','price'=>100000,'credit'=>100000],
        3 => ['package'=>'ActivProof 3','price'=>150000,'credit'=>160000],
        4 => ['package'=>'ActivProof 4','price'=>200000,'credit'=>230000],
      );

      return $package;
    }

?>