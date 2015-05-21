<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outfit;

class OutfitController extends Controller {
    public function outfits(Request $request) {
        $input = $request->all();

        $query = Outfit::search($input);
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function userOutfits(Request $request, User $user) {
        // return outfits belonging to user

        $query = $user->outfits()->with('inspiredBy', 'user', 'pieces.user');
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function followingOutfits(Request $request, User $user) {
        // return outfits from people that user is following

        //$query = $user->following()->with('outfits.user', 'outfits.pieces.user', 'outfits.inspiredBy');
        //$following = $query->paginate(15);

        $users = $user->following()->get();
        $userIds = array();

        foreach($users as $user) {
            $userIds[] = $user->id;
        }

        $query = Outfit::whereIn('user_id', $userIds)->with('user', 'pieces.user', 'inspiredBy')->orderBy('created_at', 'desc');
        $following = $query->paginate(15);

        return response()->json($following)->setCallback($request->input('callback'));
    }

    public function communityOutfits(Request $request, User $user) {
        // $user refers to logged in user
        // outfits where pieces == user.id && outfit user_id != user.id && unique
        /*$query = $user->pieces()->whereHas('outfits', function ($query) use ($user) { // all outfits made up of pieces that user own, outfits may or may not belong to user
            $query->whereNotIn('user_id', [$user->id]);
        });
        $pieces = $query->paginate(15);
        */

        $query = Outfit::whereNotIn('user_id', [$user->id])->whereHas('pieces', function($query) use ($user) {
            $query->where('user_id', [$user->id]);
        })->with('inspiredBy', 'user', 'pieces.user');

        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }
}