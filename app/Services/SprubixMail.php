<?php namespace App\Services;

use Mandrill;
use App\Models\User;

class SprubixMail {

    public function __construct() {
        $this->mandrill = new Mandrill(env('MANDRILL_TEST_KEY'));
    }

    public function sendFeedback(User $user, $content) {
        try {
            $support_name = "Team Sprubix";

            $message = array(
                'html' => str_replace("\n", "<br />", $content),
                'text' => $content,
                'subject' => "Feedback from " . $user->username,
                'from_email' => $user->email,
                'from_name' => $user->username,
                'to' => array(
                    array(
                        'email' => env('MANDRILL_SPRUBIX_SUPPORT'),
                        'name' => $support_name,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => $user->email),
                'tags' => array('feedback'),
                'subaccount' => $user->id
            );

            $result = $this->mandrill->messages->send($message);
            $status = $result[0]['status'];

            // handle response
            if ($status != "sent") {
                // some error occured
                // log to sentry
            }

            return $result;

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            $error = array(
                "status" => "500",
                "message" => $e->getMessage()
            );

            // handle error
            Log::error($error); // log to sentry
        }
    }

    public function sendOrderConfirmation() {

    }

    public function sendOrderUpdate() {

    }

    public function addSubAccount($id, $name, $notes) {
        try {
            // create subaccount
            $result = $this->mandrill->subaccounts->add($id, $name, $notes);

            return $result;

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            Log::error($e->getMessage()); // log to sentry
        }
    }
}