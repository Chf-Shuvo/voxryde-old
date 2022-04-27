<?php

namespace App\Http\Controllers\Order;

use App\Enums\DeliveryStatus;
use App\Enums\PaymentStatus;
use App\Models\Customer;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order\DeliveryDetail;
use App\Models\Order\OrderDetail;
use App\Models\Price;
use App\Models\VehicleType;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function all_order()
    {
        try {
            $orders = Order::with("delivery_details", "order_details")
                ->where("customer_id", auth()->user()->id)
                ->get();
            // return $orders;
            return view(
                "backend.customer.content.order.index",
                compact("orders")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function new_order()
    {
        try {
            return view("backend.customer.content.order.create");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function get_delivery_details(Request $request)
    {
        // return $request;
        try {
            $order = Order::create($request->all());
            toast("Provide delivery details here please", "success");
            return view(
                "backend.customer.content.order.delivery_details",
                compact("order")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function order_details(Request $request)
    {
        // return $request;
        try {
            $deliver_details = DeliveryDetail::create($request->all());
            $deliver_details->load("pickup_details");
            $vehicle_types = VehicleType::all();
            toast(
                "Provide required information to confirm your booking",
                "success"
            );
            return view(
                "backend.customer.content.order.submit",
                compact("deliver_details", 'vehicle_types')
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function confirm_details(Request $request)
    {
        try {
            // return $request;
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
            $order->load('pickup_details', 'delivery_details', 'vehicle_type');
            Order::find($order->order_id)->update([
                'placement_status' => DeliveryStatus::Complete
            ]);
            toast("Order booked successfully", "success");
            return view(
                "backend.customer.content.order.confirm",
                compact("order")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function order_booking_result()
    {
        try {
            return view("backend.customer.content.order.result");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function order_details_show(Order $order)
    {
        try {
            $order->load("delivery_details", "order_details", "timeline");
            return view(
                "backend.customer.content.order.show",
                compact("order")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
