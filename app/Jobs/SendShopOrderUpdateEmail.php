<?php

namespace App\Jobs;

use App\Jobs\Job;
use Carbon\Carbon;
use Log;
use App\Models\ShopOrder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShopOrderUpdateEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $shopOrder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ShopOrder $shopOrder, $queueName)
    {
        //
        $this->shopOrder = $shopOrder;
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
        if(isset($this->shopOrder)) {
            $buyer = $this->shopOrder->buyer;

            // if no mandrill subaccount, create it
            if (!isset($buyer->mandrill_subaccount_id)) {
                $id = $buyer->id;
                $name = $buyer->username;
                $notes = 'Signed up on ' . Carbon::now();

                $result = SprubixMail::addSubAccount($id, $name, $notes);
                $status = $result['status'];

                // account created
                if ($status == "active") {
                    $buyer->mandrill_subaccount_id = $id;
                    $buyer->save();

                    // send shop order update email
                    SprubixMail::sendShopOrderUpdate($buyer, $this->shopOrder);
                } else {
                    // some error occured
                    // log to sentry, subaccount not created
                }

            } else {
                // send shop order update email
                SprubixMail::sendShopOrderUpdate($buyer, $this->shopOrder);
            }
        } else {
            // Shop Order cannot be found, log to sentry
        }
    }
}
