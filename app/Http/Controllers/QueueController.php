<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Queue;
use App\Models\User;
use IronMQ\IronMQ;
use Log;
use Illuminate\Http\Request;

class QueueController extends Controller {
    public function receiveJob(Request $request) {
        return Queue::marshal();
    }

    public function sendPushNotification(Request $request) {
        try {
            // $request must contain 'message' param
            $user = User::find($request->get("recipient_id"));
            $queueName = "push_notifications";
            $ironmq = new IronMQ();

            $params = array(
                "push_type" => "multicast",
                "retries" => 5,
                "subscribers" => array(
                    array("url" => env("NGROK_URL") . "/queue/receive")
                ),
                "error_queue" => ""
            );

            $ironmq->updateQueue($queueName, $params);

            $this->dispatchFrom('App\Jobs\SendPushNotification', $request, [
                'user' => $user,
                'queueName' => $queueName
            ]);

            Log::info("APNS pushed to Iron MQ.");

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