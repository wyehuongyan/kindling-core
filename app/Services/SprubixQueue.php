<?php namespace App\Services;

use App\Jobs\RefundShopOrder;
use App\Jobs\SendOrderConfirmationEmail;
use App\Jobs\SendPushNotification;
use App\Jobs\SendReportInappropriateEmail;
use App\Jobs\SendShopOrderRefundApprovedEmail;
use App\Jobs\SendShopOrderRefundRequestEmail;
use App\Jobs\SendShopOrderUpdateEmail;
use App\Jobs\SendVerificationEmail;
use App\Jobs\SendWelcomeEmail;
use App\Models\ShopOrder;
use App\Models\ShopOrderRefund;
use App\Models\User;
use IronMQ\IronMQ;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SprubixQueue {

    use DispatchesJobs;

    public function __construct() {
        $this->ironMQ = new IronMQ();
    }

    // Refunds
    public function queueRefund(ShopOrder $shopOrder, ShopOrderRefund $shopOrderRefund, $returnCartItems, $returnAmount, $refundPoints, $delay) {
        $queueName = "refunds";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new RefundShopOrder($shopOrder, $shopOrderRefund, $returnCartItems, $returnAmount, $refundPoints, $queueName))->delay($delay);

        $this->dispatch($job);
    }

    // Push Notifications
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

    // Emails
    public function queueVerificationEmail(User $user) {
        $queueName = "email_verification";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendVerificationEmail($user, $queueName));
        $this->dispatch($job);
    }

    public function queueWelcomeEmail(User $user) {
        $queueName = "email_welcome";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendWelcomeEmail($user, $queueName));
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

    public function queueRefundRequestEmail(ShopOrderRefund $shopOrderRefund) {
        $queueName = "email_order_refund";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendShopOrderRefundRequestEmail($shopOrderRefund, $queueName));
        $this->dispatch($job);
    }

    public function queueRefundApprovedEmail(ShopOrderRefund $shopOrderRefund) {
        $queueName = "email_order_refund";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendShopOrderRefundApprovedEmail($shopOrderRefund, $queueName));
        $this->dispatch($job);
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

    public function queueReportInappropriateEmail(User $user, $poutfitType, $poutfitId, $time) {
        $queueName = "email_report_inappropriate";

        $params = array(
            "push_type" => "multicast",
            "retries" => 5,
            "subscribers" => array(
                array("url" => env("NGROK_URL") . "/queue/receive")
            ),
            "error_queue" => $queueName . "_errors"
        );

        $this->ironMQ->updateQueue($queueName, $params);

        $job = (new SendReportInappropriateEmail($user, $poutfitType, $poutfitId, $time, $queueName));
        $this->dispatch($job);
    }
}