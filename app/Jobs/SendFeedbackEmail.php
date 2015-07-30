<?php

namespace App\Jobs;

use Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFeedbackEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

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
        $support_name = "Team Sprubix";

        try {
            $mandrill = new Mandrill(env('MANDRILL_KEY'));

            $message = array(
                'html' => str_replace("\n", "<br />", $this->content),
                'text' => $this->content,
                'subject' => "Feedback from " . $this->user->username,
                'from_email' => $this->user->email,
                'from_name' => $this->user->username,
                'to' => array(
                    array(
                        'email' => env('MANDRILL_SPRUBIX_SUPPORT'),
                        'name' => $support_name,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => $this->user->email),
                'tags' => array('feedback'),
                'subaccount' => $this->user->id
            );

            $result = $mandrill->messages->send($message);
            $status = $result[0]['status'];

            // handle response
            if ($status != "sent") {
                // some error occured
                // log to sentry
            }

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            $error = array(
                "status" => "500",
                "message" => $e->getMessage()
            );

            // handle error
            Log::error($error); // log to sentry
        }
    }
}
