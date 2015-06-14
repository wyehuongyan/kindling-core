<?php namespace App\Http\Controllers;

use App\Models\Shopper;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
}