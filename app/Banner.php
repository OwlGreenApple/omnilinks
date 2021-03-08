<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /*
      not_valid = to flag inappropiate url 
      - 0 = valid
      - 1 = invalid
    */

    protected $table='banner';
}
