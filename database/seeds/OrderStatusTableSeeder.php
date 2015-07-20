<?php

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusTableSeeder extends Seeder {

    public function run()
    {
        // empty the order status table first
        DB::table('order_statuses')->delete();

        // success

        // 1
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
        $delivered->name = "Shipping Delivered";
        $delivered->save();

        // error

        // 5
        $paymentFailed = new OrderStatus();
        $paymentFailed->name = "Payment Failed";
        $paymentFailed->save();

        // 6
        $shippingDelayed = new OrderStatus();
        $shippingDelayed->name = "Shipping Delayed";
        $shippingDelayed->save();
    }
}