<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProofHistory extends Model
{
    protected $table = "proof_history";

    /*
      - apabila ip_address kosong / - : user melakukkan alokasi
      - debit masuk point 
      - kredit keluar poin (user watching)
      - login user (owner) apabila lihat view tidak di potong pointnya
    */
}
