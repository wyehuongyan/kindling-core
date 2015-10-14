<?php

namespace App\Jobs;

use App\Facades\SprubixMail;
use Log;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class SendFeedbackEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $content, $queueName)
    {
        //
        $this->user = $user;
        $this->onQueue($queueName);
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // if no mandrill subaccount, create it
        if (!isset($this->user->mandrill_subaccount_id)) {
            $id = $this->user->id;
            $name = $this->user->username;
            $notes = 'Signed up on ' . Carbon::now();

            $result = SprubixMail::addSubAccount($id, $name, $notes);
            $status = $result['status'];

            // account created
            if ($status == "active") {
                $this->user->mandrill_subaccount_id = $result['id'];
                $this->user->save();

                // send email
                SprubixMail::sendFeedback($this->user, $this->content);
            } else {
                // some error occured
                // log to sentry, subaccount not created
            }

        } else {
            // send email directly if subaccount exist
            SprubixMail::sendFeedback($this->user, $this->content);
        }
    }
}
