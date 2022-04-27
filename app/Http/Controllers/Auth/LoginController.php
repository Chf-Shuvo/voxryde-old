<?php

namespace App\Http\Controllers\Auth;

use App\Enums\CustomerStatus;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
        $this->middleware("guest:customer")->except("logout");
        $this->middleware("guest:driver")->except("logout");
    }
    /** Customer Registration */
    public function showCustomerRegisterForm()
    {
        try {
            return view("auth.customer.register");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function showCustomerRegister(Request $request)
    {
        try {
            // return $request;
            Customer::create([
                "customer_name" => $request->customer_name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "phone" => $request->phone,
                "image" => "customer.png",
                "address" => $request->address,
                "status" => CustomerStatus::Active,
            ]);
            Auth::guard("customer")->attempt($request->only("email", "password"));
            return redirect()->route('customer.home');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    // customer login form
    public function showCustomerLoginForm()
    {
        try {
            return view("auth.customer.login");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    // perform customer login
    public function customerLogin(Request $request)
    {
        try {
            if (
                Auth::guard("customer")->attempt(
                    $request->only("email", "password")
                )
            ) {
                return redirect()->route("customer.home");
            }
            toast(
                "Invalid credentials, please check your email/password and try again!",
                "error"
            );
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function showDriverRegisterForm()
    {
        try {
            return view("auth.driver.register");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function showDriverRegister(Request $request)
    {
        try {
            Driver::create([
                "name" => $request->name,
                "email" => $request->email,
                "contact" => $request->contact,
                "password" => Hash::make($request->password),
                "vehicle_type" => VehicleType::first()->id,
                "vehicle_name" => VehicleType::first()->name,
                "vehicle_color" => 'white',
            ]);
            Auth::guard("driver")->attempt($request->only("email", "password"));
            return redirect()->route("driver.home");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    // show driver login form
    public function showDriverLoginForm()
    {
        try {
            return view("auth.driver.login");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    // perform driver login
    public function driverLogin(Request $request)
    {
        try {
            if (
                Auth::guard("driver")->attempt(
                    $request->only("email", "password")
                )
            ) {
                return redirect()->route("driver.home");
            }
            toast(
                "Invalid credentials, please check your email/password and try again!",
                "error"
            );
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    // show driver login form
    public function driverLogout()
    {
        try {
            Auth::guard("driver")->logout();
            return redirect("/driver/login");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
