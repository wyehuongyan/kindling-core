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
}