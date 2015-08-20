<?php

namespace App\Jobs;

use App\Jobs\Job;
use Carbon\Carbon;
use Log;
use App\Facades\SprubixMail;
use App\Models\ShopOrderRefund;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShopOrderRefundRequestEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $shopOrderRefund;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ShopOrderRefund $shopOrderRefund, $queueName)
    {
        //
        $this->shopOrderRefund = $shopOrderRefund;
        $this->onQueue($queueName);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if(isset($this->shopOrderRefund)) {
            $seller = $this->shopOrderRefund->user;

            // if no mandrill subaccount, create it
            if (!isset($seller->mandrill_subaccount_id)) {
                $id = $seller->id;
                $name = $seller->username;
                $notes = 'Signed up on ' . Carbon::now();

                $result = SprubixMail::addSubAccount($id, $name, $notes);
                $status = $result['status'];

                // account created
                if ($status == "active") {
                    $seller->mandrill_subaccount_id = $id;
                    $seller->save();

                    // send shop order refund request email
                    SprubixMail::sendShopOrderRefundRequest($seller, $this->shopOrderRefund);
                } else {
                    // some error occured
                    // log to sentry, subaccount not created
                }

            } else {
                // send shop order refund request email
                SprubixMail::sendShopOrderRefundRequest($seller, $this->shopOrderRefund);
            }
        } else {
            // Shop Order Refund cannot be found, log to sentry
        }
    }
}
