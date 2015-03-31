<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Piece;

class PieceController extends Controller {
    public function pieces(Request $request) {
        $input = $request->all();

        $query = Piece::search($input);
        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function user_pieces(Request $request, User $user) {
        // return pieces belonging to user

        $query = $user->pieces();
        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }
}