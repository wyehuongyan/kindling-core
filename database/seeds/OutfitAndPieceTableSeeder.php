<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Piece;
use App\Models\Outfit;

class OutfitAndPieceTableSeeder extends Seeder {

    // TODO: Insert height width and aspectRatio for Piece
    // TODO: Insert height for Outfit

    public function run()
    {
        // empty 3 tables
        DB::table('pieces')->delete();
        DB::table('outfits')->delete();
        DB::table('pieces_outfits')->delete();

        $user = User::find(1);

        // create the pieces first

        // 1
        $piece_1 = new Piece();
        $piece_1->name = "Piece 1";
        $piece_1->description = "Example Piece Description 1";
        $piece_1->type = "HEAD";
        $piece_1->position = "1";
        $piece_1->height = 400.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 400.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_1.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_1.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_1.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_1.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_1.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_1.jpg";

        $media->images = array($image);

        $piece_1->images = json_encode($media);
        $piece_1->save();

        $piece_1->user()->associate($user);
        $piece_1->save();

        // 2

        $piece_2 = new Piece();
        $piece_2->name = "Piece 2";
        $piece_2->description = "Example Piece Description 2";
        $piece_2->type = "TOP";
        $piece_2->position = "2";
        $piece_2->height = 600.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 600.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_2.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_2.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_2.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_2.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_2.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_2.jpg";

        $media->images = array($image);

        $piece_2->images = json_encode($media);
        $piece_2->save();

        $piece_2->user()->associate($user);
        $piece_2->save();

        // 3

        $piece_3 = new Piece();
        $piece_3->name = "Piece 3";
        $piece_3->description = "Example Piece Description 3";
        $piece_3->type = "BOTTOM";
        $piece_3->position = "3";
        $piece_3->height = 334.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 334.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_3.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_3.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_3.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_3.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_3.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/test_3.jpg";

        $media->images = array($image);

        $piece_3->images = json_encode($media);
        $piece_3->save();

        $piece_3->user()->associate($user);
        $piece_3->save();

        // create 3 outfits
        // outfit 1: piece 1 & 2
        // outfit 2: piece 1 & 3
        // outfit 3: piece 2 & 3

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "Example Outfit 1";
        $outfit_1->description = "Example Outfit Description 1";
        $outfit_1->images = "https://sprubixtest.s3.amazonaws.com/outfits/1/outfit_1.jpg";
        $outfit_1->height = "1000";
        $outfit_1->width = "750";
        $outfit_1->save();
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "Example Outfit 2";
        $outfit_2->description = "Example Outfit Description 2";
        $outfit_2->images = "https://sprubixtest.s3.amazonaws.com/outfits/1/outfit_2.jpg";
        $outfit_2->height = "734";
        $outfit_2->width = "750";
        $outfit_2->save();
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_1);
        $outfit_2->pieces()->save($piece_3);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "Example Outfit 3";
        $outfit_3->description = "Example Outfit Description 3";
        $outfit_3->images = "https://sprubixtest.s3.amazonaws.com/outfits/1/outfit_3.jpg";
        $outfit_3->height = "934";
        $outfit_3->width = "750";
        $outfit_3->save();
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_2);
        $outfit_3->pieces()->save($piece_3);

    }
}