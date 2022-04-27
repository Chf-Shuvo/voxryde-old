<?php

namespace App\Helper;

use App\Enums\Boolean;
use App\Models\OTP;

class Utilities
{
    public static function generate_otp()
    {
        try {
            $otp = rand(1000, 9999);
            $check = OTP::where("otp", $otp)->exists();
            if ($check) {
                self::generate_otp();
            } else {
                return $otp;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public static function calculate_distance($order_lat, $order_long, $driver_lat, $driver_long)
    {
        try {
            $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?&origins=[' . $order_lat . ',' . $order_long . ']&destinations=[' . $driver_lat . ',' . $driver_long . ']&key=AIzaSyC-KnRoUdTT4_xQ_xbyVkvXPoKUNTZptnE');
            $distance_arr = json_decode($distance_data);
            $location_data = [
                'distance' => $distance_arr->rows[0]->elements[0]->distance->value,
                'distance_km' => $distance_arr->rows[0]->elements[0]->distance->text,
                'time' => $distance_arr->rows[0]->elements[0]->duration->text
            ];
            return $location_data = (object)$location_data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
