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

    public function user_outfits(Request $request, User $user) {
        // return outfits belonging to user

        $query = $user->outfits()->with('inspiredBy', 'user', 'pieces');
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function following_outfits(Request $request, User $user) {
        // return outfits from people that user is following

        $query = $user->following()->with('outfits.user', 'outfits.pieces', 'outfits.inspiredBy');
        $following = $query->paginate(15);

        return response()->json($following)->setCallback($request->input('callback'));
    }
}