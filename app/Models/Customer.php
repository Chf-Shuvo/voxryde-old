<?php

namespace App\Models;

use App\Enums\CustomerStatus;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens;
    protected $guard = "customer";
    protected $table = "customers";
    protected $guarded = ["id"];
    protected $hidden = ['password'];
    public $casts = ["status" => CustomerStatus::class];

    public function documents()
    {
        return $this->hasMany(CustomerDocument::class);
    }
}
