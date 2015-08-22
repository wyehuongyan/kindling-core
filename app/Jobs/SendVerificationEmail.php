<?php

namespace App\Jobs;

use App\Facades\SprubixMail;
use App\Jobs\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $queueName)
    {
        //
        $this->user = $user;
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
        if(isset($this->user)) {
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

                    // send verification email
                    SprubixMail::sendEmailVerification($this->user);
                } else {
                    // some error occured
                    // log to sentry, subaccount not created
                }

            } else {
                // send verification email
                SprubixMail::sendEmailVerification($this->user);
            }
        } else {
            // User cannot be found, log to sentry
        }
    }
}
