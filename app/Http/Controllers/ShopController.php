<?php namespace App\Http\Controllers;

use App\Facades\SprubixQueue;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserGender;
use App\Models\UserInfo;
use Carbon\Carbon;
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

            // by default, user follows self
            $user->following()->save($user);

            // on production, also follow sprubix account
            if(env('APP_ENV') == "production") {
                // sprubix account is user 1
                $sprubixUser = User::find(1);
                $user->following()->save($sprubixUser);
            }

            // mixpanel initialization
            //// clear Mixpanel events queue
            $mixpanel = \Mixpanel::getInstance(env("MIXPANEL_TOKEN"));

            // // shop mixpanel
            $user_distinct_id = strtoupper(uniqid()."-".dechex($user->id));
            $mixpanel->createAlias($user_distinct_id, $user->id);
            $mixpanel->people->set($user->id, array(
                '$email'                    => $user->email,
                'ID'                        => $user->id,
                'Username'                  => $user->username,
                '$first_name'               => $user->username,
                '$last_name'                =>  "",
                '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
                'Distinct ID'               => $user_distinct_id,
                'Points'                    => 0,
                'Outfits Exposed'           => 0,
                'Pieces Exposed'            => 0,
                'Outfits Liked'             => 0,
                'Pieces Liked'              => 0,
                'Outfits Created'           => 0,
                'Pieces Created'            => 0,
                'Spruce Outfit'             => 0,
                'Spruce Outfit Swipe'       => 0,
                'Outfit Details Viewed'     => 0,
                'Piece Details Viewed'      => 0,
                'Outfit Comments Viewed'    => 0,
                'Piece Comments Viewed'     => 0
            ));

            $mixpanel->flush();

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