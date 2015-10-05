<?php namespace App\Http\Controllers;

use App\Models\UserShippingAddress;
use Illuminate\Http\Request;
use App\Models\DeliveryOption;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function deliveryOption(Request $request, DeliveryOption $deliveryOption) {
        $deliveryOption = $deliveryOption::with('shopOrders')->find($deliveryOption->id);

        return response()->json($deliveryOption)->setCallback($request->input('callback'));
    }

    public function createDeliveryOption(Request $request) {
        $name = $request->get("name");
        $price = $request->get("price");
        $estimatedTime = $request->get("estimated_time");

        $user = Auth::user();

        $deliveryOption = new DeliveryOption();
        $deliveryOption->name = $name;
        $deliveryOption->price = $price;
        $deliveryOption->estimated_time = $estimatedTime;
        $deliveryOption->user()->associate($user);

        $user->shoppable->purchasable = true;
        $user->shoppable->save();

        $deliveryOption->save();

        return response()->json($deliveryOption)->setCallback($request->input('callback'));
    }

    public function updateDeliveryOption(Request $request, DeliveryOption $deliveryOption) {
        try {
            $name = $request->get("name");
            $price = $request->get("price");

            $deliveryOption->name = $name;
            $deliveryOption->price = $price;

            $deliveryOption->save();

            $json = array("status" => "200",
                "message" => "success",
                "delivery_option" => $deliveryOption
            );
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function deleteDeliveryOption(Request $request, DeliveryOption $deliveryOption) {
        if($deliveryOption->user->id == $request->get("owner_id")) {
            $deliveryOption->delete();

            // check if there's any delivery option left
            $user = User::find($request->get("owner_id"));

            if($user->deliveryOptions()->count() <= 0) {
                $user->shoppable->purchasable = false;
                $user->shoppable->save();
            }

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

        $userShippingAddresses = $user->shippingAddresses()->orderBy('is_current', 'desc')->get();

        return response()->json($userShippingAddresses)->setCallback($request->input('callback'));
    }

    public function userShippingAddress(Request $request) {
        $user = $request->user();

        $userShippingAddress = UserShippingAddress::search(["user_id" => $user->id, "is_current" => 1])->first();

        return response()->json($userShippingAddress)->setCallback($request->input('callback'));
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

        $isCurrent = $request->get("is_current");

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

            if(isset($isCurrent)) {
                if ($isCurrent) {
                    // set all other shipping addresses to be not current
                    $userShippingAddresses = $user->shippingAddresses()->get();

                    foreach($userShippingAddresses as $shippingAddress){
                        $shippingAddress->is_current = false;

                        $shippingAddress->save();
                    }

                    $userShippingAddress->is_current = $isCurrent;
                }
            }

            $userShippingAddress->user()->associate($user);

            $userShippingAddress->save();

            $json = array("status" => "200",
                "message" => "success",
                "user_shipping_address" => $userShippingAddress
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function updateShippingAddress(Request $request, UserShippingAddress $userShippingAddress) {
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

        $isCurrent = $request->get("is_current");

        Log::info($request->all());

        try {
            $userShippingAddress->first_name = $firstName;
            $userShippingAddress->last_name = $lastName;
            $userShippingAddress->company = $company;
            $userShippingAddress->contact_number = $contact;
            $userShippingAddress->address_1 = $addressLineOne;
            $userShippingAddress->address_2 = $addressLineTwo;
            $userShippingAddress->postal_code = $postalCode;
            $userShippingAddress->country_code = $countryCode;
            $userShippingAddress->city = $city;
            $userShippingAddress->state = $state;
            $userShippingAddress->country = $country;

            if(isset($isCurrent)) {
                if ($isCurrent) {
                    // set all other shipping addresses to be not current
                    $userShippingAddresses = $user->shippingAddresses()->get();

                    foreach($userShippingAddresses as $shippingAddress){
                        $shippingAddress->is_current = false;

                        $shippingAddress->save();
                    }

                    $userShippingAddress->is_current = true;
                }
            }

            $userShippingAddress->user()->associate($user);

            $userShippingAddress->save();

            Log::info($userShippingAddress);

            $json = array("status" => "200",
                "message" => "success",
                "user_shipping_address" => $userShippingAddress
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function deleteShippingAddress(Request $request, UserShippingAddress $userShippingAddress) {
        $user = $request->user();

        if($userShippingAddress->user->id == $request->get("owner_id")) {
            if($userShippingAddress->is_current) {
                // set the immediate successor to be current
                $userShippingAddresses = $user->shippingAddresses()->get();

                foreach($userShippingAddresses as $shippingAddress) {
                    if(!$shippingAddress->is_current) {
                        $shippingAddress->is_current = true;
                        $shippingAddress->save();

                        break;
                    }
                }
            }

            $userShippingAddress->delete();

            $json = array(
                "status" => "200",
                "message" => "success",
                "deleted" => $userShippingAddress
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