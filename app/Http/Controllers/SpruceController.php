<?php namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SpruceController extends Controller {

    public function pieces(Request $request) {
        $input = $request->all();

        // ids of the owners of the neighboring pieces
        $userIds = array_unique($request->get('user_ids'));

        // ids of the owner's followers and following users
        $followerIds =  array();
        $followingIds = array();

        foreach($userIds as $userId) {
            $user = User::find($userId);
            $followers = $user->followers()->get();
            $followings = $user->following()->get();

            foreach($followers as $follower) {
                $followerIds[] = $follower->id;
            }

            foreach($followings as $following) {
                $followingIds[] = $following->id;
            }
        }

        $followIds = array_merge($followerIds, $followingIds);

        $ids = array_merge($followIds, $userIds);
        $ids = array_unique($ids);

        $query = Piece::search($input)->with('user', 'category', 'brand')->whereIn('user_id', $ids);
        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }
}