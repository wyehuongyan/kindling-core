<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Piece;

class PieceController extends Controller {
    public function pieces(Request $request) {
        $input = $request->all();

        $query = Piece::search($input)->with('user');
        $pieces = $query->paginate(15);
        $pieces->setPath($request->url());
        $pieces->getCollection()->shuffle();

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function piecesByIds(Request $request) {
        $ids = $request->get("ids");

        $query = Piece::with('user')->whereIn('id', $ids)->with('user');
        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function userPieces(Request $request, User $user) {
        // return pieces belonging to user

        //$query = $user->pieces()->withTrashed()->with('user');
        $query = $user->pieces()->with('user');
        $pieces = $query->paginate(15);
        $pieces->setPath($request->url()); // pieces/?page=2 to pieces?page=2

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function pieceOutfits(Request $request, Piece $piece) {
        // return outfits that this piece belongs to

        $query = $piece->outfits()->with('inspiredBy', 'user', 'pieces.user');
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function deletePiece(Request $request, Piece $piece) {
        if($piece->user->id == $request->get("owner_id")) {
            $piece->delete();

            $json = array(
                "status" => "200",
                "message" => "success",
                "deleted" => $piece
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
}