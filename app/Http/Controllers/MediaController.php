<?php namespace App\Http\Controllers;

use App\Models\Outfit;
use Aws\CloudFront\Exception\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use App\Models\User;
use App\Models\Piece;
use App\Models\PieceCategory;
use App\Models\PieceBrand;
use App\Facades\CloudStorage;
use \stdClass;
use Validator;

class MediaController extends Controller {

    var $sizes = array(
        "original" => "750",
        "medium" => "375",
        "small" => "192",
        "thumbnail" => "96"
    );

    public function updatePiece(Request $request) {
        $pieces_data_v = $request->get("pieces");
        $validator_pieces = array();

        // only shop can update, no to check shop vs shopper
        foreach ($pieces_data_v as $piece_key => $piece_data) {
            // Shop only: check if category, price and quantity (if shop) is present
            $validator_piece = Validator::make($piece_data, [
                'num_images' => 'required|numeric|min:1|max:4',
                'category' => 'required|max:255',
                'name' => 'required|max:255',
                'brand' => 'required|max:255',
                'description' => 'max:255',
                'size' => 'required|max:255',
                'quantity' => 'required|max:255',
                'price' => 'required|numeric|min:10'
            ]);

            if ($validator_piece->fails()) {
                $validator_pieces[$piece_key] = $validator_piece->messages();
            }
        }

        $validator_messages = null;

        if (!empty($validator_pieces)) {
            $validator_messages['pieces'] = $validator_pieces;
        }

        if ($validator_messages != null) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator_messages
            );

