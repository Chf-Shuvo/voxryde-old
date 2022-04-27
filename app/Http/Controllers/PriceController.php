<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vehicleTypes = VehicleType::orderBy("name", "asc")->get();
            $pricings = Price::orderBy("price_per_km")->get();
            return view(
                "backend.content.pricing.index",
                compact("vehicleTypes", "pricings")
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
            "vehicle_type" => "unique:pricings",
        ]);
        try {
            Price::create($request->all());
            toast("Pricing added successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        try {
            $vehicleTypes = VehicleType::orderBy("name", "asc")->get();
            return view(
                "backend.content.pricing.edit",
                compact("price", "vehicleTypes")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        try {
            $price->update($request->all());
            toast("Price updated successfully", "success");
            return redirect()->route("price.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        try {
            $price->delete();
            toast("Price deleted successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
