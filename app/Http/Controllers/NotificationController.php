<?php namespace App\Http\Controllers;

use App\Facades\SprubixQueue;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller {
    public function sendPushNotification(Request $request) {
        try {
            // $request must contain 'message' param
            $user = User::find($request->get("recipient_id"));

            SprubixQueue::queuePushNotification($request, $user);

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