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
    }

    public function updateDeliveryOption(Request $request) {

    }

    public function deleteDeliveryOption(Request $request) {

    }
}