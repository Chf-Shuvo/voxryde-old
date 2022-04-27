<?php

namespace App\Models;

use App\Enums\DriverDocumentLevel;
use Illuminate\Database\Eloquent\Model;

class DriverDocument extends Model
{
    protected $table = 'required_documents_driver';
    protected $guarded = ['id'];

    protected $casts = [
        "required_level" => DriverDocumentLevel::class,
    ];
}
