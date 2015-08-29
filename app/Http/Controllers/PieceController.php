<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Piece;
use App\Models\PieceCategory;
use App\Models\PieceBrand;

class PieceController extends Controller {
    public function pieces(Request $request) {
        $input = $request->all();

        $query = Piece::search($input)->with('user', 'category', 'brand');
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
        $query = $user->pieces()->with('user', 'category', 'brand');
        $pieces = $query->paginate(15);
        $pieces->setPath($request->url()); // pieces/?page=2 to pieces?page=2

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function peoplePieces(Request $request) {
        // return pieces of promoted/popular users

        $user = Auth::User();
        $peopleIds = ["4", "1", "3", "2"];

        $people = User::whereIn('id', $peopleIds)->orderByRaw('FIELD(`id`, '.implode(',', $peopleIds).')')->get()->map(function($people) use ($user) {
            $people->pieces = $people->pieces()->take(6)->get();
            $people->followed = $people->followers->contains($user->id);

            return $people;
        });

        return response()->json($people)->setCallback($request->input('callback'));
    }

    public function pieceOutfits(Request $request, Piece $piece) {
        // return outfits that this piece belongs to

        $query = $piece->outfits()->with('inspiredBy', 'user', 'pieces.user', 'pieces.category', 'pieces.brand');
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

    public function pieceCategories(Request $request) {
        $pieceCategories = PieceCategory::all();

        return response()->json($pieceCategories)->setCallback($request->input('callback'));
    }

    public function pieceBrands(Request $request) {
        $input = $request->all();

        $query = PieceBrand::search($input);
        $pieceBrands = $query->paginate(15);

        return response()->json($pieceBrands)->setCallback($request->input('callback'));
    }

    public function searchPieces(Request $request) {
        $full_text = $request->get("full_text");
        $types = Array("HEAD", "TOP", "BOTTOM", "FEET");

        $input = Array(
            "full_text" => $full_text,
            "types" => $types
        );

        $query = Piece::search($input)->with('user', 'category', 'brand')->orderBy('created_at', 'desc');
        $pieces = $query->paginate(15);
        $pieces->setPath($request->url());
        $pieces->getCollection()->shuffle();

        return response()->json($pieces)->setCallback($request->input('callback'));
    }
}