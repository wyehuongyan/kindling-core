<?php namespace App\Http\Controllers;

use App\Facades\SprubixQueue;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserGender;
use App\Models\UserInfo;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller {

    public function createShop(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:30|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6|max:30',
        ]);

        if ($validator->fails()) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator->messages()
            );

            return response()->json($error)
                ->setCallback($request->input('callback'));
        } else {
            $user = new User();

            $user->username = $request->get("username");
            $user->name = $request->get("username");
            $user->email = $request->get("email");
            $user->password = bcrypt($request->get("password"));
            $user->image = cdn("/users/0_default_profile_placeholder.jpg");

            // for FB login
            if($request['facebook_id'] != "") {
                $user->facebook_account_id = $request['facebook_id'];
            }

            $user->save();

            $hashids = new Hashids("user_email_verification", 32, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890");
            $user->verification_code = $hashids->encode($user->id);

            $user->save();

            // // polymorphic shop 1
            $shop = new Shop();
            $shop->save();
            $shop->user()->save($user);

            $shop->owner()->associate($user);
            $shop->save();

            $user_info = new UserInfo();

            if($request['first_name'] != "") {
                $user_info->first_name = $request['first_name'];
            }

            if($request['last_name'] != "") {
                $user_info->last_name = $request['last_name'];
            }

            if($request['gender'] != "") {
                $genderId = UserGender::where('gender',ucfirst($request['gender']))->first();
                $user_info->gender()->associate(UserGender::find($genderId->id));
            }

            $user_info->user()->associate($user);
            $user_info->save();

            $user->following()->save($user);

            $success = array(
                "status" => "200",
                "message" => "success",
                "data" => $user
            );

            SprubixQueue::queueVerificationEmail($user);

            return response()->json($success)->setCallback($request->input('callback'));
        }
    }

}