<?php namespace App\Http\Controllers;

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

    public function followingUser(Request $request, User $targetUser) {
        // checks if you are following a certain user
        $user = Auth::user();
        $canFollow = true;

        if ($targetUser->followers->contains($user->id)) {
            // you are already a follower of this user, you cannot follow him again
            $canFollow = false;
        }

        $success = array(
            "status" => "200",
            "message" => "success",
            "can_follow" => $canFollow
        );

        return response()->json($success)->setCallback($request->input('callback'));
    }
}