<?php

namespace App\Jobs;

use Log;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Davibennun\LaravelPushNotification\Facades\PushNotification;

class SendPushNotification extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $message, $queueName)
    {
        //
        $this->user = $user;
        $this->onQueue($queueName);
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // send a test apns
        if(isset($this->user->device_token)) {
            PushNotification::app("sprubixIOS")->to($this->user->device_token)->send($this->message);
        }
    }
}
