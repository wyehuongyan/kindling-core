<?php namespace App\Http\Controllers;

use App\Facades\SprubixQueue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class MailController extends Controller {

    public function feedback(Request $request) {
        try {
            $user = Auth::User();

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

    public function reportInappropriate(Request $request) {
        try {
            $user = Auth::User();
            $poutfitType = $request->get("poutfit_type");
            $poutfitId = $request->get("poutfit_id");
            $time = Carbon::now();

            SprubixQueue::queueReportInappropriateEmail($user, $poutfitType, $poutfitId, $time);

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