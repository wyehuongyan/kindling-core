<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outfit;
use App\Models\Piece;

class OutfitController extends Controller {
    public function outfits(Request $request) {
        $input = $request->all();

        $query = Outfit::search($input)->with('user', 'pieces.user', 'inspiredBy');
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function outfitsByIds(Request $request) {
        $ids = $request->get("ids");

        $query = Outfit::with('user', 'inspiredBy')->with(array('pieces' => function($query) {
                $query->withTrashed()->with('user');
            }))->whereIn('id', $ids);

        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function userOutfits(Request $request, User $user) {
        // return outfits belonging to user

        /*$piece = Piece::find(1);
        $piece->delete();*/

        $query = $user->outfits()->with('inspiredBy', 'user')->with(array('pieces' => function($query) {
                $query->withTrashed()->with('user');
            }));
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function followingOutfits(Request $request, User $user) {
        // return outfits from people that user is following

        $users = $user->following()->get();
        $userIds = array();

        foreach($users as $user) {
            $userIds[] = $user->id;
        }

        $query = Outfit::whereIn('user_id', $userIds)->with('user', 'inspiredBy')->with(array('pieces' => function($query) {
                $query->withTrashed()->with('user');
            }))->orderBy('created_at', 'desc');
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