<?php namespace App\Http\Controllers;

use App\Facades\SprubixQueue;
use Illuminate\Http\Request;
use Mandrill;
use App\Models\User;
use Log;

class MailController extends Controller {

    public function feedback(Request $request) {
        try {
            $user = User::find($request->user()->id);

            SprubixQueue::queueFeedbackEmail($request, $user);

            $json = array("status" => "200",
                "message" => "success"
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    // for testing only
    public function orders(Request $request) {
        try {
            $mandrill = new Mandrill(env('MANDRILL_KEY'));

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

            $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }

}