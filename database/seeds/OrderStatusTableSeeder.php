<?php

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusTableSeeder extends Seeder {

    public function run()
    {
        // empty the order status table first
        DB::table('order_statuses')->truncate();

        // success

        // 1 (not available to user)
        $processing = new OrderStatus();
        $processing->name = "Processing";
        $processing->save();

        // 2
        $shippingRequested = new OrderStatus();
        $shippingRequested->name = "Shipping Requested";
        $shippingRequested->save();

        // 3
        $shippingPosted = new OrderStatus();
        $shippingPosted->name = "Shipping Posted";
        $shippingPosted->save();

        // 4
        $delivered = new OrderStatus();
        $delivered->name = "Shipping Received";
        $delivered->save();

        // error

        // 5 (not available to user)
        $paymentFailed = new OrderStatus();
        $paymentFailed->name = "Payment Failed";
        $paymentFailed->save();

        // 6
        $shippingDelayed = new OrderStatus();
        $shippingDelayed->name = "Shipping Delayed";
        $shippingDelayed->save();

        // 7 (not available to user)
        $orderCancelled = new OrderStatus();
        $orderCancelled->name = "Cancelled";
        $orderCancelled->save();

        // 8 (not available to user)
        $requestRefund = new OrderStatus();
        $requestRefund->name = "Request for Refund";
        $requestRefund->save();

        // 9 (not available to user)
        $orderRefunded = new OrderStatus();
        $orderRefunded->name = "Refunded";
        $orderRefunded->save();
    }
}