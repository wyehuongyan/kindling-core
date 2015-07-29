<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mandrill;
use App\Models\User;
use Carbon\Carbon;
use Log;

class MailController extends Controller {

    public function createSubaccount(Request $request) {
        $id = $request->get("id");
        $name = $request->get("name");
        $notes = 'Signed up on ' . Carbon::now();

        try {
            $mandrill = new Mandrill(env('MANDRILL_KEY'));

            $result = $mandrill->subaccounts->add($id, $name, $notes);
            $status = $result['status'];

            if ($status == "active") {
                $success = array(
                    "status" => "200",
                    "message" => "success"
                );
            } else {
                $success = array(
                    "status" => "200",
                    "message" => "fail"
                );
            }

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            //echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            //throw $e;

            $error = array(
                "status" => "500",
                "message" => "exception"
            );

            return response()->json($error)->setCallback($request->input('callback'));
        }

        return response()->json($success)->setCallback($request->input('callback'));
    }

    public function feedback(Request $request) {

        $user = $request->user();
        $content = $request->get("content");
        $support_name = "Team Sprubix";

        try {
            $mandrill = new Mandrill(env('MANDRILL_KEY'));

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

            $result = $mandrill->messages->send($message);
            $status = $result[0]['status'];

            if ($status == "sent") {
                $success = array(
                    "status" => "200",
                    "message" => "success"
                );
            } else {
                $success = array(
                    "status" => "200",
                    "message" => "fail"
                );
            }

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            //echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            //throw $e;

            $error = array(
                "status" => "500",
                "message" => "exception"
            );

            return response()->json($error)->setCallback($request->input('callback'));
        }

        return response()->json($success)->setCallback($request->input('callback'));
    }

}