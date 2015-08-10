<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmationEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userOrderId, $queueName)
    {
        //
        $this->userOrderId = $userOrderId;
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
        $userOrder = UserOrder::find($this->userOrderId)->with(array("shopOrders" => function($query) {
            $query->with("user", "orderStatus");
        }))->first();

        if(isset($userOrder)) {
            // if no mandrill subaccount, create it
            if (!isset($this->user->mandrill_subaccount_id)) {
                $id = $this->user->id;
                $name = $this->user->username;
                $notes = 'Signed up on ' . Carbon::now();

                $result = SprubixMail::addSubAccount($id, $name, $notes);
                $status = $result['status'];

                // account created
                if ($status == "active") {
                    $this->user->mandrill_subaccount_id = $id;
                    $this->user->save();

                    // send order confirmation email
                    SprubixMail::sendOrderConfirmation();
                } else {
                    // some error occured
                    // log to sentry, subaccount not created
                }

            } else {
                // send order confirmation email directly if subaccount exist
                SprubixMail::sendOrderConfirmation();
            }
        } else {
            // User Order cannot be found, log to sentry
        }
    }
}
