<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vehicleTypes = VehicleType::orderBy('name','asc')->get();
            return view('backend.content.vehicleTypes.index', compact('vehicleTypes'));
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
            'name' => 'required|unique:vehicle_types'
        ]);
        try {
            // return $request;
            // storing icon
            $img = Image::make($request->icon);
            $img->resize(50,50)->encode('png');
            $image_name = time().'_icon'.'.png';
            Storage::disk('public')->put('vehicle_icons/'.$image_name,$img);
            // storing selected icon
            $img2 = Image::make($request->selected_icon);
            $img2->resize(50,50)->encode('png');
            $image_name2 = time().'_selected_icon'.'.png';
            Storage::disk('public')->put('vehicle_icons/'.$image_name2,$img2);
            // storing data
            VehicleType::create([
                'name' => $request->name,
                'icon' => $image_name,
                'selected_icon' => $image_name2
            ]);
            toast('Vehicle type added successfully','success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleType $vehicleType)
    {
        try {
            // return $vehicleType;
            return view('backend.content.vehicleTypes.edit', compact('vehicleType'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        try {
            // return $request;
            if($request->has('icon')){
              Storage::disk('public')->delete('vehicle_icons/'.$vehicleType->icon);
              $img = Image::make($request->icon);
              $img->resize(50,50)->encode('png');
              $image_name = time().'_icon'.'.png';
              Storage::disk('public')->put('vehicle_icons/'.$image_name,$img);
              $vehicleType->update([
                'name' => $request->name,
                'icon' => $image_name
              ]);
            }
            if($request->has('selected_icon')){
              Storage::disk('public')->delete('vehicle_icons/'.$vehicleType->selected_icon);
              $img = Image::make($request->selected_icon);
              $img->resize(50,50)->encode('png');
              $image_name = time().'_selected_icon'.'.png';
              Storage::disk('public')->put('vehicle_icons/'.$image_name,$img);
              $vehicleType->update([
                'name' => $request->name,
                'selected_icon' => $image_name
              ]);
            }
            toast('Vehicle type updated successfully','success');
            return redirect()->route('vehicle-types.index');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function destroy($id)
    {
        try {
          $vehicleType = VehicleType::find($id);
          Storage::disk('public')->delete('vehicle_icons/'.$vehicleType->icon);
          Storage::disk('public')->delete('vehicle_icons/'.$vehicleType->selected_icon);
          $vehicleType->delete();
          toast('Removed successfully!','success');
          return redirect()->back();
        } catch (\Throwable $th) {
          return $th->getMessage();
        }
    }
}
