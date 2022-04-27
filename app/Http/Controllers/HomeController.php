<?php

namespace App\Http\Controllers;

use App\Enums\DriverStatus;
use App\Helper\ReportFunctions;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $customer_joined = ReportFunctions::customer_joined();
            $customer_removed = ReportFunctions::customer_removed();
            $drivers_joined = ReportFunctions::drivers_joined();
            $drivers_removed = ReportFunctions::drivers_removed();
            $order_summary = ReportFunctions::order_summary();
            $collection_summary = ReportFunctions::collection_summary();
            return view(
                "backend.content.dashboard",
                compact(
                    "customer_joined",
                    "customer_removed",
                    "drivers_joined",
                    "drivers_removed",
                    "order_summary",
                    "collection_summary"
                )
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            Session::flush();
            toast("User logged out!", "success");
            return redirect()->route("login");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
