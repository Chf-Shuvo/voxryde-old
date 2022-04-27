<?php

namespace App\Http\Controllers\driver;

use Illuminate\Http\Request;
use App\Enums\DeliveryStatus;
use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Helper\Utilities;
use App\Models\Order\OrderDetail;
use App\Models\Order\OrderTimeline;
use App\Http\Controllers\Controller;
use App\Models\DriverOrder;
use App\Models\Order\Order;
use App\Models\OTP;
use Carbon\Carbon;

class OrderManagementController extends Controller
{
    public function handle_order(OrderDetail $order, $value)
    {
        try {
            DriverOrder::create([
                'driver_id' => auth()->user()->id,
                'order_id' => $order->order_id
            ]);
            OrderTimeline::create([
                "order_id" => $order->order_id,
                "delivery_status" => $value,
            ]);
            $order->update([
                "delivery_status" => $value,
            ]);
            if ($value == "accepted") {
                toast(
                    "Order accepted, please go to My Orders to view details",
                    "success"
                );
            } else {
                toast("Order Rejected!", "error");
            }
            return redirect()->route("driver.order.mine");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function my_orders()
    {
        try {
            $orders = DriverOrder::with('order_details.pickup_details', 'order_details.delivery_details')->where('driver_id', auth()->user()->id)->get();
            return view(
                "backend.driver.content.order.index",
                compact("orders")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function single_order_status($order_id)
    {
        try {
            $order = OrderDetail::where("order_id", $order_id)->first();
            $order->load("pickup_details", "delivery_details", "timeline");
            $order_date = Carbon::parse($order->date);
            $current_date = Carbon::now();
            $schedule_check = $order_date->gt($current_date);
            return view(
                "backend.driver.content.order.status",
                compact("order", "schedule_check")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function single_order_status_update(OrderDetail $order, $status)
    {
        try {
            OrderTimeline::create([
                "order_id" => $order->order_id,
                "delivery_status" => $status,
            ]);
            if (
                $status == DeliveryStatus::Pick->value &&
                $order->payment_type == PaymentType::Cash
            ) {
                $order->update([
                    "delivery_status" => $status,
                    "payment_status" => PaymentStatus::Paid,
                ]);
            } else {
                OTP::where("order_id", $order->order_id)->delete();
                $order->update([
                    "delivery_status" => $status,
                ]);
            }
            toast("Order status updated", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function delivery_receiver(Request $request)
    {
        try {
            OrderDetail::where("order_id", $request->order_id)->update([
                "received_by" => $request->receiver,
            ]);
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function load_map(Order $order, $type)
    {
        try {
            $order->load("delivery_details", "order_details");
            return view(
                "backend.driver.content.order.map",
                compact("order", "type")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
