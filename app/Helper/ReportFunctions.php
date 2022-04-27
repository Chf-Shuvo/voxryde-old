<?php

namespace App\Helper;

use App\Models\Driver;
use App\Models\Customer;
use App\Enums\DriverStatus;
use App\Models\Order\Order;
use App\Enums\PaymentStatus;
use App\Enums\CustomerStatus;
use App\Enums\DeliveryStatus;
use App\Models\Order\OrderDetail;

class ReportFunctions
{
    /**
     * Admin Reporting
     */
    public static function drivers_joined()
    {
        $jan = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 1)
            ->count();
        $feb = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 2)
            ->count();
        $mar = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 3)
            ->count();
        $apr = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 4)
            ->count();
        $may = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 5)
            ->count();
        $jun = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 6)
            ->count();
        $jul = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 7)
            ->count();
        $aug = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 8)
            ->count();
        $sep = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 9)
            ->count();
        $oct = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 10)
            ->count();
        $nov = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 11)
            ->count();
        $dec = Driver::where("status", DriverStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 12)
            ->count();
        $drivers_joined = [
            $jan,
            $feb,
            $mar,
            $apr,
            $may,
            $jun,
            $jul,
            $aug,
            $sep,
            $oct,
            $nov,
            $dec,
        ];
        return $drivers_joined;
    }
    public static function drivers_removed()
    {
        $jan = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 1)
            ->count();
        $feb = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 2)
            ->count();
        $mar = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 3)
            ->count();
        $apr = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 4)
            ->count();
        $may = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 5)
            ->count();
        $jun = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 6)
            ->count();
        $jul = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 7)
            ->count();
        $aug = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 8)
            ->count();
        $sep = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 9)
            ->count();
        $oct = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 10)
            ->count();
        $nov = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 11)
            ->count();
        $dec = Driver::where("status", DriverStatus::Blocked)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 12)
            ->count();
        $drivers_removed = [
            $jan,
            $feb,
            $mar,
            $apr,
            $may,
            $jun,
            $jul,
            $aug,
            $sep,
            $oct,
            $nov,
            $dec,
        ];
        return $drivers_removed;
    }
    public static function customer_joined()
    {
        $jan = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 1)
            ->count();
        $feb = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 2)
            ->count();
        $mar = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 3)
            ->count();
        $apr = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 4)
            ->count();
        $may = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 5)
            ->count();
        $jun = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 6)
            ->count();
        $jul = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 7)
            ->count();
        $aug = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 8)
            ->count();
        $sep = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 9)
            ->count();
        $oct = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 10)
            ->count();
        $nov = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 11)
            ->count();
        $dec = Customer::where("status", CustomerStatus::Active)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 12)
            ->count();
        $customer_joined = [
            $jan,
            $feb,
            $mar,
            $apr,
            $may,
            $jun,
            $jul,
            $aug,
            $sep,
            $oct,
            $nov,
            $dec,
        ];
        return $customer_joined;
    }
    public static function customer_removed()
    {
        $jan = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 1)
            ->count();
        $feb = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 2)
            ->count();
        $mar = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 3)
            ->count();
        $apr = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 4)
            ->count();
        $may = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 5)
            ->count();
        $jun = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 6)
            ->count();
        $jul = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 7)
            ->count();
        $aug = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 8)
            ->count();
        $sep = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 9)
            ->count();
        $oct = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 10)
            ->count();
        $nov = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 11)
            ->count();
        $dec = Customer::where("status", CustomerStatus::Inactive)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 12)
            ->count();
        $customer_removed = [
            $jan,
            $feb,
            $mar,
            $apr,
            $may,
            $jun,
            $jul,
            $aug,
            $sep,
            $oct,
            $nov,
            $dec,
        ];
        return $customer_removed;
    }
    public static function order_summary()
    {
        $delivered = OrderDetail::where(
            "delivery_status",
            DeliveryStatus::Delivered
        )
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", date("m"))
            ->count();
        $pending = OrderDetail::where(
            "delivery_status",
            DeliveryStatus::Pending
        )
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", date("m"))
            ->count();
        $rejected = OrderDetail::where(
            "delivery_status",
            DeliveryStatus::Reject
        )
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", date("m"))
            ->count();
        return [$delivered, $pending, $rejected];
    }
    public static function collection_summary()
    {
        $jan = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 1)
            ->sum("price");
        $feb = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 2)
            ->sum("price");
        $mar = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 3)
            ->sum("price");
        // return gettype($feb);
        $apr = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 4)
            ->sum("price");
        $may = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 5)
            ->sum("price");
        $jun = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 6)
            ->sum("price");
        $jul = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 7)
            ->sum("price");
        $aug = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 8)
            ->sum("price");
        $sep = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 9)
            ->sum("price");
        $oct = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 10)
            ->sum("price");
        $nov = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 11)
            ->sum("price");
        $dec = OrderDetail::where("payment_status", PaymentStatus::Paid)
            ->whereYear("updated_at", date("Y"))
            ->whereMonth("updated_at", 12)
            ->sum("price");
        return [
            (int) $jan,
            (int) $feb,
            (int) $mar,
            (int) $apr,
            (int) $may,
            (int) $jun,
            (int) $jul,
            (int) $aug,
            (int) $sep,
            (int) $oct,
            (int) $nov,
            (int) $dec,
        ];
    }

    /**
     * Customer Reporting
     */
    public static function customer_order_summary()
    {
        try {
            $delivered = 0;
            $pending = 0;
            $rejected = 0;
            $orders = Order::with("order_details")
                ->where("customer_id", auth()->user()->id)
                ->get();

            foreach ($orders as $order) {
                if (
                    $order->order_details->delivery_status ==
                    DeliveryStatus::Delivered
                ) {
                    $delivered++;
                } elseif (
                    $order->order_details->delivery_status ==
                    DeliveryStatus::Reject
                ) {
                    $rejected++;
                } else {
                    $pending++;
                }
            }
            return [$delivered, $pending, $rejected];
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
