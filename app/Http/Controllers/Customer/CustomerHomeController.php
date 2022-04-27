<?php

namespace App\Http\Controllers\Customer;

use App\Helper\ReportFunctions;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CustomerHomeController extends Controller
{
    public function home()
    {
        try {
            $order_summary = ReportFunctions::customer_order_summary();
            return view(
                "backend.customer.content.home",
                compact("order_summary")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function customer_profile_edit(Customer $customer)
    {
        try {
            return view(
                "backend.customer.content.profile.edit",
                compact("customer")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function customer_logout()
    {
        try {
            Auth::guard("customer")->logout();
            toast("Customer logged out successfully!", "success");
            return redirect()->route("customer.login");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function profile_update(Request $request, Customer $customer)
    {
        try {
            if ($request->has("profile_image")) {
                // delete current images
                if ($customer->image != "customer.png") {
                    Storage::disk("public")->delete(
                        "customer_images/" . $customer->image
                    );
                }
                // create new image
                $img = Image::make($request->profile_image);
                $img->resize(150, 150)->encode("png");
                $image_name =
                    $request->customer_name .
                    "_" .
                    time() .
                    "_profile" .
                    ".png";
                // store inside storage
                Storage::disk("public")->put(
                    "customer_images/" . $image_name,
                    $img
                );
            } else {
                $customer->update($request->except("_token", "_method"));
                toast("Customer updated successfully!");
                return redirect()->route("customer.home");
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function price_range()
    {
        try {
            $prices = Price::all();
            return view("backend.customer.content.prices.index", compact('prices'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
