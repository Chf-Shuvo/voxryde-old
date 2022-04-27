<?php

namespace App\Models\Order;

use App\Enums\DeliveryStatus;
use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Models\Driver;
use App\Models\VehicleType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";
    protected $guarded = ["id"];
    protected $casts = [
        "payment_type" => PaymentType::class,
        "payment_status" => PaymentStatus::class,
        "delivery_status" => DeliveryStatus::class,
    ];

    public function pickup_details()
    {
        return $this->belongsTo(Order::class, "order_id", "id");
    }
    public function delivery_details()
    {
        return $this->belongsTo(DeliveryDetail::class, "order_id", "order_id");
    }
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class, 'preferred_vehicle', 'id');
    }
    public function timeline()
    {
        return $this->hasMany(OrderTimeline::class, 'order_id', 'order_id');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }
}
