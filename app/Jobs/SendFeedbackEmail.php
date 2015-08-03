<?php

namespace App\Jobs;

use Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mandrill;
use Carbon\Carbon;

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
        // if no mandrill subaccount, create it
        if (!isset($this->user->mandrill_subaccount_id)) {
            $id = $this->user->id;
            $name = $this->user->username;
            $notes = 'Signed up on ' . Carbon::now();

            try {
                $mandrill = new Mandrill(env('MANDRILL_KEY'));

                $result = $mandrill->subaccounts->add($id, $name, $notes);
                $status = $result['status'];

                // account created
                if ($status == "active") {
                    $this->user->mandrill_subaccount_id = $id;
                    $this->user->save();
                } else {
                    // some error occured
                    // log to sentry, subaccount not created
                }

            } catch(Mandrill_Error $e) {
                // Mandrill errors are thrown as exceptions
                Log::error($e->getMessage()); // log to sentry
            }
        }

        // Send email if subaccount exist
        if (isset($this->user->mandrill_subaccount_id)) {
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
        } else {
            // some error occured
            // log to sentry, subaccount doesnt exist
        }

    }
}
