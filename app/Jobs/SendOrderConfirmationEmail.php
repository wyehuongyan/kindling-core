<?php

namespace App\Jobs;

use App\Jobs\Job;
use Carbon\Carbon;
use Log;
use App\Models\UserOrder;
use App\Facades\SprubixMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmationEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $userOrderId;

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
        $userOrder = UserOrder::find($this->userOrderId);

        if(isset($userOrder)) {
            $user = $userOrder->user;

            // if no mandrill subaccount, create it
            if (!isset($user->mandrill_subaccount_id)) {
                $id = $user->id;
                $name = $user->username;
                $notes = 'Signed up on ' . Carbon::now();

                $result = SprubixMail::addSubAccount($id, $name, $notes);
                $status = $result['status'];

                // account created
                if ($status == "active") {
                    $user->mandrill_subaccount_id = $id;
                    $user->save();

                    // send order confirmation email
                    SprubixMail::sendOrderConfirmation($user, $userOrder);
                } else {
                    // some error occured
                    // log to sentry, subaccount not created
                }

            } else {
                // send order confirmation email directly if subaccount exist
                SprubixMail::sendOrderConfirmation($user, $userOrder);
            }
        } else {
            // User Order cannot be found, log to sentry
        }
    }
}
