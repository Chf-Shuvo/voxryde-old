<?php

namespace App\Http\Controllers;

use App\Enums\OtpFor;
use App\Helper\Utilities;
use App\Models\OTP;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function send_otp(Request $request)
    {
        try {
            $otp = Utilities::generate_otp();
            if ($request->type == OtpFor::Order->value) {
                OTP::create([
                    "otp" => $otp,
                    "order_id" => $request->order_id,
                ]);
            } else {
                OTP::create([
                    "otp" => $otp,
                    "user_id" => 0,
                ]);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function verify_otp(Request $request)
    {
        try {
            // return $request;
            $otp = OTP::where("order_id", $request->order_id)
                ->where("otp", $request->otp)
                ->first();
            if ($otp == null) {
                return false;
            } else {
                if ($otp->otp == $request->otp) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
