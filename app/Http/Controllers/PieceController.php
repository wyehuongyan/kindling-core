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

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function pieceOutfits(Request $request, Piece $piece) {
        // return outfits that this piece belongs to

        $query = $piece->outfits()->with('inspiredBy', 'user', 'pieces.user');
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }
}