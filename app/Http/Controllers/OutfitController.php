<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outfit;
use App\Models\Piece;
use DB;
use Log;

class OutfitController extends Controller {
    public function outfits(Request $request) {
        $input = $request->all();

        $lastOutfitId = $request->get("last_outfit_id");

        if($lastOutfitId) {
            $lastOutfit = Outfit::find($lastOutfitId);

            $query = Outfit::search($input)->where('created_at', '<', $lastOutfit->created_at)->with('user', 'inspiredBy')->with(array('pieces' => function($query) {
                    $query->withTrashed()->with('user.shoppable', 'category', 'brand');
                }))->orderBy('created_at', 'desc');

            $outfits = $query->take(15)->get();

        } else {
            $query = Outfit::search($input)->with('user', 'inspiredBy')->with(array('pieces' => function($query) {
                    $query->withTrashed()->with('user.shoppable', 'category', 'brand');
                }))->orderBy('created_at', 'desc');

            $outfits = $query->paginate(15);
        }

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function outfitsByIds(Request $request) {
        $ids = $request->get("ids");

        $query = Outfit::with('user', 'inspiredBy')->with(array('pieces' => function($query) {
                $query->withTrashed()->with('user.shoppable', 'category', 'brand');
            }))->whereIn('id', $ids)->orderBy('created_at', 'desc');

        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function userOutfits(Request $request, User $user) {
        // return outfits belonging to user
        $query = $user->outfits()->with('inspiredBy', 'user')->with(array('pieces' => function($query) {
                $query->withTrashed()->with('user.shoppable', 'category', 'brand');
            }))->orderBy('created_at', 'desc');
        $outfits = $query->paginate(15);
        $outfits->setPath($request->url()); // outfits/?page=2 to outfits?page=2

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function followingOutfits(Request $request, User $user) {
        // return outfits from people that user is following

        $users = $user->following()->get();
        $userIds = array();

        foreach($users as $user) {
            $userIds[] = $user->id;
        }

        $lastOutfitId = $request->get("last_outfit_id");

        if($lastOutfitId) {
            $lastOutfit = Outfit::find($lastOutfitId);

            $query = Outfit::whereIn('user_id', $userIds)->where('created_at', '<', $lastOutfit->created_at)->with('user', 'inspiredBy')->with(array('pieces' => function($query) {
                    $query->withTrashed()->with('user.shoppable', 'category', 'brand');
                }))->orderBy('created_at', 'desc');

            $following = $query->take(15)->get();
        } else {
            $query = Outfit::whereIn('user_id', $userIds)->with('user', 'inspiredBy')->with(array('pieces' => function($query) {
                    $query->withTrashed()->with('user.shoppable', 'category', 'brand');
                }))->orderBy('created_at', 'desc');

            $following = $query->paginate(15);
        }
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
        })->with('inspiredBy', 'user', 'pieces.user.shoppable')->orderBy('created_at', 'desc');

        $outfits = $query->paginate(15);
        $outfits->setPath($request->url()); // outfits/?page=2 to outfits?page=2

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function deleteOutfit(Request $request, Outfit $outfit) {
        if($outfit->user->id == $request->get("owner_id")) {
            $outfit->delete();

            $json = array(
                "status" => "200",
                "message" => "success",
                "deleted" => $outfit
            );
        } else {
            $json = array(
                "status" => "400",
                "message" => "error",
                "data" => "failed to delete, please try again."
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function outfitCategories(Request $request) {
        $pieceCategories = PieceCategory::all();

        return response()->json($pieceCategories)->setCallback($request->input('callback'));
    }

    public function searchOutfits(Request $request) {
        $full_text = $request->get("full_text");
        $types = Array("HEAD", "TOP", "BOTTOM", "FEET");

        $input_for_outfits = Array("full_text" => $full_text);
        $input_for_pieces = Array("full_text" => $full_text, "types" => $types);

        $query_from_outfit = Outfit::search($input_for_outfits)->get();
        $query_from_piece = Piece::search($input_for_pieces)->get();

        $results_outfitId = Array();

        // Outfit IDs from results searched from Outfit
        foreach ($query_from_outfit as $outfit) {
            array_push($results_outfitId, $outfit["id"]);
        }

        // Pieces IDs from results searched from Piece
        $query_from_piece_pieceId = Array();

        foreach ($query_from_piece as $piece) {
            array_push($query_from_piece_pieceId, $piece["id"]);
        }

        // Outfit IDs from results searched from Piece
        $query_from_piece_pieceId_unique = array_unique($query_from_piece_pieceId);
        $query_from_pieces_outfits = DB::table('pieces_outfits')->whereIn('piece_id',$query_from_piece_pieceId_unique)->select('outfit_id')->get();

        foreach ($query_from_pieces_outfits as $key => $value) {
            array_push($results_outfitId, $value->outfit_id);
        }

        // Fetch outfits
        $results_outfitId_unique = array_unique($results_outfitId);
        $results_outfits = Outfit::whereIn('id', $results_outfitId_unique)->with('user', 'inspiredBy')->with(array('pieces' => function($query) {
            $query->withTrashed()->with('user.shoppable', 'category', 'brand');
        }))->orderBy('created_at', 'desc');

        $outfits = $results_outfits->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }
}