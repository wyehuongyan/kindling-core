<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryOption;
use App\Models\User;

class DeliveryController extends Controller {
    public function deliveryOptions(Request $request) {
        $input = $request->all();

        $query = DeliveryOption::search($input);
        $deliveryOptions = $query->paginate(15);

        return response()->json($deliveryOptions)->setCallback($request->input('callback'));
    }

    public function createDeliveryOption(Request $request) {
        $name = $request->get("name");
        $price = $request->get("price");
        $user = User::find($request->get("user_id"));

        $deliveryOption = new DeliveryOption();
        $deliveryOption->name = $name;
        $deliveryOption->price = $price;
        $deliveryOption->user()->associate($user);

        $deliveryOption->save();

        return response()->json($deliveryOption)->setCallback($request->input('callback'));
    }

    public function updateDeliveryOption(Request $request, DeliveryOption $deliveryOption) {
        $name = $request->get("name");
        $price = $request->get("price");

        $deliveryOption->name = $name;
        $deliveryOption->price = $price;
        $deliveryOption->save();

        return response()->json($deliveryOption)->setCallback($request->input('callback'));
    }

    public function deleteDeliveryOption(Request $request, DeliveryOption $deliveryOption) {
        if($deliveryOption->user->id == $request->get("owner_id")) {
            $deliveryOption->delete();

            $json = array(
                "status" => "200",
                "message" => "success",
                "deleted" => $deliveryOption
            );
        } else {
            $json = array(
                "status" => "400",
                "message" => "error",
                "data" => "failed to delete, please try again."
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }
}