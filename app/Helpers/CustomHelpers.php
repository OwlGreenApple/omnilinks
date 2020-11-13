<?php
use Illuminate\Support\Facades\Storage;

    function getActivProofPackage()
    {
      $package = array(
        1 => ['package'=>'ActivProof 1','price'=>str_replace(",",".",number_format(50000)),'credit'=>str_replace(",",".",number_format(45000))],
        2 => ['package'=>'ActivProof 2','price'=>str_replace(",",".",number_format(100000)),'credit'=>str_replace(",",".",number_format(100000))],
        3 => ['package'=>'ActivProof 3','price'=>str_replace(",",".",number_format(150000)),'credit'=>str_replace(",",".",number_format(160000))],
        4 => ['package'=>'ActivProof 4','price'=>str_replace(",",".",number_format(200000)),'credit'=>str_replace(",",".",number_format(230000))],
      );

      return $package;
    }

?>