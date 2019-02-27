<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class uses extends Model
{
    protected $table='use';
    protected $fillable=['email','fullName','password','created'];
}
