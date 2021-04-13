<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    //
  use SoftDeletes;
  /*
    connect_activrespon && connect_mailchimp :
    0 = disconnected
    1 = connected

    position_api == position form api -- activrespon and mailchimp
    0 = position on top
    1 = position on bottom
  */

  protected $table = 'pages';
}
