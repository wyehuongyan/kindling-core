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
        // // when transaction isn't settling or settled,
        // // but is authorized/submitted for settlement.
        $requestQueued = new RefundStatus();
        $requestQueued->name = "Request Queued";
        $requestQueued->save();

        // 3
        // // when shop approves the refund,
        // // refund goes into a submitted for settlement
        $refundApproved = new RefundStatus();
        $refundApproved->name = "Refund Approved";
        $refundApproved->save();

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