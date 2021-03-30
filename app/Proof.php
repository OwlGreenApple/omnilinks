<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $table = 'proofs';

    /*
      - activproof tidak tampil apabila point page = 0
      - ip address yg sama hanya bisa mengurangi smp 3x dlm 1 hari
    */
}
