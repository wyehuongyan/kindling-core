<?php namespace App\Http\Controllers;

use App\Models\Outfit;
use Aws\CloudFront\Exception\Exception;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Log;
use App\Models\User;
use App\Models\Piece;
use \stdClass;
use Imagick;

class MediaController extends Controller {
    // init S3
    var $bucket = "sprubixtest";
    var $sizes = array(
        "original" => "750",
        "medium" => "375",
        "small" => "192",
        "thumbnail" => "96"
    );

    public function uploadPiece(Request $request) {
        try {
            // init S3
            $client = S3Client::factory(array(
                'profile' => 'sprubix_s3',
                'region' => 'ap-southeast-1'
            ));

            // retrieve user
            $user = User::find($request->get("user_id"));

            //////////////////////////////////////////
            //////////////// Pieces //////////////////
            //////////////////////////////////////////

            // retrieve pieces info
            $pieces_data = $request->get("pieces");
            $bucket_path = $this->bucket . "/pieces/" . $user->id;

            // create individual pieces
            foreach ($pieces_data as $piece_key => $piece_data) {
                $new_piece = new Piece();

                $new_piece->name = $piece_data["name"];
                $new_piece->description = $piece_data["description"];
                $new_piece->category = $piece_data["category"];
                $new_piece->brand = $piece_data["brand"];
                $new_piece->size = $piece_data["size"];
                $new_piece->type = $piece_data["type"];
                $new_piece->position = $this->getPosition($piece_data["type"]);
                $new_piece->height = $piece_data["height"];
                $new_piece->width = $piece_data["width"];
                $new_piece->aspectRatio = $piece_data["width"] / $piece_data["height"];

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

                        //$request->file($file_name)->move($file_path);

                        // 1. resize
                        // 2. upload to s3
                        // 3. record url

                        $image = new Imagick();
                        $image->readImage($request->file($file_name));

                        // step 1
                        // even original has to be resized due to 6 plus uploading images > 750px width
                        $image = $this->resizeImage($size_value, $image);

                        $image->writeImage($file_path); // write to file for s3 upload later

                        // step 2
                        $result = $client->putObject(array(
                            'Bucket'     => $bucket_path,
                            'Key'        => $file_name_size_time,
                            'SourceFile' => $file_path,
                            'ACL'        => 'public-read'
                        ));

                        // step 3
                        $piece_image->$size_key = cdn("/pieces/" . $user->id . "/" . $file_name_size_time);

                        // only the first image is the cover
                        if($i == 0 && $size_key == "original") {
                            // only $size_key original has the best quality
                            $media->cover = cdn("/pieces/" . $user->id . "/" . $file_name_size_time);
                        }

                        unlink($file_path);
                    }

                    $piece_images[] = $piece_image;
                }

                $media->images = $piece_images;

                $new_piece->images = json_encode($media);
                $new_piece->user()->associate($user);
                $new_piece->save(); // remember to save
            }
        } catch (Exception $e) {
            Log::Error("Exception caught: \n" . $e->getMessage());

            return response()->json($e)->setCallback($request->input('callback'));
        }
    }

    public function uploadOutfit(Request $request) {
        try {
            if ($request->hasFile("outfit")) {
                // init S3
                $client = S3Client::factory(array(
                    'profile' => 'sprubix_s3',
                    'region' => 'ap-southeast-1'
                ));

                // retrieve user
                $user = User::find($request->get("user_id"));

                //////////////////////////////////////////
                //////////////// Outfit //////////////////
                //////////////////////////////////////////

                $bucket_path = $this->bucket . "/outfits/" . $user->id;

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

                    $image = new Imagick();
                    $image->readImage($request->file("outfit"));

                    // even original has to be resized due to 6 plus uploading images > 750px width
                    $image = $this->resizeImage($size_value, $image);

                    $image->writeImage($file_path); // write to file for s3 upload later

                    $result = $client->putObject(array(
                        'Bucket'     => $bucket_path,
                        'Key'        => $file_name_size_time,
                        'SourceFile' => $file_path,
                        'ACL'        => 'public-read'
                    ));

                    $outfit_image->$size_key = cdn("/outfits/" . $user->id . "/" . $file_name_size_time);

                    unlink($file_path);
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
                $bucket_path = $this->bucket . "/pieces/" . $user->id;

                // create individual pieces
                foreach ($pieces_data as $piece_key => $piece_data) {
                    $new_piece = new Piece();

                    $new_piece->name = $piece_data["name"];
                    $new_piece->description = $piece_data["description"];
                    $new_piece->category = $piece_data["category"];
                    $new_piece->brand = $piece_data["brand"];
                    $new_piece->size = $piece_data["size"];
                    $new_piece->type = $piece_data["type"];
                    $new_piece->position = $this->getPosition($piece_data["type"]);
                    $new_piece->height = $piece_data["height"];
                    $new_piece->width = $piece_data["width"];
                    $new_piece->aspectRatio = $piece_data["width"] / $piece_data["height"];

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

                            //$request->file($file_name)->move($file_path);

                            // 1. resize
                            // 2. upload to s3
                            // 3. record url

                            $image = new Imagick();
                            $image->readImage($request->file($file_name));

                            // step 1
                            // even original has to be resized due to 6 plus uploading images > 750px width
                            $image = $this->resizeImage($size_value, $image);

                            $image->writeImage($file_path); // write to file for s3 upload later

                            // step 2
                            $result = $client->putObject(array(
                                'Bucket'     => $bucket_path,
                                'Key'        => $file_name_size_time,
                                'SourceFile' => $file_path,
                                'ACL'        => 'public-read'
                            ));

                            // step 3
                            $piece_image->$size_key = cdn("/pieces/" . $user->id . "/" . $file_name_size_time);

                            // only the first image is the cover
                            if($i == 0 && $size_key == "original") {
                                // only $size_key original has the best quality
                                $media->cover = cdn("/pieces/" . $user->id . "/" . $file_name_size_time);
                            }

                            unlink($file_path);
                        }

                        $piece_images[] = $piece_image;
                    }

                    $media->images = $piece_images;

                    $new_piece->images = json_encode($media);
                    $new_piece->user()->associate($user);
                    $new_piece->save(); // remember to save

                    $new_outfit->pieces()->save($new_piece); // add piece to outfit
                }

                return response()->json($new_outfit)->setCallback($request->input('callback'));
            } else {
                throw new Exception("No files were uploaded");
            }
        } catch (Exception $e) {
            Log::Error("Exception caught: \n" . $e->getMessage());

            return response()->json($e)->setCallback($request->input('callback'));
        }
    }

    public function uploadSprucedOutfit(Request $request) {
        try {
            if ($request->hasFile("outfit")) {
                // init S3
                $client = S3Client::factory(array(
                    'profile' => 'sprubix_s3',
                    'region' => 'ap-southeast-1'
                ));

                // retrieve posting user
                $postedByUser = User::find($request->get("created_by"));

                // retrieve credited from user
                $fromUser = User::find($request->get("from"));

                //////////////////////////////////////////
                //////////////// Outfit //////////////////
                //////////////////////////////////////////

                $bucket_path = $this->bucket . "/outfits/" . $postedByUser->id;

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

                    $image = new Imagick();
                    $image->readImage($request->file("outfit"));

                    if($size_key != "original") { // only resize the non-originals
                        $image = $this->resizeImage($size_value, $image);
                    }

                    $image->writeImage($file_path); // write to file for s3 upload later

                    $result = $client->putObject(array(
                        'Bucket'     => $bucket_path,
                        'Key'        => $file_name_size_time,
                        'SourceFile' => $file_path,
                        'ACL'        => 'public-read'
                    ));

                    $outfit_image->$size_key = cdn("/outfits/" . $postedByUser->id . "/" . $file_name_size_time);

                    unlink($file_path);
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
                }

            } else {
                throw new Exception("No files were uploaded");
            }
        } catch (Exception $e) {
            Log::Error("Exception caught: \n" . $e->getMessage());

            return response()->json($e)->setCallback($request->input('callback'));
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

    private function resizeImage($size, $image)
    {
        $image->resizeImage($size, 0, Imagick::FILTER_LANCZOS, 1);

        return $image->getImage();
    }
}