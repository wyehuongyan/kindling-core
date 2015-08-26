<?php namespace App\Http\Controllers;

use App\Models\UserPoints;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointsController extends Controller {
    public function userPoints(Request $request) {
        $user = Auth::user();

        $userPoints = $user->points;

        return response()->json($userPoints)->setCallback($request->input('callback'));
    }

    public function addUserPoints(Request $request) {
        try {
            $user = Auth::user();
            $userPoints = $user->points;

            // check if user has points initialized
            if(!isset($userPoints)) {
                $userPoints = new UserPoints();
                $userPoints->user()->associate($user);
                $userPoints->save();
            }

            $userPoints->amount = $request->get("amount");

            // extend expiry date by 3months from now
            $userPoints->expire_at = Carbon::now()->addMonth(3);

            $userPoints->save();

            $json = array("status" => "200",
                "message" => "success",
                "user_points" => $userPoints
            );
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function deductUserPoints(Request $request) {

    }

    public function updateUserPoints(Request $request) {

    }
}