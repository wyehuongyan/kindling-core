<?php

namespace App\Jobs;

use App\Facades\SprubixMail;
use App\Jobs\Job;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReportInappropriateEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $poutfitType;
    protected $poutfitId;
    protected $time;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $poutfitType, $poutfitId, $time, $queueName)
    {
        //
        $this->user = $user;
        $this->poutfitType = $poutfitType;
        $this->poutfitId = $poutfitId;
        $this->time = $time;
        $this->onQueue($queueName);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // send email to sprubix
        SprubixMail::sendReportInappropriate($this->user, $this->poutfitType, $this->poutfitId, $this->time);
    }
}
