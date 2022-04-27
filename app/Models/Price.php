<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'pricings';
    protected $guarded = ['id'];

    public function getVehicleTypeAttribute($value){
        try {
            $vehicleType = VehicleType::find($value);
            return $vehicleType->name;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
