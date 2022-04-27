<?php

namespace App\Http\Controllers\customer;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset\ResetLink;
use App\Models\CustomerPasswordReset;
use Carbon\Carbon;

use function PHPUnit\Framework\returnSelf;

class CustomerPasswordResetController extends Controller
{
    public function generate_token()
    {
        $token = Str::random(64);
        if (CustomerPasswordReset::where("token", $token)->exists()) {
            self::generate_token();
        } else {
            return $token;
        }
    }
    public function showLinkRequestForm()
    {
        try {
            return view("backend.customer.content.password.email");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            $check = Customer::where("email", $request->email)->exists();
            if ($check) {
                $token = self::generate_token();
                CustomerPasswordReset::create([
                    "email" => $request->email,
                    "token" => $token,
                ]);
                $url = route("customer.password.reset", $token);
                Mail::to($request->email)->send(new ResetLink($url));
                return redirect()
                    ->back()
                    ->with([
                        "status" =>
                            "We have sent you a password reset link to your mail",
                    ]);
            } else {
                toast("No user found!", "error");
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function showResetForm($token)
    {
        try {
            $user = CustomerPasswordReset::where("token", $token)
                ->latest()
                ->first();
            $request_time = Carbon::parse($user->created_at)->addMinute(60);
            $current_time = Carbon::now();

            if ($current_time->gt($request_time)) {
                toast(
                    "Reset link expired, request a new link from here.",
                    "error"
                );
                return view("backend.customer.content.password.email");
            } else {
                return view(
                    "backend.customer.content.password.reset",
                    compact("user")
                );
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function reset(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:6",
        ]);
        try {
            return $request;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
