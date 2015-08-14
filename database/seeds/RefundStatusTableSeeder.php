<?php

use Illuminate\Database\Seeder;
use App\Models\RefundStatus;

class RefundStatusTableSeeder extends Seeder {

    public function run()
    {
        // empty the refund status table first
        DB::table('refund_statuses')->truncate();

        // success

        // 1
        $refundRequested = new RefundStatus();
        $refundRequested->name = "Requested for Refund";
        $refundRequested->save();

        // 2
        $refundProcessing = new RefundStatus();
        $refundProcessing->name = "Refund Processing";
        $refundProcessing->save();

        // 3
        $refunded = new RefundStatus();
        $refunded->name = "Refunded";
        $refunded->save();

        // 4
        $refundCancelled = new RefundStatus();
        $refundCancelled->name = "Refund Cancelled";
        $refundCancelled->save();

        // 5
        $refundFailed = new RefundStatus();
        $refundFailed->name = "Refund Failed";
        $refundFailed->save();
    }
}