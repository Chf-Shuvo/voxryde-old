<?php

namespace App\Models;

use App\Models\Order\OrderDetail;
use Illuminate\Database\Eloquent\Model;

class DriverOrder extends Model
{
    protected $table = 'driver_orders';
    protected $guarded = ['id'];

    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id', 'order_id');
    }
}
