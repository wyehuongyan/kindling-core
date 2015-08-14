<?php namespace App\Services;

use App\Models\User;
use IronMQ\IronMQ;
use Illuminate\Http\Request;

class SprubixQueue {
    public function __construct() {
        $this->ironMQ = new IronMQ();
    }

    public function queuePushNotification(Request $request, User $user) {
        $queueName = "push_notifications";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $this->dispatchFrom('App\Jobs\SendPushNotification', $request, [
            'user' => $user,
            'queueName' => $queueName
        ]);
    }

    public function queueFeedbackEmail(Request $request, User $user) {
        $queueName = "email_feedback";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $this->dispatchFrom('App\Jobs\SendFeedbackEmail', $request, [
            'user' => $user,
            'queueName' => $queueName
        ]);
    }

    public function queueRefundRequestEmail() {

    }

    public function queueOrderConfirmationEmail($userOrderId) {
        $queueName = "email_confirmation";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendOrderConfirmationEmail($userOrderId));
        $this->dispatch($job);
    }
}