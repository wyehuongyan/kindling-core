<?php

namespace App\Console\Commands;

use App\Facades\SprubixQueue;
use App\Models\ShopOrderRefund;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckQueuedRefunds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refunds:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks queued refunds to see if any are refundable.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $queuedRefunds = ShopOrderRefund::search(array("refund_status_id" => 2))->get();

        Log::info("running CheckQueuedRefunds command...");

        foreach($queuedRefunds as $queuedRefund) {
            Log::info("cron: shopOrderRefund id " . $queuedRefund->id);

            $shopOrder = $queuedRefund->shopOrder;
            $shopOrderRefund = $queuedRefund;
            $returnCartItems = json_decode($queuedRefund->return_cart_items);
            $refundAmount = $queuedRefund->refund_amount;
            $refundPoints = $queuedRefund->refund_points;

            SprubixQueue::queueRefund($shopOrder, $shopOrderRefund, $returnCartItems, $refundAmount, $refundPoints, 0);
        }
    }
}
