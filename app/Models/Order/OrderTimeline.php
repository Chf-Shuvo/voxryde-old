<?php

namespace App\Models\Order;

use App\Enums\DeliveryStatus;
use Illuminate\Database\Eloquent\Model;

class OrderTimeline extends Model
{
    protected $table = "order_timelines";
    protected $guarded = ["id"];

    protected $casts = [
        "delivery_status" => DeliveryStatus::class,
    ];
}