            return response()->json($error)->setCallback($request->input('callback'));
        } else {

            try {
                // retrieve user
                $user = User::find($request->get("user_id"));

                //////////////////////////////////////////
                /////////// Delete Old Images ////////////
                //////////////////////////////////////////

                $pieces_data = $request->get("pieces");
                $bucket_path = "pieces/" . $user->id . "/";

                foreach ($pieces_data as $piece_key => $piece_data) {
                    $existing_piece = Piece::find($piece_data["id"]);
                    $pieceImages = json_decode($existing_piece->images);

                    foreach ($pieceImages->images as $image) {
                        $stringArray = explode("/", $image->original);
                        $originalFilename = $stringArray[count($stringArray) - 1];

                        $stringArray = explode("/", $image->medium);
                        $mediumFilename = $stringArray[count($stringArray) - 1];

                        $stringArray = explode("/", $image->small);
                        $smallFilename = $stringArray[count($stringArray) - 1];

                        $stringArray = explode("/", $image->thumbnail);
                        $thumbnailFilename = $stringArray[count($stringArray) - 1];

                        $objectArray = array(
                            array(
                                // Key is required
                                'Key' => $bucket_path . $originalFilename
                            ),
                            array(
                                // Key is required
                                'Key' => $bucket_path . $mediumFilename
                            ),
                            array(
                                // Key is required
                                'Key' => $bucket_path . $smallFilename
                            ),
                            array(
                                // Key is required
                                'Key' => $bucket_path . $thumbnailFilename
                            )
                        );

                        // delete object using cloudstorage service provider
                        CloudStorage::deleteObjects($objectArray);
                    }
                }

                //////////////////////////////////////////
                //////////////// Pieces //////////////////
                //////////////////////////////////////////

                // retrieve pieces info
                $pieces_data = $request->get("pieces");

                // create individual pieces
                foreach ($pieces_data as $piece_key => $piece_data) {
                    $existing_piece = Piece::find($piece_data["id"]);

                    $existing_piece->name = $piece_data["name"];
                    $existing_piece->description = $piece_data["description"];

                    if (isset($piece_data["category"]) && $piece_data["category"] != "") {
                        $existing_piece->category()->associate(PieceCategory::search(array("name" => $piece_data["category"]))->first());
                    }

                    if (isset($piece_data["brand"]) && $piece_data["brand"] != "") {
                        $existing_brand = PieceBrand::search(array("name" => $piece_data["brand"]))->first();
                        if ($existing_brand) {
                            $existing_piece->brand()->associate($existing_brand);
                        } else {
                            // create new entry in piece brands
                            $new_brand = new PieceBrand();
                            $new_brand->name = $piece_data["brand"];
                            $new_brand->save();

                            $existing_piece->brand()->associate($new_brand);
                        }
                    }

                    $piece_sizes = explode("/", $piece_data["size"]);

                    $existing_piece->size = json_encode($piece_sizes);
                    $existing_piece->type = $piece_data["type"];
                    $existing_piece->is_dress = $piece_data["is_dress"];
                    $existing_piece->position = $this->getPosition($piece_data["type"]);
                    $existing_piece->height = $piece_data["height"];
                    $existing_piece->width = $piece_data["width"];
                    $existing_piece->aspectRatio = $piece_data["width"] / $piece_data["height"];

                    if (isset($piece_data["quantity"])) {
                        $existing_piece->quantity = json_encode($piece_data["quantity"]);
                    }

                    $existing_piece->price = $piece_data["price"];

                    $num_images = $piece_data["num_images"];

                    $media = new stdClass();
                    $piece_images = array();

                    for ($i = 0; $i < $num_images; $i++) {
                        // images of the piece including cover
                        // 4 different sizes: original (w: 750px), medium (w: 375px), small (w: 192px), thumbnail (w: 96)
                        $piece_image = new stdClass();

                        foreach ($this->sizes as $size_key => $size_value) {
                            $file_name = "piece_" . $piece_key . "_" . $i;
                            $file_name_size_time = $user->id . "_piece_" . $piece_key . "_" . $i . "_" . $size_key . "_" . time() . ".jpg";
                            $file_path = storage_path() . "/uploads/" . $file_name_size_time;

                            $containerPath = "/pieces/" . $user->id;

                            $piece_image->$size_key = CloudStorage::putObject($request->file($file_name), $size_value, $file_path, $containerPath, $file_name_size_time);

                            if ($i == 0 && $size_key == "original") {
                                // only $size_key original has the best quality
                                $media->cover = $piece_image->$size_key;
                            }
                        }

                        $piece_images[] = $piece_image;
                    }

                    $media->images = $piece_images;

                    $existing_piece->images = json_encode($media);
                    $existing_piece->user()->associate($user);
                    $existing_piece->save(); // remember to save

                    $json = array(
                        "status" => "200",
                        "message" => "success",
                        "data" => $existing_piece
                    );

                    return response()->json($json)->setCallback($request->input('callback'));
                }
            } catch (Exception $e) {
                Log::Error("Exception caught: \n" . $e->getMessage());

                $json = array(
                    "status" => "500",
                    "message" => "exception",
                    "exception" => $e->getMessage()
                );

                return response()->json($json)->setCallback($request->input('callback'));
            }
        }
    }

    public function uploadPiece(Request $request) {
        $isShop = stripos(Auth::user()->shoppable_type, 'shopper') === false;

        $pieces_data_v = $request->get("pieces");
        $validator_pieces = array();

        foreach ($pieces_data_v as $piece_key => $piece_data) {
            if ($isShop) {
                // Shop only: check if category, price and quantity (if shop) is present
                $validator_piece = Validator::make($piece_data, [
                    'num_images' => 'required|numeric|min:1|max:4',
                    'category' => 'required|max:255',
                    'name' => 'required|max:255',
                    'brand' => 'required|max:255',
                    'description' => 'max:255',
                    'size' => 'required|max:255',
                    'quantity' => 'required|max:255',
                    'price' => 'required|numeric|min:10'
                ]);
            } else {
                $validator_piece = Validator::make($piece_data, [
                    'num_images' => 'required|numeric|min:1|max:4',
                    'category' => 'required|max:255',
                    'name' => 'max:255',
                    'brand' => 'max:255',
                    'description' => 'max:255'
                ]);
            }

            if ($validator_piece->fails()) {
                $validator_pieces[$piece_key] = $validator_piece->messages();
            }
        }

        $validator_messages = null;

        if (!empty($validator_pieces)) {
            $validator_messages['pieces'] = $validator_pieces;
        }

        if ($validator_messages != null) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator_messages
            );

            return response()->json($error)->setCallback($request->input('callback'));
        } else {
            try {

                // retrieve user
                $user = User::find($request->get("user_id"));

                //////////////////////////////////////////
                //////////////// Pieces //////////////////
                //////////////////////////////////////////

                // retrieve pieces info
                $pieces_data = $request->get("pieces");

                // create individual pieces
                foreach ($pieces_data as $piece_key => $piece_data) {
                    $new_piece = new Piece();

                    $new_piece->name = $piece_data["name"];
                    $new_piece->description = $piece_data["description"];

                    if (isset($piece_data["category"]) && $piece_data["category"] != "") {
                        $new_piece->category()->associate(PieceCategory::search(array("name" => $piece_data["category"]))->first());
                    }

                    if (isset($piece_data["brand"]) && $piece_data["brand"] != "") {
                        $existing_brand = PieceBrand::search(array("name" => $piece_data["brand"]))->first();
                        if ($existing_brand) {
                            $new_piece->brand()->associate($existing_brand);
                        } else {
                            // create new entry in piece brands
                            $new_brand = new PieceBrand();
                            $new_brand->name = $piece_data["brand"];
                            $new_brand->save();

                            $new_piece->brand()->associate($new_brand);
                        }
                    }

                    $piece_sizes = explode("/", $piece_data["size"]);

                    $new_piece->size = json_encode($piece_sizes);
                    $new_piece->type = $piece_data["type"];
                    $new_piece->is_dress = $piece_data["is_dress"];
                    $new_piece->position = $this->getPosition($piece_data["type"]);
                    $new_piece->height = $piece_data["height"];
                    $new_piece->width = $piece_data["width"];
                    $new_piece->aspectRatio = $piece_data["width"] / $piece_data["height"];

                    if (isset($piece_data["quantity"])) {
                        $new_piece->quantity = json_encode($piece_data["quantity"]);
                    }

                    $new_piece->price = $piece_data["price"];

                    $num_images = $piece_data["num_images"];

                    $media = new stdClass();
                    $piece_images = array();

                    for ($i = 0; $i < $num_images; $i++) {
                        // images of the piece including cover
                        // 4 different sizes: original (w: 750px), medium (w: 375px), small (w: 192px), thumbnail (w: 96)
                        $piece_image = new stdClass();

                        foreach ($this->sizes as $size_key => $size_value) {
                            $file_name = "piece_" . $piece_key . "_" . $i;
                            $file_name_size_time = $user->id . "_piece_" . $piece_key . "_" . $i . "_" . $size_key . "_" . time() . ".jpg";
                            $file_path = storage_path() . "/uploads/" . $file_name_size_time;

                            $containerPath = "/pieces/" . $user->id;

                            $piece_image->$size_key = CloudStorage::putObject($request->file($file_name), $size_value, $file_path, $containerPath, $file_name_size_time);

                            if ($i == 0 && $size_key == "original") {
                                // only $size_key original has the best quality
                                $media->cover = $piece_image->$size_key;
                            }
                        }

                        $piece_images[] = $piece_image;
                    }

                    $media->images = $piece_images;

                    $new_piece->images = json_encode($media);
                    $new_piece->user()->associate($user);
                    $new_piece->save(); // remember to save

                    $json = array(
                        "status" => "200",
                        "message" => "success",
                        "data" => $new_piece
                    );

                    return response()->json($json)->setCallback($request->input('callback'));
                }
            } catch (Exception $e) {
                Log::Error("Exception caught: \n" . $e->getMessage());

                $json = array(
                    "status" => "500",
                    "message" => "exception",
                    "exception" => $e->getMessage()
                );

                return response()->json($json)->setCallback($request->input('callback'));
            }
        }
    }

    public function uploadOutfit(Request $request) {
        $isShop = stripos(Auth::user()->shoppable_type, 'shopper') === false;

        // Validate the user input, check outfit desc and all pieces' info
        $validator_outfit = Validator::make($request->all(), [
            'description' => 'max:255'
        ]);

        $pieces_data_v = $request->get("pieces");
        $validator_pieces = array();

        foreach ($pieces_data_v as $piece_key => $piece_data) {
            if ($isShop) {
                // Shop only: check if category, price and quantity (if shop) is present
                $validator_piece = Validator::make($piece_data, [
                    'num_images' => 'required|numeric|min:1|max:4',
                    'category' => 'required|max:255',
                    'name' => 'required|max:255',
                    'brand' => 'required|max:255',
                    'description' => 'max:255',
                    'size' => 'required|max:255',
                    'quantity' => 'required|max:255',
                    'price' => 'required|numeric|min:10'
                ]);
            } else {
                $validator_piece = Validator::make($piece_data, [
                    'num_images' => 'required|min:1|max:4',
                    'category' => 'required|max:255',
                    'name' => 'max:255',
                    'brand' => 'max:255',
                    'description' => 'max:255'
                ]);
            }

            if ($validator_piece->fails()) {
                $validator_pieces[$piece_key] = $validator_piece->messages();
            }
        }

        $validator_messages = null;

        if ($validator_outfit->fails()) {
            $validator_messages['outfit'] = $validator_outfit->messages();
        }

        if (!empty($validator_pieces)) {
            $validator_messages['pieces'] = $validator_pieces;
        }

        if ($validator_messages != null) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator_messages
            );

            return response()->json($error)->setCallback($request->input('callback'));
        } else {
            // pass
            try {
                if ($request->hasFile("outfit")) {

                    // retrieve user
                    $user = User::find($request->get("user_id"));

                    //////////////////////////////////////////
                    //////////////// Outfit //////////////////
                    //////////////////////////////////////////

                    $media = new stdClass();
                    $outfit_image = new stdClass();

                    // create new outfit
                    $new_outfit = new Outfit();
                    $new_outfit->description = $request->get("description");
                    $new_outfit->height = $request->get("height");
                    $new_outfit->width = $request->get("width");

                    foreach ($this->sizes as $size_key => $size_value) {
                        $file_name_size_time = $user->id . "_outfit_" . $size_key . "_" . time() . ".jpg";
                        $file_path = storage_path() . "/uploads/" . $file_name_size_time;

                        $containerPath = "/outfits/" . $user->id;

                        $outfit_image->$size_key = CloudStorage::putObject($request->file("outfit"), $size_value, $file_path, $containerPath, $file_name_size_time);
                    }

                    $media->images = $outfit_image;
                    $new_outfit->images = json_encode($media);
                    $new_outfit->user()->associate($user);
                    $new_outfit->save();

                    //////////////////////////////////////////
                    //////////////// Pieces //////////////////
                    //////////////////////////////////////////

                    // retrieve pieces info
                    $pieces_data = $request->get("pieces");

                    // create individual pieces
                    foreach ($pieces_data as $piece_key => $piece_data) {
                        $new_piece = new Piece();

                        $new_piece->name = $piece_data["name"];
                        $new_piece->description = $piece_data["description"];

                        if (isset($piece_data["category"]) && $piece_data["category"] != "") {
                            $new_piece->category()->associate(PieceCategory::search(array("name" => $piece_data["category"]))->first());
                        }

                        if (isset($piece_data["brand"]) && $piece_data["brand"] != "") {
                            $existing_brand = PieceBrand::search(array("name" => $piece_data["brand"]))->first();
                            if ($existing_brand) {
                                $new_piece->brand()->associate($existing_brand);
                            } else {
                                // create new entry in piece brands
                                $new_brand = new PieceBrand();
                                $new_brand->name = $piece_data["brand"];
                                $new_brand->save();

                                $new_piece->brand()->associate($new_brand);
                            }
                        }

                        $piece_sizes = explode("/", $piece_data["size"]);

                        $new_piece->size = json_encode($piece_sizes);
                        $new_piece->type = $piece_data["type"];
                        $new_piece->is_dress = $piece_data["is_dress"];
                        $new_piece->position = $this->getPosition($piece_data["type"]);
                        $new_piece->height = $piece_data["height"];
                        $new_piece->width = $piece_data["width"];
                        $new_piece->aspectRatio = $piece_data["width"] / $piece_data["height"];

                        if (isset($piece_data["quantity"])) {
                            $new_piece->quantity = json_encode($piece_data["quantity"]);
                            $new_outfit->purchasable = true;
                        }

                        $new_piece->price = $piece_data["price"];

                        $num_images = $piece_data["num_images"];

                        $media = new stdClass();
                        $piece_images = array();

                        for ($i = 0; $i < $num_images; $i++) {
                            // images of the piece including cover
                            // 4 different sizes: original (w: 750px), medium (w: 375px), small (w: 192px), thumbnail (w: 96)
                            $piece_image = new stdClass();

                            foreach ($this->sizes as $size_key => $size_value) {
                                $file_name = "piece_" . $piece_key . "_" . $i;
                                $file_name_size_time = $user->id . "_piece_" . $piece_key . "_" . $i . "_" . $size_key . "_" . time() . ".jpg";
                                $file_path = storage_path() . "/uploads/" . $file_name_size_time;

                                $containerPath = "/pieces/" . $user->id;

                                $piece_image->$size_key = CloudStorage::putObject($request->file($file_name), $size_value, $file_path, $containerPath, $file_name_size_time);

                                if ($i == 0 && $size_key == "original") {
                                    // only $size_key original has the best quality
                                    $media->cover = $piece_image->$size_key;
                                }
                            }

                            $piece_images[] = $piece_image;
                        }

                        $media->images = $piece_images;

                        $new_piece->images = json_encode($media);
                        $new_piece->user()->associate($user);
                        $new_piece->save(); // remember to save

                        $new_outfit->pieces()->save($new_piece); // add piece to outfit
                    }

                    $new_outfit->save();

                    $json = array(
                        "status" => "200",
                        "message" => "success",
                        "data" => $new_outfit
                    );

                    return response()->json($json)->setCallback($request->input('callback'));
                } else {
                    throw new Exception("No files were uploaded");
                }
            } catch (Exception $e) {
                Log::Error("Exception caught: \n" . $e->getMessage());

                $json = array(
                    "status" => "500",
                    "message" => "exception",
                    "exception" => $e->getMessage()
                );

                return response()->json($json)->setCallback($request->input('callback'));
            }
        }
    }

    public function uploadSprucedOutfit(Request $request) {
        try {
            if ($request->hasFile("outfit")) {

                // retrieve posting user
                $postedByUser = User::find($request->get("created_by"));

                // retrieve credited from user
                $fromUser = User::find($request->get("from"));

                //////////////////////////////////////////
                //////////////// Outfit //////////////////
                //////////////////////////////////////////

                $media = new stdClass();
                $outfit_image = new stdClass();

                // create new outfit
                $new_outfit = new Outfit();
                $new_outfit->description = $request->get("description");
                $new_outfit->height = $request->get("height");
                $new_outfit->width = $request->get("width");
                $new_outfit->inspiredBy()->associate($fromUser); // inspired by fromUser

                foreach ($this->sizes as $size_key => $size_value) {
                    $file_name_size_time = $postedByUser->id . "_outfit_" . $size_key . "_" . time() . ".jpg";
                    $file_path = storage_path() . "/uploads/" . $file_name_size_time;

                    $containerPath = "/outfits/" . $postedByUser->id;

                    $outfit_image->$size_key = CloudStorage::putObject($request->file("outfit"), $size_value, $file_path, $containerPath, $file_name_size_time);
                }

                $media->images = $outfit_image;
                $new_outfit->images = json_encode($media);
                $new_outfit->user()->associate($postedByUser);
                $new_outfit->save();

                //////////////////////////////////////////
                //////////////// Pieces //////////////////
                //////////////////////////////////////////

                // retrieve pieces info
                $pieces_data = $request->get("pieces");
                $pieces = Piece::whereIn('id', $pieces_data)->get();

                foreach ($pieces as $piece) {
                    // many to many assignment
                    $new_outfit->pieces()->save($piece);

                    if (isset($piece->quantity)) {
                        $new_outfit->purchasable = true;
                    }
                }

                $new_outfit->save();
                $outfit = Outfit::with('pieces.user')->find($new_outfit->id);

                $json = array(
                    "status" => "200",
                    "message" => "success",
                    "outfit" => $outfit
                );

                return response()->json($json)->setCallback($request->input('callback'));

            } else {
                throw new Exception("No files were uploaded");
            }
        } catch (Exception $e) {
            Log::Error("Exception caught: \n" . $e->getMessage());

            $json = array(
                "status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );

            return response()->json($json)->setCallback($request->input('callback'));
        }
    }

    // helper methods
    private function getPosition($type) {
        try {
            switch($type) {
                case "HEAD":
                    return 1;
                case "TOP":
                    return 2;
                case "BOTTOM":
                    return 3;
                case "FEET":
                    return 4;
                default:
                    throw new Exception("Unknown type");
            }
        } catch(Exception $e) {
            Log::Error("Exception caught: \n" . $e->getMessage());
        }
    }
}