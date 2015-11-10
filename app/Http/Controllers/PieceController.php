<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Piece;
use App\Models\PieceCategory;
use App\Models\PieceBrand;
use Validator;
use Log;

class PieceController extends Controller {
    public function pieces(Request $request) {
        $input = $request->all();

        if(!isset($input['full_text'])) {
            $query = Piece::search($input)->with('user.shoppable', 'category', 'brand')->orderBy('created_at', 'desc');
        } else {
            $query = Piece::search($input)->with('user.shoppable', 'category', 'brand');
        }

        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function piecesByIds(Request $request) {
        $ids = $request->get("ids");

        $query = Piece::with('user.shoppable')->whereIn('id', $ids);
        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function userPieces(Request $request, User $user) {
        // return pieces belonging to user

        //$query = $user->pieces()->withTrashed()->with('user');
        $query = $user->pieces()->with('user.shoppable', 'category', 'brand')->orderBy('created_at', 'desc');
        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }

    public function userLowStockPieces(Request $request, User $user) {
        $pieces = $user->pieces()->with('user.shoppable', 'category', 'brand')->get();
        $lowStockPieces = array();

        foreach($pieces as $piece) {
            $quantity = json_decode($piece->quantity);

            foreach($quantity as $key => $value) {
                if($value <= $user->shoppable->low_stock_limit) {
                    $lowStockPieces[] = $piece;

                    break;
                }
            }
        }

        return response()->json($lowStockPieces)->setCallback($request->input('callback'));
    }

    public function updateLowStockLimit(Request $request, User $user) {
        $validator = Validator::make($request->all(), [
            'low_stock_limit' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator->messages()
            );

            return response()->json($error)->setCallback($request->input('callback'));
        } else {
            // Pass
            $user->shoppable->low_stock_limit = (int)$request->get("low_stock_limit");
            $user->shoppable->save();

            $json = array(
                "status" => "200",
                "message" => "success",
                "data" => $user
            );

            return response()->json($json)->setCallback($request->input('callback'));
        }
    }

    public function peoplePieces(Request $request) {
        // return pieces of promoted/popular users

        $user = Auth::User();

        if(env('APP_ENV') != "production") {
            $peopleIds = ["5", "4", "1", "3", "2"];
        } else {
            $peopleIds = ["4", "15", "5", "14", "6", "13", "7", "12", "8", "11", "9", "10"];
        }

        $people = User::with('shoppable')->whereIn('id', $peopleIds)->orderByRaw('FIELD(`id`, '.implode(',', $peopleIds).')')->get()->map(function($people) use ($user) {
            $people->pieces = $people->pieces()->take(6)->get();
            $people->followed = $people->followers->contains($user->id);

            return $people;
        });

        return response()->json($people)->setCallback($request->input('callback'));
    }

    public function pieceOutfits(Request $request, Piece $piece) {
        // return outfits that this piece belongs to

        $query = $piece->outfits()->with('inspiredBy', 'user', 'pieces.user.shoppable', 'pieces.category', 'pieces.brand');
        $outfits = $query->paginate(15);

        return response()->json($outfits)->setCallback($request->input('callback'));
    }

    public function deletePiece(Request $request, Piece $piece) {
        if($piece->user->id == $request->get("owner_id")) {
            // if piece is a purchasable piece, mark all quantities as 0
            if(isset($piece->quantity)) {
                $quantity = json_decode($piece->quantity);

                foreach($quantity as $key => $value) {
                    $quantity->$key = "0";
                }

                $piece->quantity = json_encode($quantity);
                $piece->save();
            }

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
        $pieceType = $request->get("piece_type");

        if(isset($pieceType)) {
            switch($pieceType) {
                case "HEAD":
                    $pieceCategoryIds = ["1", "2"];
                    break;
                case "TOP":
                    $pieceCategoryIds = ["3", "4"];
                    break;
                case "BOTTOM":
                    $pieceCategoryIds = ["5", "6"];
                    break;
                case "FEET":
                    $pieceCategoryIds = ["7"];
                    break;
                default:
                    throw new \Exception("Invalid piece type.");
            }

            $pieceCategories = PieceCategory::whereIn('id', $pieceCategoryIds)->get();
        } else {
            $pieceCategories = PieceCategory::all();
        }

        return response()->json($pieceCategories)->setCallback($request->input('callback'));
    }

    public function pieceBrands(Request $request) {
        $input = $request->all();

        $query = PieceBrand::search($input);
        $pieceBrands = $query->paginate(15);

        return response()->json($pieceBrands)->setCallback($request->input('callback'));
    }

    public function pieceUser(Request $request, Piece $piece) {
        // return owner of this piece
        $user = $piece->user()->first();

        return response()->json($user)->setCallback($request->input('callback'));
    }

    public function searchPieces(Request $request) {
        $full_text = $request->get("full_text");
        $categoryId = $request->get("category_id");
        $types = Array("HEAD", "TOP", "BOTTOM", "FEET");

        if(!isset($categoryId)) {
            $input = Array(
                "full_text" => $full_text,
                "types" => $types
            );
        } else {
            $input = Array(
                "full_text" => $full_text,
                "types" => $types,
                "category_id" => $categoryId
            );
        }

        $query = Piece::search($input)->with('user.shoppable', 'category', 'brand')->where('deleted_at', '=', null)->orderBy('created_at', 'desc');

        $pieces = $query->paginate(15);

        return response()->json($pieces)->setCallback($request->input('callback'));
    }
}