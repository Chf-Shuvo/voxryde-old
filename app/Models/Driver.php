<?php

namespace App\Models;

use App\Enums\DriverStatus;
use App\Models\VehicleType;
use App\Enums\DeliveryStatus;
use App\Models\DriverDocument;
use App\Models\Order\OrderDetail;
use App\Enums\DriverDocumentLevel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    protected $guard = "driver";
    protected $table = "drivers";
    protected $guarded = ["id"];
    protected $appends = ["price_by_vehicle", 'document_status'];
    protected $casts = [
        "status" => DriverStatus::class,
    ];

    public function getVehicleTypeAttribute($value)
    {
        try {
            $vehicleType = VehicleType::find($value);
            return $vehicleType;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function getPriceByVehicleAttribute()
    {
        return Price::where("vehicle_type", $this->vehicle_type->id)->first();
    }

    public function getDocumentStatusAttribute()
    {
        $given_documents = $this->hasMany(DriverDocumentReceived::class, 'driver_id', 'id')->count();
        if ($given_documents > 0) {
            return $this->hasMany(DriverDocumentReceived::class, 'driver_id', 'id')->get();
        } else {
            return $given_documents;
        }
    }
}
