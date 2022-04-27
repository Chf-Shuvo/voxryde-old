<?php

namespace App\Http\Controllers\driver;

use App\Models\Driver;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DriverDocument;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    /** 
     * Handling Driver Documents
     */
    public function required_docs_index()
    {
        try {
            $documents = DriverDocument::orderBy('required_level', 'asc')->get();
            return view('backend.content.driver.documents.index', compact('documents'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function required_docs_store(Request $request)
    {
        try {
            DriverDocument::create($request->all());
            toast('Document assigned successfully', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function required_docs_destroy(DriverDocument $driverDocument)
    {
        try {
            $driverDocument->delete();
            toast('Deleted successfully', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $drivers = Driver::orderBy("name", "asc")->get();
            $vehicleTypes = VehicleType::orderBy("name", "asc")->get();
            return view(
                "backend.content.driver.index",
                compact("drivers", "vehicleTypes")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => "unique:drivers",
            "contact" => "unique:drivers",
        ]);
        try {
            if ($request->has("image")) {
                $img = Image::make($request->image);
                $img->resize(100, 100)->encode("png");
                $image_name =
                    $request->name . "_" . time() . "_profile" . ".png";
                Storage::disk("public")->put(
                    "driver_images/" . $image_name,
                    $img
                );
                Driver::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "contact" => $request->contact,
                    "image" => $image_name,
                    "password" => Hash::make("123456"),
                    "vehicle_type" => $request->vehicle_type,
                    "vehicle_name" => $request->vehicle_name,
                    "vehicle_color" => $request->vehicle_color,
                ]);
            } else {
                Driver::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "contact" => $request->contact,
                    "password" => Hash::make($request->password),
                    "vehicle_type" => $request->vehicle_type,
                    "vehicle_name" => $request->vehicle_name,
                    "vehicle_color" => $request->vehicle_color,
                ]);
            }
            toast("Driver added successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $driver = Driver::find($id);
            $vehicleTypes = VehicleType::orderBy("name", "asc")->get();
            return view(
                "backend.content.driver.edit",
                compact("driver", "vehicleTypes")
            );
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $driver = Driver::find($id);
            if ($request->has("password")) {
                $password = Hash::make("123456");
            } else {
                $password = $driver->password;
            }
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
                    "password" => $password,
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
                    "password" => $password,
                    "contact" => $request->contact,
                    "vehicle_type" => $request->vehicle_type,
                    "vehicle_name" => $request->vehicle_name,
                    "vehicle_color" => $request->vehicle_color,
                ]);
            }
            toast("Driver updated successfully", "success");
            return redirect()->route("driver-details.index");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function status($id)
    {
        try {
            $driver = Driver::find($id);
            $status = !$driver->getRawOriginal("status");
            $driver->update([
                "status" => $status,
            ]);
            toast("Status changed successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function reset_password(Driver $driver)
    {
        try {
            $driver->update([
                "password" => Hash::make("123456"),
            ]);
            toast(
                "Password reset successful. Default Password is: 123456",
                "success"
            );
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            Driver::destroy($id);
            toast("Driver deleted successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
