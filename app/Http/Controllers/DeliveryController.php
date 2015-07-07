<?php namespace App\Http\Controllers;

use App\Models\UserShippingAddress;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\DeliveryOption;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Debug\Exception\FatalErrorException;

class DeliveryController extends Controller {
    //////////////////////////////////////////////
    ////////////// Delivery Options //////////////
    //////////////////////////////////////////////
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

    //////////////////////////////////////////////
    ///////////// Shipping Addresses /////////////
    //////////////////////////////////////////////
    public function userShippingAddresses(Request $request) {
        $user = $request->user();

        $userShippingAddresses = $user->shippingAddresses()->get();

        return response()->json($userShippingAddresses)->setCallback($request->input('callback'));
    }

    public function createShippingAddress(Request $request) {
        $user= $request->user();
        $firstName = $request->get("first_name");
        $lastName = $request->get("last_name");
        $company = $request->get("company");
        $contact = $request->get("contact_number");

        $addressLineOne = $request->get("address_1");
        $addressLineTwo = $request->get("address_2");
        $postalCode = $request->get("postal_code");
        $countryCode = $request->get("country_code");
        $city = $request->get("city");
        $state = $request->get("state");
        $country = $request->get("country");

        try {
            $userShippingAddress = new UserShippingAddress();
            $userShippingAddress->first_name = $firstName;
            $userShippingAddress->last_name = $lastName;

            if(isset($company)) {
                $userShippingAddress->company = $company;
            }

            $userShippingAddress->contact_number = $contact;
            $userShippingAddress->address_1 = $addressLineOne;

            if(isset($addressLineTwo)) {
                $userShippingAddress->address_2 = $addressLineTwo;
            }

            $userShippingAddress->postal_code = $postalCode;
            $userShippingAddress->country_code = $countryCode;
            $userShippingAddress->city = $city;
            $userShippingAddress->state = $state;
            $userShippingAddress->country = $country;

            $userShippingAddress->user()->associate($user);

            $userShippingAddress->save();

            $json = array("status" => "200",
                "message" => "success",
                "cart_item" => $userShippingAddress
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function  updateShippingAddress(Request $request, UserShippingAddress $userShippingAddress) {

    }

    public function deleteShippingAddress(Request $request, UserShippingAddress $userShippingAddress) {

    }
}