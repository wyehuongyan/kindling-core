<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Facades\CloudStorage;
use Hash;

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

    public function followingUsers(Request $request) {
        // retrieves the list of users you are following, with conditions
        // // used for autocomplete in comments when @username handles are used
        $initials = $request->get("initials"); // this will be used to match username or name
        $user = Auth::user();

        $following = $user->following()->where(function($query) use ($initials) {
            $query->where('username', 'like', '%' . $initials . '%')->orWhere('name', 'like', '%' . $initials . '%');
        })->get();

        return response()->json($following)->setCallback($request->input('callback'));
    }

    // Update Profile
    public function updateProfile(Request $request) {
        // Validate the user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'description' => 'max:255',
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
            $authUser = Auth::user();

            $user = User::find($authUser->id)->with('shoppable')->first();
            $name = $request->get("name");
            $description = $request->get("description");

            try {
                $user->name = $name;
                $user->description = $description;

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

                $json = array(
                    "status" => "200",
                    "message" => "success",
                    "user" => $user
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
}