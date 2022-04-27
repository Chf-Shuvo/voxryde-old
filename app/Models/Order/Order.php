<?php

namespace App\Models\Order;

use App\Enums\DeliveryStatus;
use App\Models\Driver;
use App\Models\DriverOrder;
use App\Models\Order\OrderTimeline;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $guarded = ["id"];
    protected $appends = ['driver'];

    public function delivery_details()
    {
        return $this->belongsTo(DeliveryDetail::class, "id", "order_id");
    }
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class, "id", "order_id");
    }
    public function timeline()
    {
        return $this->hasMany(OrderTimeline::class, "order_id", "id");
    }
    public function getDriverAttribute()
    {
        $check_acceptance = DriverOrder::where('order_id', $this->id)->exists();
        if ($check_acceptance) {
            $driver_id = DriverOrder::where('order_id', $this->id)->first()->driver_id;
            return Driver::find($driver_id);
        } else {
            return DeliveryStatus::Pending;
        }
    }
}
