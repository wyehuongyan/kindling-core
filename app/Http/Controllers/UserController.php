<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Facades\CloudStorage;
use Carbon\Carbon;
use Hash;
use Log;

class UserController extends Controller {
    public function users(Request $request) {
        $input = $request->all();

        $query = User::search($input);
        $users = $query->paginate(15);

        return response()->json($users)->setCallback($request->input('callback'));
    }

    public function user(Request $request) {
        return response()->json(Auth::user())->setCallback($request->input('callback'));
    }

    public function followUser(Request $request) {
        $user = Auth::user();

        $followUser = User::find($request->get("follow_user_id"));

        try {
            if (!$followUser->followers->contains($user->id)) {
                $user->following()->save($followUser);
            }

            $json = array("status" => "200",
                "message" => "success",
                "following" => $user->following
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function unFollowUser(Request $request) {
        $user = Auth::user();

        $unFollowUser = User::find($request->get("unfollow_user_id"));

        try {
            if ($unFollowUser->followers->contains($user->id)) {
                $user->following()->detach($unFollowUser);
            }

            $json = array("status" => "200",
                "message" => "success",
                "following" => $user->following
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function followedUser(Request $request) {
        $input = $request->all();
        $targetUser = User::preciseSearch($input)->select('id')->first();

        if ($targetUser) {
            // checks if you are following a certain user
            $user = Auth::user();
            $alreadyFollowed = false;

            if ($targetUser->followers->contains($user->id)) {
                // you are already a follower of this user, you cannot follow him again
                $alreadyFollowed = true;
            }

            $leanUser = User::find($targetUser->id);

            $jsonResponse = array(
                "status" => "200",
                "message" => "success",
                "already_followed" => $alreadyFollowed,
                "followed_user" => $leanUser
            );
        } else {
            $jsonResponse = array(
                "status" => "500",
                "message" => "error: user not found",
            );
        }

        return response()->json($jsonResponse)->setCallback($request->input('callback'));
    }

    public function userFollowers(Request $request, User $user) {
        // retrieves the list of users that are following this user, i.e. this user's followers
        $followers = $user->followers()->where('follower_id', '!=', $user->id)->paginate(15);

        return response()->json($followers)->setCallback($request->input('callback'));
    }

    public function userFollowing(Request $request, User $user) {
        $following = $user->following()->where('following_id', '!=', $user->id)->paginate(15);

        return response()->json($following)->setCallback($request->input('callback'));
    }

    public function followingUsers(Request $request) {
        // retrieves the list of users you are following, with conditions
        // // used for autocomplete in comments when @username handles are used
        $initials = $request->get("initials"); // this will be used to match username or name
        $user = Auth::user();

        if(isset($initials)) {
            $following = $user->following()->where(function($query) use ($initials) {
                $query->where('username', 'like', '%' . $initials . '%')->orWhere('name', 'like', '%' . $initials . '%');
            })->get();
        }

        return response()->json($following)->setCallback($request->input('callback'));
    }

    public function searchUsers(Request $request) {
        $full_text = $request->get("full_text");

        $full_text_array = explode(" ", $full_text);
        $full_text_wildcard = "";

        foreach ($full_text_array as $text) {
            if ($text != "") {
                $full_text_wildcard .= $text . "*";
            }
        }

        $input = Array("full_text" => $full_text_wildcard);

        $query = User::search($input)->orderBy('created_at', 'desc');
        $users = $query->paginate(15);

        return response()->json($users)->setCallback($request->input('callback'));
    }

    // Update Profile
    public function updateProfile(Request $request) {
        // Validate the user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'description' => 'max:255',
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'contact_number' => 'max:255',
            'date_of_birth' => 'date|before:today',
            'gender' => 'max:255'
        ]);

        if ($validator->fails()) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator->messages()
            );

            return response()->json($error)->setCallback($request->input('callback'));
        } else {
            // Pass
            $user = Auth::user();
            $userInfo = $user->userInfo()->first();

            $name = $request->get("name");
            $description = new \stdClass();
            $description->description = $request->get("description");
            $firstName = $request->get("first_name");
            $lastName = $request->get("last_name");
            $contactNumber = $request->get("contact_number");

            $birthdate = $request->get("date_of_birth");
            $birthdateCarbon =  new Carbon();

            if (isset($birthdate)) {
                $birthdateCarbon = Carbon::createFromFormat("d-m-Y", $birthdate)->startOfDay();
            }

            try {
                $user->name = $name;
                $user->description = json_encode($description);

                // profile image
                if ($request->hasFile("profile")) {
                    $file_name_time = $user->id . "_profile_" . time() . ".jpg";
                    $file_path = storage_path() . "/uploads/" . $file_name_time;

                    $containerPath = "/users/" . $user->id;

                    $user->image = CloudStorage::putObject($request->file("profile"), "750", $file_path, $containerPath, $file_name_time);
                }

                if ($request->hasFile("cover")) {
                    $file_name_time = $user->id . "_cover_" . time() . ".jpg";
                    $file_path = storage_path() . "/uploads/" . $file_name_time;

                    $containerPath = "/users/" . $user->id;

                    $user->cover = CloudStorage::putObject($request->file("cover"), "750", $file_path, $containerPath, $file_name_time);
                }

                $user->save();

                $userInfo->first_name = $firstName;
                $userInfo->last_name = $lastName;
                $userInfo->contact_number = $contactNumber;

                if($request->get('gender') != "") {
                    $gender = UserGender::where('gender',$request->get("gender"))->get();

                    if(count($gender) > 0) {
                        $genderId = $gender[0]->id;
                        $userInfo->gender()->associate(UserGender::find($genderId));
                    }
                }

                if (isset($birthdate)) {
                    $userInfo->date_of_birth = $birthdateCarbon;
                }

                $userInfo->save();

                $json = array(
                    "status" => "200",
                    "message" => "success",
                    "user" => $user,
                    "user_info" => $userInfo
                );

            } catch (\Exception $e) {
                $json = array(
                    "status" => "500",
                    "message" => "exception",
                    "exception" => $e->getMessage()
                );
            }

            return response()->json($json)->setCallback($request->input('callback'));
        }
    }

    // Update Password
    public function updatePassword(Request $request) {
        // Validate the user input
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator->messages()
            );

            return response()->json($error)->setCallback($request->input('callback'));

        } else {
            // Pass
            $user= $request->user();
            $currentPassword = $request->get("current_password");
            $newPassword = $request->get("new_password");
            $match = Hash::check($currentPassword, $user->password);

            try {

                if ($match) {
                    $user->password = bcrypt($newPassword);
                    $user->save();

                    $success = array(
                        "status" => "200",
                        "message" => "success",
                        "data" => array("match" => $match)
                    );

                } else {
                    $success = array(
                        "status" => "200",
                        "message" => "fail",
                        "data" => array("match" => $match)
                    );
                }

            } catch (\Exception $e) {
                $json = array(
                    "status" => "500",
                    "message" => "exception",
                    "exception" => $e->getMessage()
                );
            }

            return response()->json($success)->setCallback($request->input('callback'));
        }
    }

    public function userPrivateInformation(Request $request) {
        $user = Auth::User();
        $userInfo = $user->userInfo;

        $firstname = "";
        $lastname = "";
        $contactnumber = "";
        $birthdate = "";
        $gender = "";

        if (isset($userInfo["first_name"])) {
            $firstname = $userInfo["first_name"];
        }

        if (isset($userInfo["last_name"])) {
            $lastname = $userInfo["last_name"];
        }

        if (isset($userInfo["contact_number"])) {
            $contactnumber = $userInfo["contact_number"];
        }

        if (isset($userInfo["date_of_birth"])) {
            $birthdate = Carbon::parse($userInfo["date_of_birth"])->format("d-m-Y");
        }

        if (isset($userInfo["gender_id"]) && $userInfo["gender_id"] != 0) {
            $gender = UserGender::find($userInfo["gender_id"])->gender;
        }

        $userInfoReturn =  Array(
            "first_name" => $firstname,
            "last_name" => $lastname,
            "contact_number" => $contactnumber,
            "date_of_birth" => $birthdate,
            "gender" => $gender
        );

        return response()->json($userInfoReturn)->setCallback($request->input('callback'));
    }
}