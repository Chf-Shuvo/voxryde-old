<?php

namespace App\Http\Controllers\API\Customer;

use Carbon\Carbon;
use App\Models\Price;
use App\Models\Order\Order;
use App\Models\VehicleType;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Enums\DeliveryStatus;
use App\Models\Order\OrderDetail;
use App\Http\Controllers\Controller;
use App\Models\Order\DeliveryDetail;

class OrderController extends Controller
{
    public function all_order()
    {
        try {
            $orders = Order::with("delivery_details", "order_details")
                ->where("customer_id", auth()->user()->id)
                ->get();
            return response()->json([
                'orders' => $orders
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function get_delivery_details(Request $request)
    {
        try {
            $order = Order::create($request->all());
            return response()->json([
                'pick_up_details' => $order
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function order_details(Request $request)
    {
        try {
            $deliver_details = DeliveryDetail::create($request->all());
            $deliver_details->load("pickup_details");
            $vehicle_types = VehicleType::all();
            return response()->json([
                'delivery_up_details' => $deliver_details,
                'vehicle_types' => $vehicle_types
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function confirm_details(Request $request)
    {
        try {
            $delivery_price = Price::where('vehicle_type', $request->preferred_vehicle)->first();
            $price = ceil($request->distance * $delivery_price->price_per_km + $request->distance * $delivery_price->service_charge_km);
            $order = OrderDetail::create([
                "order_id" => $request->order_id,
                "date" => Carbon::parse($request->date)->format("Y-m-d"),
                "preferred_vehicle" => $request->preferred_vehicle,
                "distance" => $request->distance,
                "price" => $price,
                "payment_type" => $request->payment_type,
                "payment_status" => PaymentStatus::Pending->value,
                "delivery_status" => DeliveryStatus::Pending->value,
            ]);
            Order::find($order->order_id)->update([
                'placement_status' => DeliveryStatus::Complete
            ]);
            $order->load('pickup_details', 'delivery_details', 'vehicle_type');
            return response()->json([
                'order_details' => $order
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
