<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    protected $table = "orders_deliver_details";
    protected $guarded = ["id"];

    public function pickup_details()
    {
        return $this->belongsTo(Order::class, "order_id", "id");
    }
}
