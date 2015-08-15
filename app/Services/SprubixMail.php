<?php namespace App\Services;

use Mandrill;
use Mandrill_Error;
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

    public function sendOrderConfirmation(/*User $recipient*/) {
        /*
        try {
            $recipient_email = "onishinobimusha@hotmail.com";
            $recipient_name = "Shion";
            $orderlist = array (
                array (
                    'name' => 'White Skirt',
                    'price' => '$10'
                ),
                array (
                    'name' => 'Pink Top',
                    'price' => '$20'
                ),
                array (
                    'name' => 'Black Hat',
                    'price' => '$30'
                ));

            // template slug name in Mandrill
            $template_name = 'ordertest';
            $template_content = array();
            $message = array(
                'subject' => 'Thanks for Ordering!',
                'from_email' => 'support@sprubix.com',
                'from_name' => 'Team Sprubix',
                'to' => array(
                    array(
                        'email' => $recipient_email,
                        'name' => $recipient_name,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'sales@sprubix.com'),
                "auto_text" => true,
                "inline_css" => true,
                'merge' => true,
                'merge_language' => 'handlebars',
                'global_merge_vars' => array(
                    array(
                        'name' => 'company',
                        'content' => 'Sprubix'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $recipient_email,
                        'vars' => array(
                            array(
                                'name' => 'farewell',
                                'content' => $recipient_name
                            ),
                            array(
                                'name' => 'orders',
                                'content' => $orderlist
                            )
                        )
                    )
                ),
                'tags' => array('welcome'),
                'subaccount' => '1'
            );

            $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
        */
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