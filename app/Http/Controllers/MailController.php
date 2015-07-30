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
                "message" => $e->getMessage()
            );

            return response()->json($error)->setCallback($request->input('callback'));
        }

        return response()->json($success)->setCallback($request->input('callback'));
    }

    public function feedback(Request $request) {
        try {
            $user = $request->user();
            $queueName = "email_feedback";

            $ironmq = new IronMQ();

            $params = array(
                "push_type" => "multicast",
                "retries" => 5,
                "subscribers" => array(
                    array("url" => env("NGROK_URL") . "/queue/receive")
                ),
                "error_queue" => $queueName . "_errors"
            );

            $ironmq->updateQueue($queueName, $params);

            $this->dispatchFrom('App\Jobs\SendFeedbackEmail', $request, [
                'user' => $user,
                'queueName' => $queueName
            ]);

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

}