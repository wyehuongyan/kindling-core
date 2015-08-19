<?php namespace App\Services;

use App\Jobs\SendOrderConfirmationEmail;
use App\Jobs\SendPushNotification;
use App\Models\ShopOrder;
use App\Models\User;
use IronMQ\IronMQ;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SprubixQueue {

    use DispatchesJobs;

    public function __construct() {
        $this->ironMQ = new IronMQ();
    }

    public function queuePushNotification(User $user, $message) {
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

        $job = (new SendPushNotification($user, $message, $queueName));
        $this->dispatch($job);
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

    public function queueRefundedEmail() {

    }

    public function queueOrderConfirmationEmail($userOrderId) {
        $queueName = "email_order_confirmation";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendOrderConfirmationEmail($userOrderId, $queueName));
        $this->dispatch($job);
    }

    public function queueShopOrderUpdateEmail(ShopOrder $shopOrder) {
        $queueName = "email_order_update";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendShopOrderUpdateEmail($shopOrder, $queueName));
        $this->dispatch($job);
    }
}