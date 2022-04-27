<?php

namespace App\Http\Controllers\driver;

use App\Models\Driver;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Enums\DeliveryStatus;
use App\Helper\Utilities;
use App\Models\Order\OrderDetail;
use App\Http\Controllers\Controller;
use App\Models\DriverDocument;
use App\Models\DriverDocumentReceived;
use App\Models\Order\Order;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DriverHomeController extends Controller
{
    public function update_location(Request $request)
    {
        try {
            Driver::find(auth()->user()->id)->update([
                'latitude' => $request->lat,
                'longitude' => $request->long
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function home()
    {
        try {
            $open_orders = OrderDetail::with('pickup_details')->where('delivery_status', DeliveryStatus::Pending)->get();
            foreach ($open_orders as $order) {
                $distance_details = Utilities::calculate_distance($order->pickup_details->map_lat, $order->pickup_details->map_long, auth()->user()->latitude, auth()->user()->longitude);
                $order->distance_from_me = $distance_details;
                if ($distance_details->distance > 25000) {
                    $open_orders = $open_orders->filter(function ($item) use ($order) {
                        return $item->id != $order->id;
                    });
                }
            }
            // return $open_orders;
            return view("backend.driver.content.home", compact('open_orders'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function driver_profile_edit(Driver $driver)
    {
        try {
            // return $driver;
            $vehicleTypes = VehicleType::orderBy("name", "asc")->get();
            return view('backend.driver.content.profile.edit', compact('driver', 'vehicleTypes'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function profile_update(Request $request, Driver $driver)
    {
        try {
            if ($request->has("image")) {
                Storage::disk("public")->delete(
                    "driver_images/" . $driver->image
                );
                $img = Image::make($request->image);
                $img->resize(100, 100)->encode("png");
                $image_name =
                    $request->name . "_" . time() . "_profile" . ".png";
                Storage::disk("public")->put(
                    "driver_images/" . $image_name,
                    $img
                );
                $driver->update([
                    "name" => $request->name,
                    "email" => $request->email,
                    "image" => $image_name,
                    "contact" => $request->contact,
                    "vehicle_type" => $request->vehicle_type,
                    "vehicle_name" => $request->vehicle_name,
                    "vehicle_color" => $request->vehicle_color,
                ]);
            } else {
                $driver->update([
                    "name" => $request->name,
                    "email" => $request->email,
                    "contact" => $request->contact,
                    "vehicle_type" => $request->vehicle_type,
                    "vehicle_name" => $request->vehicle_name,
                    "vehicle_color" => $request->vehicle_color,
                ]);
            }
            toast("Profile updated successfully", "success");
            return redirect()->route('driver.home');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function driver_logout()
    {
        try {
            Auth::guard("driver")->logout();
            toast("Driver logged out successfully!", "success");
            return redirect()->route("driver.login");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /** Driver document list */
    public function documents_index()
    {
        try {
            $current_documents = auth()->user()->document_status;
            $documents = DriverDocument::all();
            foreach ($current_documents as $document_item) {
                $documents = $documents->filter(function ($item) use ($document_item) {
                    return $item->id != $document_item->document_id;
                });
            }
            // return $documents;
            return view('backend.driver.content.profile.documents', compact('documents'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function documents_store(Request $request)
    {
        try {
            foreach ($request->file('files') as $key => $file) {
                $extension = $file->extension();
                $fileName = auth()->user()->id . '_' . $request->document_id[$key] . '_' . time() . '.' . $extension;
                Storage::disk('public')->put('driver_documents/' . $fileName, file_get_contents($file));
                DriverDocumentReceived::create([
                    'driver_id' => auth()->user()->id,
                    'document_id' => $request->document_id[$key],
                    'file' => $fileName
                ]);
            }
            toast('Documents received successfully!', 'success');
            return redirect()->route('driver.home');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
