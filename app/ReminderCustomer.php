<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderCustomer extends Model
{
    protected $table='reminder_customers';
    protected $connection = 'mysqlActivwa';
}
