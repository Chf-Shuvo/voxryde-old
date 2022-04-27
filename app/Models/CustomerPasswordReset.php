<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPasswordReset extends Model
{
    protected $table = "password_reset_customers";
    protected $guarded = ["id"];
}
