<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Piece;
use App\Models\Outfit;
use App\Models\PieceCategory;
use App\Models\PieceBrand;

class OutfitAndPieceTableSeeder extends Seeder {

    // TODO: Insert height width and aspectRatio for Piece
    // TODO: Insert height for Outfit

    public function run()
    {
        if(env('APP_ENV') != "production") {
            // staging or local
            $this->staging();
        } else {
            // production
            $this->production();
        }
    }

    public function production() {
        // empty 3 tables
        DB::table('pieces')->truncate();
        DB::table('outfits')->truncate();
        DB::table('pieces_outfits')->truncate();

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 4 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(4); // find alice

        // create the pieces first

        // u4p1

        $piece_1 = new Piece();
        $piece_1->name = "Splendour Sunnie";
        $piece_1->description = "Sunglasses with black and silver frame.";
        $piece_1->brand()->associate(PieceBrand::find(25));
        $piece_1->size = json_encode(array("Free"));
        $piece_1->type = "HEAD";
        $piece_1->is_dress = false;
        $piece_1->position = "1";
        $piece_1->height = 265.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 265.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit01_head1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit01_head1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit01_head1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit01_head1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit01_head1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit01_head2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit01_head2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit01_head2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit01_head2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(1));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u4p2

        $piece_2 = new Piece();
        $piece_2->name = "Hustle Tank";
        $piece_2->description = "White tank top.";
        $piece_2->brand()->associate(PieceBrand::find(25));
        $piece_2->size = json_encode(array("M"));
        $piece_2->type = "TOP";
        $piece_2->is_dress = false;
        $piece_2->position = "2";
        $piece_2->height = 918.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 918.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit01_top1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit01_top1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit01_top2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(3));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u4p3

        $piece_3 = new Piece();
        $piece_3->name = "Stevie Deluxe Short";
        $piece_3->description = "Stevie deluxe denim short.";
        $piece_3->brand()->associate(PieceBrand::find(25));
        $piece_3->size = json_encode(array("10"));
        $piece_3->type = "BOTTOM";
        $piece_3->is_dress = false;
        $piece_3->position = "3";
        $piece_3->height = 508.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 508.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit01_bot2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(5));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u4p4

        $piece_4 = new Piece();
        $piece_4->name = "Arizona Sandal";
        $piece_4->description = "White sandal with a buckle or two.";
        $piece_4->brand()->associate(PieceBrand::find(9));
        $piece_4->size = json_encode(array("US 8"));
        $piece_4->type = "FEET";
        $piece_4->is_dress = false;
        $piece_4->position = "4";
        $piece_4->height = 401.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 401.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/4/user04_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/4/user04_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/4/user04_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/4/user04_outfit01_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(7));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u4p5

        $piece_5 = new Piece();
        $piece_5->name = "Basic Pocket T-shirt";
        $piece_5->description = "Navy striped basic pocket t-shirt";
        $piece_5->brand()->associate(PieceBrand::find(8));
        $piece_5->size = json_encode(array("M"));
        $piece_5->type = "TOP";
        $piece_5->is_dress = false;
        $piece_5->position = "2";
        $piece_5->height = 725.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 725.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit02_top1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit02_top1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/4/user04_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/4/user04_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/4/user04_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/4/user04_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/4/user04_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/4/user04_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/4/user04_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/4/user04_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(3));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u4p6

        $piece_6 = new Piece();
        $piece_6->name = "Belted Shorts";
        $piece_6->description = "White belted shorts.";
        $piece_6->brand()->associate(PieceBrand::find(8));
        $piece_6->size = json_encode(array("38"));
        $piece_6->type = "BOTTOM";
        $piece_6->is_dress = false;
        $piece_6->position = "3";
        $piece_6->height = 410.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 410.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/4/user04_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/4/user04_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/4/user04_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/4/user04_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/4/user04_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/4/user04_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/4/user04_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/4/user04_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(5));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u4p7

        $piece_7 = new Piece();
        $piece_7->name = "Lace Up Platform Sneaker";
        $piece_7->description = "White lace-up platform sneakers.";
        $piece_7->brand()->associate(PieceBrand::find(5));
        $piece_7->size = json_encode(array("US 8"));
        $piece_7->type = "FEET";
        $piece_7->is_dress = false;
        $piece_7->position = "4";
        $piece_7->height = 411.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 411.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/4/user04_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/4/user04_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/4/user04_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/4/user04_outfit02_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(7));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u4p8

        $piece_8 = new Piece();
        $piece_8->name = "Text Print Top";
        $piece_8->description = "Black text print top.";
        $piece_8->brand()->associate(PieceBrand::find(8));
        $piece_8->size = json_encode(array("M"));
        $piece_8->type = "TOP";
        $piece_8->is_dress = false;
        $piece_8->position = "2";
        $piece_8->height = 828.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 828.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit03_top1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit03_top1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/4/user04_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/4/user04_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/4/user04_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/4/user04_outfit03_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/4/user04_outfit03_top4.jpg");
        $additional_image_3->small = cdn("/pieces/4/user04_outfit03_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/4/user04_outfit03_top4.jpg");
        $additional_image_3->original = cdn("/pieces/4/user04_outfit03_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(3));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u4p9

        $piece_9 = new Piece();
        $piece_9->name = "Girlfriend Jeans";
        $piece_9->description = "Ankle-length jeans in washed denim with tapered legs.";
        $piece_9->brand()->associate(PieceBrand::find(34));
        $piece_9->size = json_encode(array("38"));
        $piece_9->type = "BOTTOM";
        $piece_9->is_dress = false;
        $piece_9->position = "3";
        $piece_9->height = 1246.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 1246.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/4/user04_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/4/user04_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/4/user04_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/4/user04_outfit03_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(5));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // u4p10

        $piece_10 = new Piece();
        $piece_10->name = "Go Higher Boots";
        $piece_10->description = "Brown leather material.";
        $piece_10->brand()->associate(PieceBrand::find(65));
        $piece_10->size = json_encode(array("38"));
        $piece_10->type = "FEET";
        $piece_10->is_dress = false;
        $piece_10->position = "4";
        $piece_10->height = 516.0;
        $piece_10->width = 750.0;
        $piece_10->aspectRatio = 750.0 / 516.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user04_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user04_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/4/user04_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/4/user04_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/4/user04_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/4/user04_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/4/user04_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/4/user04_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/4/user04_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/4/user04_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/4/user04_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/4/user04_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/4/user04_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/4/user04_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/4/user04_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/4/user04_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/4/user04_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_10->images = json_encode($media);

        $piece_10->category()->associate(PieceCategory::find(7));
        $piece_10->user()->associate($user);
        $piece_10->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3, 4
        // outfit 2: piece 5, 6, 7
        // outfit 3: piece 8, 9, 10

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 4 Outfit 1";
        $outfit_1->description = "Perfect outfit for travelling in summer.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/4/user04_outfit01.jpg");
        $image->small = cdn("/outfits/4/user04_outfit01.jpg");
        $image->medium = cdn("/outfits/4/user04_outfit01.jpg");
        $image->original = cdn("/outfits/4/user04_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "2092";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
        $outfit_1->pieces()->save($piece_4);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 4 Outfit 2";
        $outfit_2->description = "My day-to-day casual wear.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/4/user04_outfit02.jpg");
        $image->small = cdn("/outfits/4/user04_outfit02.jpg");
        $image->medium = cdn("/outfits/4/user04_outfit02.jpg");
        $image->original = cdn("/outfits/4/user04_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1546";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);
        $outfit_2->pieces()->save($piece_7);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 4 Outfit 3";
        $outfit_3->description = "An outfit for every day.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/4/user04_outfit03.jpg");
        $image->small = cdn("/outfits/4/user04_outfit03.jpg");
        $image->medium = cdn("/outfits/4/user04_outfit03.jpg");
        $image->original = cdn("/outfits/4/user04_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "2590";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);
        $outfit_3->pieces()->save($piece_10);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 5 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(5); // find bella

        // create the pieces first

        // u5p1

        $piece_1 = new Piece();
        $piece_1->name = "Floppy Wool Hat";
        $piece_1->description = "Felted wool hat with a wide brim.";
        $piece_1->brand()->associate(PieceBrand::find(9));
        $piece_1->size = json_encode(array("Free"));
        $piece_1->type = "HEAD";
        $piece_1->is_dress = false;
        $piece_1->position = "1";
        $piece_1->height = 292.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 292.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit01_head1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit01_head1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit01_head1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit01_head1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit01_head1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit01_head2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit01_head2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit01_head2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit01_head2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(2));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u5p2

        $piece_2 = new Piece();
        $piece_2->name = "Jersey Dress";
        $piece_2->description = "Short jersey dress with a slightly wider neckline.";
        $piece_2->brand()->associate(PieceBrand::find(9));
        $piece_2->size = json_encode(array("S"));
        $piece_2->type = "TOP";
        $piece_2->is_dress = true;
        $piece_2->position = "2";
        $piece_2->height = 1145.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 1145.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit01_top1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit01_top1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit01_top3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(4));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u5p3

        $piece_3 = new Piece();
        $piece_3->name = "Trainers";
        $piece_3->description = "Glittery trainers with a twill trim and rubber soles.";
        $piece_3->brand()->associate(PieceBrand::find(9));
        $piece_3->size = json_encode(array("36"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 403.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 403.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/5/user05_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/5/user05_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/5/user05_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/5/user05_outfit01_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u5p4

        $piece_4 = new Piece();
        $piece_4->name = "Button-down Collar Polo Shirt";
        $piece_4->description = "White cotton-blend fabric polo shirt.";
        $piece_4->brand()->associate(PieceBrand::find(43));
        $piece_4->size = json_encode(array("S"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 728.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 728.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit02_top1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit02_top1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/5/user05_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/5/user05_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/5/user05_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/5/user05_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u5p5

        $piece_5 = new Piece();
        $piece_5->name = "Textured Long Skirt";
        $piece_5->description = "Maroon skirt with side slit hem.";
        $piece_5->brand()->associate(PieceBrand::find(43));
        $piece_5->size = json_encode(array("S"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 1033.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 1033.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/5/user05_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/5/user05_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/5/user05_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/5/user05_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(6));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u5p6

        $piece_6 = new Piece();
        $piece_6->name = "Heatwave Matte Evening Sandal";
        $piece_6->description = "Beige matte evening strappy sandal.";
        $piece_6->brand()->associate(PieceBrand::find(23));
        $piece_6->size = json_encode(array("US 6"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 417.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 417.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/5/user05_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/5/user05_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/5/user05_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/5/user05_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u5p7

        $piece_7 = new Piece();
        $piece_7->name = "Cotton Rich Cropped Shell Top";
        $piece_7->description = "Navy crop top.";
        $piece_7->brand()->associate(PieceBrand::find(45));
        $piece_7->size = json_encode(array("US 8"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = false;
        $piece_7->position = "2";
        $piece_7->height = 566.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 566.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit03_top1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit03_top1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit03_top3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(3));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u5p8

        $piece_8 = new Piece();
        $piece_8->name = "Cotton Rich Wrap Asymmetrical Skirt";
        $piece_8->description = "Navy versatile skirt.";
        $piece_8->brand()->associate(PieceBrand::find(45));
        $piece_8->size = json_encode(array("US 8"));
        $piece_8->type = "BOTTOM";
        $piece_8->is_dress = false;
        $piece_8->position = "3";
        $piece_8->height = 1254.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 1254.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit03_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(6));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u5p9

        $piece_9 = new Piece();
        $piece_9->name = "Merlinda Wedges with Ankle Buckle";
        $piece_9->description = "Merlinda wedges and ankle buckle in black.";
        $piece_9->brand()->associate(PieceBrand::find(47));
        $piece_9->size = json_encode(array("36"));
        $piece_9->type = "FEET";
        $piece_9->is_dress = false;
        $piece_9->position = "4";
        $piece_9->height = 422.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 422.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user05_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user05_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/5/user05_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/5/user05_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/5/user05_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/5/user05_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/5/user05_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/5/user05_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/5/user05_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/5/user05_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/5/user05_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/5/user05_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/5/user05_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/5/user05_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/5/user05_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/5/user05_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/5/user05_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(7));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 5 Outfit 1";
        $outfit_1->description = "Greyish tone outfit for my grey days.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/5/user05_outfit01.jpg");
        $image->small = cdn("/outfits/5/user05_outfit01.jpg");
        $image->medium = cdn("/outfits/5/user05_outfit01.jpg");
        $image->original = cdn("/outfits/5/user05_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1840";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 5 Outfit 2";
        $outfit_2->description = "Some days, I just love to wear out the red long skirt.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/5/user05_outfit02.jpg");
        $image->small = cdn("/outfits/5/user05_outfit02.jpg");
        $image->medium = cdn("/outfits/5/user05_outfit02.jpg");
        $image->original = cdn("/outfits/5/user05_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "2178";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 5 Outfit 3";
        $outfit_3->description = "Black and navy outfit for the day!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/5/user05_outfit03.jpg");
        $image->small = cdn("/outfits/5/user05_outfit03.jpg");
        $image->medium = cdn("/outfits/5/user05_outfit03.jpg");
        $image->original = cdn("/outfits/5/user05_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "2240";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 6 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(6); // find cassandra

        // create the pieces first

        // u6p1

        $piece_1 = new Piece();
        $piece_1->name = "Flag Scoop Neck Tee";
        $piece_1->description = "Short sleeve jersey with scoop neck.";
        $piece_1->brand()->associate(PieceBrand::find(6));
        $piece_1->size = json_encode(array("M"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 560.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 560.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit01_top1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit01_top1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/6/user06_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/6/user06_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/6/user06_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/6/user06_outfit01_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/6/user06_outfit01_top4.jpg");
        $additional_image_3->small = cdn("/pieces/6/user06_outfit01_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/6/user06_outfit01_top4.jpg");
        $additional_image_3->original = cdn("/pieces/6/user06_outfit01_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u6p2

        $piece_2 = new Piece();
        $piece_2->name = "Ankle Jeans";
        $piece_2->description = "Ankle-length denim jeans with a zip at the hems.";
        $piece_2->brand()->associate(PieceBrand::find(9));
        $piece_2->size = json_encode(array("38"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 1174.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 1174.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit01_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/6/user06_outfit01_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/6/user06_outfit01_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/6/user06_outfit01_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/6/user06_outfit01_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(5));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u6p3

        $piece_3 = new Piece();
        $piece_3->name = "696 New Balance";
        $piece_3->description = "Suede and mesh.";
        $piece_3->brand()->associate(PieceBrand::find(48));
        $piece_3->size = json_encode(array("US 8"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 320.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 320.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/6/user06_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/6/user06_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/6/user06_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/6/user06_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/6/user06_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/6/user06_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/6/user06_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/6/user06_outfit01_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u6p4

        $piece_4 = new Piece();
        $piece_4->name = "Don't Ask Why Crop Top";
        $piece_4->description = "Designed in one size to fuse the effortless street style.";
        $piece_4->brand()->associate(PieceBrand::find(5));
        $piece_4->size = json_encode(array("One Size"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 554.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 554.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit02_top1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit02_top1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit02_top2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u6p5

        $piece_5 = new Piece();
        $piece_5->name = "Lovestruck Short";
        $piece_5->description = "High waisted distressed short with frayed rolled hem.";
        $piece_5->brand()->associate(PieceBrand::find(25));
        $piece_5->size = json_encode(array("10"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 455.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 455.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit02_bot2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(5));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u6p6

        $piece_6 = new Piece();
        $piece_6->name = "Black 'Helen' Tassle Pumps";
        $piece_6->description = "Black suedette slipper pumps with faux fur lining.";
        $piece_6->brand()->associate(PieceBrand::find(22));
        $piece_6->size = json_encode(array("UK 6"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 451.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 451.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/6/user06_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/6/user06_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/6/user06_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/6/user06_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/6/user06_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/6/user06_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/6/user06_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/6/user06_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u6p7

        $piece_7 = new Piece();
        $piece_7->name = "Peace Canyon Muscle Tank Top";
        $piece_7->description = "Comfortable dry-fit fabric.";
        $piece_7->brand()->associate(PieceBrand::find(2));
        $piece_7->size = json_encode(array("M"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = false;
        $piece_7->position = "2";
        $piece_7->height = 817.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 817.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit03_top1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit03_top1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/6/user06_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/6/user06_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/6/user06_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/6/user06_outfit03_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/6/user06_outfit03_top4.jpg");
        $additional_image_3->small = cdn("/pieces/6/user06_outfit03_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/6/user06_outfit03_top4.jpg");
        $additional_image_3->original = cdn("/pieces/6/user06_outfit03_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(3));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u6p8

        $piece_8 = new Piece();
        $piece_8->name = "Lyocell Shorts";
        $piece_8->description = "Shorts with a tie belt and side pockets.";
        $piece_8->brand()->associate(PieceBrand::find(34));
        $piece_8->size = json_encode(array("38"));
        $piece_8->type = "BOTTOM";
        $piece_8->is_dress = false;
        $piece_8->position = "3";
        $piece_8->height = 525.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 525.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/6/user06_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/6/user06_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/6/user06_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/6/user06_outfit03_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(5));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u6p9

        $piece_9 = new Piece();
        $piece_9->name = "Suede Slip-on Sneakers";
        $piece_9->description = "Without laces, ribbon detail, rubber sole.";
        $piece_9->brand()->associate(PieceBrand::find(43));
        $piece_9->size = json_encode(array("38"));
        $piece_9->type = "FEET";
        $piece_9->is_dress = false;
        $piece_9->position = "4";
        $piece_9->height = 320.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 320.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/6/user06_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/6/user06_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/6/user06_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/6/user06_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/6/user06_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/6/user06_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/6/user06_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/6/user06_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/6/user06_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/6/user06_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/6/user06_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/6/user06_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/6/user06_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/6/user06_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/6/user06_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/6/user06_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/6/user06_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(7));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 6 Outfit 1";
        $outfit_1->description = "Rocking with colours!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/6/user06_outfit01.jpg");
        $image->small = cdn("/outfits/6/user06_outfit01.jpg");
        $image->medium = cdn("/outfits/6/user06_outfit01.jpg");
        $image->original = cdn("/outfits/6/user06_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "2054";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 6 Outfit 2";
        $outfit_2->description = "Let the good times roll, oh yeah!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/6/user06_outfit02.jpg");
        $image->small = cdn("/outfits/6/user06_outfit02.jpg");
        $image->medium = cdn("/outfits/6/user06_outfit02.jpg");
        $image->original = cdn("/outfits/6/user06_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1460";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 6 Outfit 3";
        $outfit_3->description = "Peace-out~";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/6/user06_outfit03.jpg");
        $image->small = cdn("/outfits/6/user06_outfit03.jpg");
        $image->medium = cdn("/outfits/6/user06_outfit03.jpg");
        $image->original = cdn("/outfits/6/user06_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1662";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 7 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(7); // find danielle

        // create the pieces first

        // u7p1

        $piece_1 = new Piece();
        $piece_1->name = "Rib-knit Jumper";
        $piece_1->description = "Long sleeves knit jumper in a cotton blend with slits in the sides.";
        $piece_1->brand()->associate(PieceBrand::find(9));
        $piece_1->size = json_encode(array("S"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 877.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 877.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit01_top1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit01_top1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/7/user07_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/7/user07_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/7/user07_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/7/user07_outfit01_top2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u7p2

        $piece_2 = new Piece();
        $piece_2->name = "Patterned Skirt";
        $piece_2->description = "Knee-length skirt with patterned weave with and a rounded hem.";
        $piece_2->brand()->associate(PieceBrand::find(9));
        $piece_2->size = json_encode(array("36"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 877.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 877.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/7/user07_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/7/user07_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/7/user07_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/7/user07_outfit01_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/7/user07_outfit01_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/7/user07_outfit01_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/7/user07_outfit01_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/7/user07_outfit01_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(6));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u7p3

        $piece_3 = new Piece();
        $piece_3->name = "Platform Sandals";
        $piece_3->description = "Platform suede sandals with a metal buckle. ";
        $piece_3->brand()->associate(PieceBrand::find(9));
        $piece_3->size = json_encode(array("36"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 404.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 404.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/7/user07_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/7/user07_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/7/user07_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/7/user07_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/7/user07_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/7/user07_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/7/user07_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/7/user07_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/7/user07_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/7/user07_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/7/user07_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/7/user07_outfit01_shoes4.jpg");

        $media->images = array($image);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u7p4

        $piece_4 = new Piece();
        $piece_4->name = "Hampson Hat";
        $piece_4->description = "Hampson hat.";
        $piece_4->brand()->associate(PieceBrand::find(25));
        $piece_4->size = json_encode(array("Free"));
        $piece_4->type = "HEAD";
        $piece_4->is_dress = false;
        $piece_4->position = "1";
        $piece_4->height = 305.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 305.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit02_head1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit02_head1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit02_head1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit02_head1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit02_head1.jpg");

        $media->images = array($image);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(2));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u6p5

        $piece_5 = new Piece();
        $piece_5->name = "Willow Off The Shoulder Dress";
        $piece_5->description = "Willow off the shoulder dress.";
        $piece_5->brand()->associate(PieceBrand::find(25));
        $piece_5->size = json_encode(array("M"));
        $piece_5->type = "TOP";
        $piece_5->is_dress = true;
        $piece_5->position = "2";
        $piece_5->height = 922.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 922.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit02_top1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit02_top1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/7/user07_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/7/user07_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/7/user07_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/7/user07_outfit02_top2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(4));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u7p6

        $piece_6 = new Piece();
        $piece_6->name = "Tessa Covered Block Heels";
        $piece_6->description = "The perfect pair of shoes for warm weather events.";
        $piece_6->brand()->associate(PieceBrand::find(27));
        $piece_6->size = json_encode(array("36"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 399.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 399.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/7/user07_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/7/user07_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/7/user07_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/7/user07_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/7/user07_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/7/user07_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/7/user07_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/7/user07_outfit02_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u6p7

        $piece_7 = new Piece();
        $piece_7->name = "Catch The Sun Playsuit";
        $piece_7->description = "Lace back playsuit.";
        $piece_7->brand()->associate(PieceBrand::find(25));
        $piece_7->size = json_encode(array("M"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = true;
        $piece_7->position = "2";
        $piece_7->height = 1049.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 1049.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit03_top1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit03_top1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/7/user07_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/7/user07_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/7/user07_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/7/user07_outfit03_top2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(4));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u6p8

        $piece_8 = new Piece();
        $piece_8->name = "Poppy Minimal Heels";
        $piece_8->description = "Classy and stylish black minimal heels. ";
        $piece_8->brand()->associate(PieceBrand::find(27));
        $piece_8->size = json_encode(array("36"));
        $piece_8->type = "FEET";
        $piece_8->is_dress = false;
        $piece_8->position = "4";
        $piece_8->height = 433.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 433.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/7/user07_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/7/user07_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/7/user07_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/7/user07_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/7/user07_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/7/user07_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/7/user07_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/7/user07_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/7/user07_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/7/user07_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/7/user07_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/7/user07_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/7/user07_outfit03_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(7));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 7 Outfit 1";
        $outfit_1->description = "Knit top and my red pattern skirt.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/7/user07_outfit01.jpg");
        $image->small = cdn("/outfits/7/user07_outfit01.jpg");
        $image->medium = cdn("/outfits/7/user07_outfit01.jpg");
        $image->original = cdn("/outfits/7/user07_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "2156";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 7 Outfit 2";
        $outfit_2->description = "Great outfit for picnic.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/7/user07_outfit02.jpg");
        $image->small = cdn("/outfits/7/user07_outfit02.jpg");
        $image->medium = cdn("/outfits/7/user07_outfit02.jpg");
        $image->original = cdn("/outfits/7/user07_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1626";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 7 Outfit 3";
        $outfit_3->description = "Just what I wear everyday.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/7/user07_outfit03.jpg");
        $image->small = cdn("/outfits/7/user07_outfit03.jpg");
        $image->medium = cdn("/outfits/7/user07_outfit03.jpg");
        $image->original = cdn("/outfits/7/user07_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1482";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 8 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(8); // find elsa

        // create the pieces first

        // u8p1

        $piece_1 = new Piece();
        $piece_1->name = "DENVER Sweater";
        $piece_1->description = "Comfortable sweater in lavender colour.";
        $piece_1->brand()->associate(PieceBrand::find(94));
        $piece_1->size = json_encode(array("Free"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 727.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 727.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit01_top1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit01_top1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit01_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit01_top4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit01_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit01_top4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit01_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u8p2

        $piece_2 = new Piece();
        $piece_2->name = "Checkered Mini Skirt";
        $piece_2->description = "Red checkered mini skirt with fake buttons.";
        $piece_2->brand()->associate(PieceBrand::find(94));
        $piece_2->size = json_encode(array("Free"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 630.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 630.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit01_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit01_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit01_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit01_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit01_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit01_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit01_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit01_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit01_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(6));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u8p3

        $piece_3 = new Piece();
        $piece_3->name = "Heart Platform Shoes";
        $piece_3->description = "Platform shoes with heart shapes decorated along the sides.";
        $piece_3->brand()->associate(PieceBrand::find(101));
        $piece_3->size = json_encode(array("M"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 397.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 397.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit01_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u8p4

        $piece_4 = new Piece();
        $piece_4->name = "High Neck Knit Top";
        $piece_4->description = "There are many other colours too. Just love the wine colour so much!";
        $piece_4->brand()->associate(PieceBrand::find(94));
        $piece_4->size = json_encode(array("Free"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 803.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 803.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit02_top1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit02_top1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u8p5

        $piece_5 = new Piece();
        $piece_5->name = "Faux Leather Mini Skirt";
        $piece_5->description = "Black colour faux leather mini skirt.";
        $piece_5->brand()->associate(PieceBrand::find(94));
        $piece_5->size = json_encode(array("M"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 676.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 676.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(6));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u8p6

        $piece_6 = new Piece();
        $piece_6->name = "Buckle Boots";
        $piece_6->description = "Black colour heeled boots with a buckle design across as the belt.";
        $piece_6->brand()->associate(PieceBrand::find(101));
        $piece_6->size = json_encode(array("M"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 408.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 408.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u8p7

        $piece_7 = new Piece();
        $piece_7->name = "Mickey Sweater";
        $piece_7->description = "80's half-zipped sweater featuring Mickey.";
        $piece_7->brand()->associate(PieceBrand::find(101));
        $piece_7->size = json_encode(array("Free"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = false;
        $piece_7->position = "2";
        $piece_7->height = 647.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 647.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit03_top1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit03_top1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit03_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit03_top4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit03_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit03_top4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit03_top4.jpg");

        $media->images = array($image);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(3));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u8p8

        $piece_8 = new Piece();
        $piece_8->name = "Denim Flared Mini Skirt";
        $piece_8->description = "Trapezoid skirt.";
        $piece_8->brand()->associate(PieceBrand::find(77));
        $piece_8->size = json_encode(array("M"));
        $piece_8->type = "BOTTOM";
        $piece_8->is_dress = false;
        $piece_8->position = "3";
        $piece_8->height = 633.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 633.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit03_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit03_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit03_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit03_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit03_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(6));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u8p9

        $piece_9 = new Piece();
        $piece_9->name = "Plain Toe Shoes";
        $piece_9->description = "Light and fashionable kaki shoes.";
        $piece_9->brand()->associate(PieceBrand::find(98));
        $piece_9->size = json_encode(array("M"));
        $piece_9->type = "FEET";
        $piece_9->is_dress = false;
        $piece_9->position = "4";
        $piece_9->height = 466.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 466.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/8/user08_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/8/user08_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/8/user08_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/8/user08_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/8/user08_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/8/user08_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/8/user08_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/8/user08_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/8/user08_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/8/user08_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/8/user08_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/8/user08_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/8/user08_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/8/user08_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/8/user08_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/8/user08_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/8/user08_outfit03_shoes4.jpg");

        $media->images = array($image);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(7));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 8 Outfit 1";
        $outfit_1->description = "Just love the pastel lavender tones.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/8/user08_outfit01.jpg");
        $image->small = cdn("/outfits/8/user08_outfit01.jpg");
        $image->medium = cdn("/outfits/8/user08_outfit01.jpg");
        $image->original = cdn("/outfits/8/user08_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1754";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 8 Outfit 2";
        $outfit_2->description = "Knit top with leather skirt and buckle boots.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/8/user08_outfit02.jpg");
        $image->small = cdn("/outfits/8/user08_outfit02.jpg");
        $image->medium = cdn("/outfits/8/user08_outfit02.jpg");
        $image->original = cdn("/outfits/8/user08_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1887";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 8 Outfit 3";
        $outfit_3->description = "My favourite Mickey top!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/8/user08_outfit03.jpg");
        $image->small = cdn("/outfits/8/user08_outfit03.jpg");
        $image->medium = cdn("/outfits/8/user08_outfit03.jpg");
        $image->original = cdn("/outfits/8/user08_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1746";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 9 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(9); // find felicia

        // create the pieces first

        // u9p1

        $piece_1 = new Piece();
        $piece_1->name = "V-Neck Silk Knit Top";
        $piece_1->description = "A feminine white v-neck knit top.";
        $piece_1->brand()->associate(PieceBrand::find(98));
        $piece_1->size = json_encode(array("Free"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 771.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 771.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit01_top1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit01_top1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/9/user09_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/9/user09_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/9/user09_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/9/user09_outfit01_top3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u9p2

        $piece_2 = new Piece();
        $piece_2->name = "Military Tuck Skirt";
        $piece_2->description = "High waist skirt with an added cutness of military element.";
        $piece_2->brand()->associate(PieceBrand::find(73));
        $piece_2->size = json_encode(array("S"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 663.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 663.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit01_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/9/user09_outfit01_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/9/user09_outfit01_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/9/user09_outfit01_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/9/user09_outfit01_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/9/user09_outfit01_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/9/user09_outfit01_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/9/user09_outfit01_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/9/user09_outfit01_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(6));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u9p3

        $piece_3 = new Piece();
        $piece_3->name = "One Tone Suede Booties";
        $piece_3->description = "A laced-up kaki bootie with elegant design.";
        $piece_3->brand()->associate(PieceBrand::find(76));
        $piece_3->size = json_encode(array("S"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 368.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 368.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit01_shoes2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u9p4

        $piece_4 = new Piece();
        $piece_4->name = "Jacquard Dress";
        $piece_4->description = "Beautiful beige dress with a overlap design.";
        $piece_4->brand()->associate(PieceBrand::find(73));
        $piece_4->size = json_encode(array("S"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = true;
        $piece_4->position = "2";
        $piece_4->height = 1011.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 1011.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit02_top1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit02_top1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/9/user09_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/9/user09_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/9/user09_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/9/user09_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/9/user09_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/9/user09_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/9/user09_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/9/user09_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(4));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u9p5

        $piece_5 = new Piece();
        $piece_5->name = "Pointed Pumps";
        $piece_5->description = "Beautiful cutting for the pair of brown pumps.";
        $piece_5->brand()->associate(PieceBrand::find(73));
        $piece_5->size = json_encode(array("S"));
        $piece_5->type = "FEET";
        $piece_5->is_dress = false;
        $piece_5->position = "4";
        $piece_5->height = 353.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 353.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/9/user09_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/9/user09_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/9/user09_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/9/user09_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/9/user09_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/9/user09_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/9/user09_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/9/user09_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(7));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u9p6

        $piece_6 = new Piece();
        $piece_6->name = "Off Shoulder Knit Top";
        $piece_6->description = "A white colour knit top that can be worn as a off shoulder top.";
        $piece_6->brand()->associate(PieceBrand::find(73));
        $piece_6->size = json_encode(array("Free"));
        $piece_6->type = "TOP";
        $piece_6->is_dress = false;
        $piece_6->position = "2";
        $piece_6->height = 772.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 772.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit03_top1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit03_top1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/9/user09_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/9/user09_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/9/user09_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/9/user09_outfit03_top3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(3));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u9p7

        $piece_7 = new Piece();
        $piece_7->name = "Tulip Corduroy Skirt";
        $piece_7->description = "Navy blue corduroy skirt with tulip design.";
        $piece_7->brand()->associate(PieceBrand::find(73));
        $piece_7->size = json_encode(array("S"));
        $piece_7->type = "BOTTOM";
        $piece_7->is_dress = false;
        $piece_7->position = "3";
        $piece_7->height = 716.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 716.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/9/user09_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/9/user09_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/9/user09_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/9/user09_outfit03_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/9/user09_outfit03_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/9/user09_outfit03_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/9/user09_outfit03_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/9/user09_outfit03_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(6));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u9p8

        $piece_8 = new Piece();
        $piece_8->name = "Ankle Strap Pumps";
        $piece_8->description = "Kaki ankle-strapped pumps.";
        $piece_8->brand()->associate(PieceBrand::find(73));
        $piece_8->size = json_encode(array("S"));
        $piece_8->type = "FEET";
        $piece_8->is_dress = false;
        $piece_8->position = "4";
        $piece_8->height = 368.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 368.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/9/user09_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/9/user09_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/9/user09_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/9/user09_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/9/user09_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/9/user09_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/9/user09_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/9/user09_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/9/user09_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/9/user09_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/9/user09_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/9/user09_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/9/user09_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/9/user09_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/9/user09_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/9/user09_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/9/user09_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(7));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5
        // outfit 3: piece 6, 7, 8

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 9 Outfit 1";
        $outfit_1->description = "An outfit with neutral tones. I just love the skirt so much!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/9/user09_outfit01.jpg");
        $image->small = cdn("/outfits/9/user09_outfit01.jpg");
        $image->medium = cdn("/outfits/9/user09_outfit01.jpg");
        $image->original = cdn("/outfits/9/user09_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1802";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 9 Outfit 2";
        $outfit_2->description = "Perfect dress for dinner.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/9/user09_outfit02.jpg");
        $image->small = cdn("/outfits/9/user09_outfit02.jpg");
        $image->medium = cdn("/outfits/9/user09_outfit02.jpg");
        $image->original = cdn("/outfits/9/user09_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1364";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 9 Outfit 3";
        $outfit_3->description = "The floral skirt pairs up well with knit top.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/9/user09_outfit03.jpg");
        $image->small = cdn("/outfits/9/user09_outfit03.jpg");
        $image->medium = cdn("/outfits/9/user09_outfit03.jpg");
        $image->original = cdn("/outfits/9/user09_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1856";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_6);
        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 10 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(10); // find Giselle

        // create the pieces first

        // u10p1

        $piece_1 = new Piece();
        $piece_1->name = "Jacquelyn Stripe Dress";
        $piece_1->description = "Black and white stripe dress midweight cotton shift dress.";
        $piece_1->brand()->associate(PieceBrand::find(4));
        $piece_1->size = json_encode(array("M"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = true;
        $piece_1->position = "2";
        $piece_1->height = 1192.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 1192.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit01_top1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit01_top1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit01_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit01_top4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit01_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit01_top4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit01_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(4));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u10p2

        $piece_2 = new Piece();
        $piece_2->name = "Kid Leather Cage Sandal";
        $piece_2->description = "Covered platform in the with zipper on the back.";
        $piece_2->brand()->associate(PieceBrand::find(51));
        $piece_2->size = json_encode(array("38"));
        $piece_2->type = "FEET";
        $piece_2->is_dress = false;
        $piece_2->position = "4";
        $piece_2->height = 398.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 398.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit01_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(7));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u10p3

        $piece_3 = new Piece();
        $piece_3->name = "Sunglasses";
        $piece_3->description = "Oversized black acetate frame with retro metallic details.";
        $piece_3->brand()->associate(PieceBrand::find(51));
        $piece_3->size = json_encode(array("Free"));
        $piece_3->type = "HEAD";
        $piece_3->is_dress = false;
        $piece_3->position = "1";
        $piece_3->height = 252.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 252.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit02_head1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit02_head1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit02_head1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit02_head1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit02_head1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit02_head2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit02_head2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit02_head2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit02_head2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit02_head3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit02_head3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit02_head3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit02_head3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit02_head4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit02_head4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit02_head4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit02_head4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(1));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u10p4

        $piece_4 = new Piece();
        $piece_4->name = "Halter Neck Top with Lace Back";
        $piece_4->description = "Black halter neck top with lace back.";
        $piece_4->brand()->associate(PieceBrand::find(66));
        $piece_4->size = json_encode(array("8"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 630.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 630.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit02_top1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit02_top1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u10p5

        $piece_5 = new Piece();
        $piece_5->name = "Faux Leather Skirt with Zips";
        $piece_5->description = "Black faux leather skirt with zips.";
        $piece_5->brand()->associate(PieceBrand::find(66));
        $piece_5->size = json_encode(array("8"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 460.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 460.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(6));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u10p6

        $piece_6 = new Piece();
        $piece_6->name = "High Heel Leather Ankle Boots";
        $piece_6->description = "Black high heel leather ankle boots.";
        $piece_6->brand()->associate(PieceBrand::find(66));
        $piece_6->size = json_encode(array("8"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 508.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 508.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u10p7

        $piece_7 = new Piece();
        $piece_7->name = "Repaired Chambray Boyfriend Shirt";
        $piece_7->description = "Denim boyfriend shirt.";
        $piece_7->brand()->associate(PieceBrand::find(5));
        $piece_7->size = json_encode(array("M"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = false;
        $piece_7->position = "2";
        $piece_7->height = 955.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 955.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit03_top1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit03_top1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit03_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit03_top4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit03_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit03_top4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit03_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(3));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u10p8

        $piece_8 = new Piece();
        $piece_8->name = "Dark Piti Jeggings";
        $piece_8->description = "Medium waist denim jeggings.";
        $piece_8->brand()->associate(PieceBrand::find(43));
        $piece_8->size = json_encode(array("38"));
        $piece_8->type = "BOTTOM";
        $piece_8->is_dress = false;
        $piece_8->position = "3";
        $piece_8->height = 1087.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 1087.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit03_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(5));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u10p9

        $piece_9 = new Piece();
        $piece_9->name = "Radical Sneakers";
        $piece_9->description = "Metallic silver and white leather lace-up sneakers.";
        $piece_9->brand()->associate(PieceBrand::find(36));
        $piece_9->size = json_encode(array("8"));
        $piece_9->type = "FEET";
        $piece_9->is_dress = false;
        $piece_9->position = "4";
        $piece_9->height = 396.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 396.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/10/user10_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/10/user10_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/10/user10_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/10/user10_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/10/user10_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/10/user10_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/10/user10_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/10/user10_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/10/user10_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/10/user10_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/10/user10_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/10/user10_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/10/user10_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/10/user10_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/10/user10_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/10/user10_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/10/user10_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(7));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2
        // outfit 2: piece 3, 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 10 Outfit 1";
        $outfit_1->description = "Just my black and white outfit with Prada shoes.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/10/user10_outfit01.jpg");
        $image->small = cdn("/outfits/10/user10_outfit01.jpg");
        $image->medium = cdn("/outfits/10/user10_outfit01.jpg");
        $image->original = cdn("/outfits/10/user10_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1590";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 10 Outfit 2";
        $outfit_2->description = "Black outfit with halter top.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/10/user10_outfit02.jpg");
        $image->small = cdn("/outfits/10/user10_outfit02.jpg");
        $image->medium = cdn("/outfits/10/user10_outfit02.jpg");
        $image->original = cdn("/outfits/10/user10_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1850";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_3);
        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 10 Outfit 3";
        $outfit_3->description = "Sometimes I do dress up in denim.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/10/user10_outfit03.jpg");
        $image->small = cdn("/outfits/10/user10_outfit03.jpg");
        $image->medium = cdn("/outfits/10/user10_outfit03.jpg");
        $image->original = cdn("/outfits/10/user10_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "2438";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 11 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(11); // find Helen

        // create the pieces first

        // u11p1

        $piece_1 = new Piece();
        $piece_1->name = "Halter Neck Shimmer Thread Dress";
        $piece_1->description = "Black halter neck shimmer thread dress.";
        $piece_1->brand()->associate(PieceBrand::find(66));
        $piece_1->size = json_encode(array("6"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = true;
        $piece_1->position = "2";
        $piece_1->height = 948.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 948.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit01_top1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit01_top1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit01_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/11/user11_outfit01_top4.jpg");
        $additional_image_3->small = cdn("/pieces/11/user11_outfit01_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/11/user11_outfit01_top4.jpg");
        $additional_image_3->original = cdn("/pieces/11/user11_outfit01_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(4));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u11p2

        $piece_2 = new Piece();
        $piece_2->name = "Warp-around Platform Sandal";
        $piece_2->description = "Black chunky platform sandal featuring an ankle strap and a stacked heel.";
        $piece_2->brand()->associate(PieceBrand::find(57));
        $piece_2->size = json_encode(array("6"));
        $piece_2->type = "FEET";
        $piece_2->is_dress = false;
        $piece_2->position = "4";
        $piece_2->height = 406.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 406.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit01_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(7));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u11p3

        $piece_3 = new Piece();
        $piece_3->name = "Halter Neck Top";
        $piece_3->description = "Halter neck, thin straps, floral print.";
        $piece_3->brand()->associate(PieceBrand::find(43));
        $piece_3->size = json_encode(array("XS"));
        $piece_3->type = "TOP";
        $piece_3->is_dress = false;
        $piece_3->position = "2";
        $piece_3->height = 640.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 640.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit02_top1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit02_top1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/11/user11_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/11/user11_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/11/user11_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/11/user11_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(3));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u11p4

        $piece_4 = new Piece();
        $piece_4->name = "Cut-out Detail Skirt";
        $piece_4->description = "Brown skirt with slit detail, zip fastening on the back section and inner lining.";
        $piece_4->brand()->associate(PieceBrand::find(43));
        $piece_4->size = json_encode(array("36"));
        $piece_4->type = "BOTTOM";
        $piece_4->is_dress = false;
        $piece_4->position = "3";
        $piece_4->height = 528.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 528.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/11/user11_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/11/user11_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/11/user11_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/11/user11_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(6));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u11p5

        $piece_5 = new Piece();
        $piece_5->name = "Mary Jane Pump";
        $piece_5->description = "Golden leather Mary Jane pump with double strap with metal buckle.";
        $piece_5->brand()->associate(PieceBrand::find(51));
        $piece_5->size = json_encode(array("36"));
        $piece_5->type = "FEET";
        $piece_5->is_dress = false;
        $piece_5->position = "4";
        $piece_5->height = 430.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 430.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/11/user11_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/11/user11_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/11/user11_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/11/user11_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(7));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u10p6

        $piece_6 = new Piece();
        $piece_6->name = "Petite Structured Bardot Top";
        $piece_6->description = "Chic neutral tone with elasticated shoulders.";
        $piece_6->brand()->associate(PieceBrand::find(61));
        $piece_6->size = json_encode(array("UK 5"));
        $piece_6->type = "TOP";
        $piece_6->is_dress = false;
        $piece_6->position = "2";
        $piece_6->height = 579.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 579.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit03_top1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit03_top1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit03_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/11/user11_outfit03_top4.jpg");
        $additional_image_3->small = cdn("/pieces/11/user11_outfit03_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/11/user11_outfit03_top4.jpg");
        $additional_image_3->original = cdn("/pieces/11/user11_outfit03_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(3));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u11p7

        $piece_7 = new Piece();
        $piece_7->name = "Pleated Front Midi Skirt";
        $piece_7->description = "Soft pastel blue hues and pleats midi skirt.";
        $piece_7->brand()->associate(PieceBrand::find(61));
        $piece_7->size = json_encode(array("UK 5"));
        $piece_7->type = "BOTTOM";
        $piece_7->is_dress = false;
        $piece_7->position = "3";
        $piece_7->height = 1137.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 1137.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit03_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/11/user11_outfit03_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/11/user11_outfit03_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/11/user11_outfit03_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/11/user11_outfit03_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(6));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u11p8

        $piece_8 = new Piece();
        $piece_8->name = "Peep-toe Pump";
        $piece_8->description = "Peep-toe pump with grosgrain Vara bow.";
        $piece_8->brand()->associate(PieceBrand::find(57));
        $piece_8->size = json_encode(array("5"));
        $piece_8->type = "FEET";
        $piece_8->is_dress = false;
        $piece_8->position = "4";
        $piece_8->height = 416.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 416.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/11/user11_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/11/user11_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/11/user11_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/11/user11_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/11/user11_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/11/user11_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/11/user11_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/11/user11_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/11/user11_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/11/user11_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/11/user11_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/11/user11_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/11/user11_outfit03_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(7));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // create 3 outfits
        // outfit 1: piece 1, 2
        // outfit 2: piece 3, 4, 5
        // outfit 3: piece 6, 7, 8

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 11 Outfit 1";
        $outfit_1->description = "The Ferragamo shoes just pairs up perfect with the halter neck dress from ZARA.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/11/user11_outfit01.jpg");
        $image->small = cdn("/outfits/11/user11_outfit01.jpg");
        $image->medium = cdn("/outfits/11/user11_outfit01.jpg");
        $image->original = cdn("/outfits/11/user11_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1354";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 11 Outfit 2";
        $outfit_2->description = "Outfit of the day with golden shoes from Prada.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/11/user11_outfit02.jpg");
        $image->small = cdn("/outfits/11/user11_outfit02.jpg");
        $image->medium = cdn("/outfits/11/user11_outfit02.jpg");
        $image->original = cdn("/outfits/11/user11_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1598";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_3);
        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 11 Outfit 3";
        $outfit_3->description = "Natural tone outfit with the Ferragamo pumps.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/11/user11_outfit03.jpg");
        $image->small = cdn("/outfits/11/user11_outfit03.jpg");
        $image->medium = cdn("/outfits/11/user11_outfit03.jpg");
        $image->original = cdn("/outfits/11/user11_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "2132";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_6);
        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 12 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(12); // find Ivy

        // create the pieces first

        // u12p1

        $piece_1 = new Piece();
        $piece_1->name = "Shirt with Back Opening";
        $piece_1->description = "Black shirt with back opening, chain and feather.";
        $piece_1->brand()->associate(PieceBrand::find(8));
        $piece_1->size = json_encode(array("M"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 665.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 665.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit01_top1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit01_top1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit01_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/12/user12_outfit01_top4.jpg");
        $additional_image_3->small = cdn("/pieces/12/user12_outfit01_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/12/user12_outfit01_top4.jpg");
        $additional_image_3->original = cdn("/pieces/12/user12_outfit01_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u12p2

        $piece_2 = new Piece();
        $piece_2->name = "Side Fringed Suede Shorts";
        $piece_2->description = "Black side fringed suede shorts.";
        $piece_2->brand()->associate(PieceBrand::find(8));
        $piece_2->size = json_encode(array("38"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 359.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 359.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit01_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit01_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit01_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit01_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit01_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/12/user12_outfit01_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/12/user12_outfit01_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/12/user12_outfit01_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/12/user12_outfit01_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(5));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u12p3

        $piece_3 = new Piece();
        $piece_3->name = "Zipped Leather Ankle Boots";
        $piece_3->description = "Black leather boots with side zip fastening.";
        $piece_3->brand()->associate(PieceBrand::find(43));
        $piece_3->size = json_encode(array("38"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 446.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 446.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/12/user12_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/12/user12_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/12/user12_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/12/user12_outfit01_shoes4.jpg");

        $media->images = array($image);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u12p4

        $piece_4 = new Piece();
        $piece_4->name = "Blouse Godon";
        $piece_4->description = "Black and white long-sleeved V-neck blouse.";
        $piece_4->brand()->associate(PieceBrand::find(18));
        $piece_4->size = json_encode(array("M"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 685.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 685.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit02_top1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit02_top1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/12/user12_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/12/user12_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/12/user12_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/12/user12_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u12p5

        $piece_5 = new Piece();
        $piece_5->name = "Super Skinny Low Jeans";
        $piece_5->description = "Low-rise jeans in washed superstretch denim with ultra-slim legs. ";
        $piece_5->brand()->associate(PieceBrand::find(34));
        $piece_5->size = json_encode(array("36"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 1149.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 1149.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/12/user12_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/12/user12_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/12/user12_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/12/user12_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(5));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u12p6

        $piece_6 = new Piece();
        $piece_6->name = "Matte' Fringed Boots";
        $piece_6->description = "Black suedette fringed heel ankle boots.";
        $piece_6->brand()->associate(PieceBrand::find(22));
        $piece_6->size = json_encode(array("UK 6"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 428.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 428.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/12/user12_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/12/user12_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/12/user12_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/12/user12_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u12p7

        $piece_7 = new Piece();
        $piece_7->name = "Halterneck Top";
        $piece_7->description = "Backless halterneck top in draping jersey with a draped neckline.";
        $piece_7->brand()->associate(PieceBrand::find(34));
        $piece_7->size = json_encode(array("38"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = false;
        $piece_7->position = "2";
        $piece_7->height = 954.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 954.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit03_top1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit03_top1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit03_top3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(3));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u12p8

        $piece_8 = new Piece();
        $piece_8->name = "Glittery Skirt";
        $piece_8->description = "Black glittery short jersey skirt with an elasticated waist.";
        $piece_8->brand()->associate(PieceBrand::find(34));
        $piece_8->size = json_encode(array("M"));
        $piece_8->type = "BOTTOM";
        $piece_8->is_dress = false;
        $piece_8->position = "3";
        $piece_8->height = 613.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 613.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit03_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(6));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u12p9

        $piece_9 = new Piece();
        $piece_9->name = "Emie' High Point Court Shoes";
        $piece_9->description = "Black 'Emie' high pointed court shoes.";
        $piece_9->brand()->associate(PieceBrand::find(22));
        $piece_9->size = json_encode(array("UK 6"));
        $piece_9->type = "FEET";
        $piece_9->is_dress = false;
        $piece_9->position = "4";
        $piece_9->height = 403.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 403.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/12/user12_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/12/user12_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/12/user12_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/12/user12_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/12/user12_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/12/user12_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/12/user12_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/12/user12_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/12/user12_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/12/user12_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/12/user12_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/12/user12_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/12/user12_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/12/user12_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/12/user12_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/12/user12_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/12/user12_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(7));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 12 Outfit 1";
        $outfit_1->description = "Casual outfit with a top that has a back opening :)";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/12/user12_outfit01.jpg");
        $image->small = cdn("/outfits/12/user12_outfit01.jpg");
        $image->medium = cdn("/outfits/12/user12_outfit01.jpg");
        $image->original = cdn("/outfits/12/user12_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1470";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 12 Outfit 2";
        $outfit_2->description = "Just my everyday wear.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/12/user12_outfit02.jpg");
        $image->small = cdn("/outfits/12/user12_outfit02.jpg");
        $image->medium = cdn("/outfits/12/user12_outfit02.jpg");
        $image->original = cdn("/outfits/12/user12_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "2262";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 12 Outfit 3";
        $outfit_3->description = "Girls night-out!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/12/user12_outfit03.jpg");
        $image->small = cdn("/outfits/12/user12_outfit03.jpg");
        $image->medium = cdn("/outfits/12/user12_outfit03.jpg");
        $image->original = cdn("/outfits/12/user12_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1970";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 13 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(13); // find Jessica

        // create the pieces first

        // u13p1

        $piece_1 = new Piece();
        $piece_1->name = "Linen T-shirt";
        $piece_1->description = "T-shirt in linen jersey.";
        $piece_1->brand()->associate(PieceBrand::find(34));
        $piece_1->size = json_encode(array("XS"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 718.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 718.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit01_top1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit01_top1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit01_top3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u13p2

        $piece_2 = new Piece();
        $piece_2->name = "Circular Skirt";
        $piece_2->description = "Circular skirt with textured stripes and concealed zip at the back.";
        $piece_2->brand()->associate(PieceBrand::find(34));
        $piece_2->size = json_encode(array("34"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 854.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 854.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit01_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit01_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit01_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit01_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit01_bot3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(6));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u13p3

        $piece_3 = new Piece();
        $piece_3->name = "Wide Black Tassle Loafers";
        $piece_3->description = "Wide fit and extra comfort black leather look tassle loafers.";
        $piece_3->brand()->associate(PieceBrand::find(22));
        $piece_3->size = json_encode(array("UK 5"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 447.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 447.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/13/user13_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/13/user13_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/13/user13_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/13/user13_outfit01_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u13p4

        $piece_4 = new Piece();
        $piece_4->name = "Floral Print Tankini Top";
        $piece_4->description = "Floral print tankini top.";
        $piece_4->brand()->associate(PieceBrand::find(8));
        $piece_4->size = json_encode(array("XS"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 574.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 574.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit02_top1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit02_top1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit02_top3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u13p5

        $piece_5 = new Piece();
        $piece_5->name = "Skinny Jeans";
        $piece_5->description = "Skinny jeans.";
        $piece_5->brand()->associate(PieceBrand::find(8));
        $piece_5->size = json_encode(array("34"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 1166.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 1166.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/13/user13_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/13/user13_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/13/user13_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/13/user13_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(5));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u13p6

        $piece_6 = new Piece();
        $piece_6->name = "Leather Court Shoes";
        $piece_6->description = "Nude colour leather court shoes.";
        $piece_6->brand()->associate(PieceBrand::find(66));
        $piece_6->size = json_encode(array("6"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 434.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 434.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit02_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u13p7

        $piece_7 = new Piece();
        $piece_7->name = "Button Detail Dress";
        $piece_7->description = "Light caramel button detail dress.";
        $piece_7->brand()->associate(PieceBrand::find(66));
        $piece_7->size = json_encode(array("6"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = true;
        $piece_7->position = "2";
        $piece_7->height = 1029.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 1029.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit03_top1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit03_top1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit03_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/13/user13_outfit03_top4.jpg");
        $additional_image_3->small = cdn("/pieces/13/user13_outfit03_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/13/user13_outfit03_top4.jpg");
        $additional_image_3->original = cdn("/pieces/13/user13_outfit03_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(4));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u13p8

        $piece_8 = new Piece();
        $piece_8->name = "Velvet High Heel Shoes";
        $piece_8->description = "Black velvet high heel shoes.";
        $piece_8->brand()->associate(PieceBrand::find(66));
        $piece_8->size = json_encode(array("6"));
        $piece_8->type = "FEET";
        $piece_8->is_dress = false;
        $piece_8->position = "4";
        $piece_8->height = 437.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 437.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/13/user13_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/13/user13_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/13/user13_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/13/user13_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/13/user13_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/13/user13_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/13/user13_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/13/user13_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/13/user13_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/13/user13_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/13/user13_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/13/user13_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/13/user13_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/13/user13_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/13/user13_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/13/user13_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/13/user13_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(7));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 13 Outfit 1";
        $outfit_1->description = "I love this circular skirt!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/13/user13_outfit01.jpg");
        $image->small = cdn("/outfits/13/user13_outfit01.jpg");
        $image->medium = cdn("/outfits/13/user13_outfit01.jpg");
        $image->original = cdn("/outfits/13/user13_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "2018";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 13 Outfit 2";
        $outfit_2->description = "Light coloured jeans with my floral top.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/13/user13_outfit02.jpg");
        $image->small = cdn("/outfits/13/user13_outfit02.jpg");
        $image->medium = cdn("/outfits/13/user13_outfit02.jpg");
        $image->original = cdn("/outfits/13/user13_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "2174";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 13 Outfit 3";
        $outfit_3->description = "Simple dress for the day.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/13/user13_outfit03.jpg");
        $image->small = cdn("/outfits/13/user13_outfit03.jpg");
        $image->medium = cdn("/outfits/13/user13_outfit03.jpg");
        $image->original = cdn("/outfits/13/user13_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1466";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 14 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(14); // find Katie

        // create the pieces first

        // u14p1

        $piece_1 = new Piece();
        $piece_1->name = "Long Brim Hat";
        $piece_1->description = "Classic navy felt hat with the feelings of the 70s.";
        $piece_1->brand()->associate(PieceBrand::find(70));
        $piece_1->size = json_encode(array("One Size"));
        $piece_1->type = "HEAD";
        $piece_1->is_dress = false;
        $piece_1->position = "1";
        $piece_1->height = 314.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 314.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit01_head1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit01_head1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit01_head1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit01_head1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit01_head1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit01_head2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit01_head2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit01_head2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit01_head2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit01_head3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit01_head3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit01_head3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit01_head3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit01_head4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit01_head4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit01_head4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit01_head4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(2));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u14p2

        $piece_2 = new Piece();
        $piece_2->name = "Fringe Turtle-neck Knit Vest";
        $piece_2->description = "Trendy white knit vest with long fringe hem.";
        $piece_2->brand()->associate(PieceBrand::find(70));
        $piece_2->size = json_encode(array("One Size"));
        $piece_2->type = "TOP";
        $piece_2->is_dress = false;
        $piece_2->position = "2";
        $piece_2->height = 785.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 785.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit01_top1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit01_top1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit01_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit01_top4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit01_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit01_top4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit01_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(3));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u14p3

        $piece_3 = new Piece();
        $piece_3->name = "Waffle Knit Pants";
        $piece_3->description = "A soft, stretchy and comfortable white knit pants.";
        $piece_3->brand()->associate(PieceBrand::find(70));
        $piece_3->size = json_encode(array("1"));
        $piece_3->type = "BOTTOM";
        $piece_3->is_dress = false;
        $piece_3->position = "3";
        $piece_3->height = 1112.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 1112.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit01_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit01_bot1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit01_bot1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit01_bot1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit01_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit01_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit01_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit01_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit01_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit01_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit01_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit01_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit01_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit01_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit01_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit01_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit01_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(5));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u14p4

        $piece_4 = new Piece();
        $piece_4->name = "Double-belt Fringe Boots";
        $piece_4->description = "Light brown in colour, this pair of boots is comfortable because it uses a soft suede material.";
        $piece_4->brand()->associate(PieceBrand::find(70));
        $piece_4->size = json_encode(array("8"));
        $piece_4->type = "FEET";
        $piece_4->is_dress = false;
        $piece_4->position = "4";
        $piece_4->height = 395.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 395.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit01_shoes3.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(7));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u14p5

        $piece_5 = new Piece();
        $piece_5->name = "Pearl Button Denim Top";
        $piece_5->description = "Ice blue in colour.";
        $piece_5->brand()->associate(PieceBrand::find(90));
        $piece_5->size = json_encode(array("Free"));
        $piece_5->type = "TOP";
        $piece_5->is_dress = false;
        $piece_5->position = "2";
        $piece_5->height = 521.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 521.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit02_top1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit02_top1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(3));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u14p6

        $piece_6 = new Piece();
        $piece_6->name = "Washed Skinny Denim";
        $piece_6->description = "Stretchable denim jeans.";
        $piece_6->brand()->associate(PieceBrand::find(98));
        $piece_6->size = json_encode(array("26"));
        $piece_6->type = "BOTTOM";
        $piece_6->is_dress = false;
        $piece_6->position = "3";
        $piece_6->height = 1114.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 1114.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(5));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u14p7

        $piece_7 = new Piece();
        $piece_7->name = "Jewel Charm Booties";
        $piece_7->description = "Black booties with jewel charms at the back.";
        $piece_7->brand()->associate(PieceBrand::find(90));
        $piece_7->size = json_encode(array("M"));
        $piece_7->type = "FEET";
        $piece_7->is_dress = false;
        $piece_7->position = "4";
        $piece_7->height = 403.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 403.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(7));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u14p8

        $piece_8 = new Piece();
        $piece_8->name = "Binder Bustier";
        $piece_8->description = "White binder bustier.";
        $piece_8->brand()->associate(PieceBrand::find(80));
        $piece_8->size = json_encode(array("Free"));
        $piece_8->type = "TOP";
        $piece_8->is_dress = false;
        $piece_8->position = "2";
        $piece_8->height = 536.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 536.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit03_top1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit03_top1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit03_top2.jpg");

        $media->images = array($image, $additional_image_1);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(3));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u14p9

        $piece_9 = new Piece();
        $piece_9->name = "Washed Skinny Denim Pants";
        $piece_9->description = "White skinny denim pants.";
        $piece_9->brand()->associate(PieceBrand::find(80));
        $piece_9->size = json_encode(array("S"));
        $piece_9->type = "BOTTOM";
        $piece_9->is_dress = false;
        $piece_9->position = "3";
        $piece_9->height = 1145.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 1145.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit03_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit03_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit03_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit03_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit03_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(5));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // u14p10

        $piece_10 = new Piece();
        $piece_10->name = "Piping Pumps";
        $piece_10->description = "Off white pumps.";
        $piece_10->brand()->associate(PieceBrand::find(90));
        $piece_10->size = json_encode(array("M"));
        $piece_10->type = "FEET";
        $piece_10->is_dress = false;
        $piece_10->position = "4";
        $piece_10->height = 364.0;
        $piece_10->width = 750.0;
        $piece_10->aspectRatio = 750.0 / 364.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/14/user14_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/14/user14_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/14/user14_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/14/user14_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/14/user14_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/14/user14_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/14/user14_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/14/user14_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/14/user14_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/14/user14_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/14/user14_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/14/user14_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/14/user14_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/14/user14_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/14/user14_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/14/user14_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/14/user14_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_10->images = json_encode($media);

        $piece_10->category()->associate(PieceCategory::find(7));
        $piece_10->user()->associate($user);
        $piece_10->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3, 4
        // outfit 2: piece 5, 6, 7
        // outfit 3: piece 8, 9, 10

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 14 Outfit 1";
        $outfit_1->description = "My comfortable wear.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/14/user14_outfit01.jpg");
        $image->small = cdn("/outfits/14/user14_outfit01.jpg");
        $image->medium = cdn("/outfits/14/user14_outfit01.jpg");
        $image->original = cdn("/outfits/14/user14_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "2606";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
        $outfit_1->pieces()->save($piece_4);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 14 Outfit 2";
        $outfit_2->description = "Easy-to-wear outfit.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/14/user14_outfit02.jpg");
        $image->small = cdn("/outfits/14/user14_outfit02.jpg");
        $image->medium = cdn("/outfits/14/user14_outfit02.jpg");
        $image->original = cdn("/outfits/14/user14_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "2038";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);
        $outfit_2->pieces()->save($piece_7);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 14 Outfit 3";
        $outfit_3->description = "Some days, I like it white. The top is just so pretty.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/14/user14_outfit03.jpg");
        $image->small = cdn("/outfits/14/user14_outfit03.jpg");
        $image->medium = cdn("/outfits/14/user14_outfit03.jpg");
        $image->original = cdn("/outfits/14/user14_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "2045";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);
        $outfit_3->pieces()->save($piece_10);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 15 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(15); // find Lucila

        // create the pieces first

        // u15p1

        $piece_1 = new Piece();
        $piece_1->name = "Lace V-neck Long One-piece";
        $piece_1->description = "Long lacey dress always gives the impression of elegance.";
        $piece_1->brand()->associate(PieceBrand::find(70));
        $piece_1->size = json_encode(array("0"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = true;
        $piece_1->position = "2";
        $piece_1->height = 1253.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 1253.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit01_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit01_top1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit01_top1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit01_top1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit01_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit01_top2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit01_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit01_top2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit01_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit01_top3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit01_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit01_top3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit01_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit01_top4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit01_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit01_top4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit01_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(4));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u15p2

        $piece_2 = new Piece();
        $piece_2->name = "Bow Shoes";
        $piece_2->description = "White flats with basic bow design.";
        $piece_2->brand()->associate(PieceBrand::find(70));
        $piece_2->size = json_encode(array("34"));
        $piece_2->type = "FEET";
        $piece_2->is_dress = false;
        $piece_2->position = "4";
        $piece_2->height = 573.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 573.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit01_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit01_shoes1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit01_shoes1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit01_shoes1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit01_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit01_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit01_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit01_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit01_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit01_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit01_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit01_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit01_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit01_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit01_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit01_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit01_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(7));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u15p3

        $piece_3 = new Piece();
        $piece_3->name = "Tiered Lace Tops";
        $piece_3->description = "Beige top with tiered lace.";
        $piece_3->brand()->associate(PieceBrand::find(90));
        $piece_3->size = json_encode(array("Free"));
        $piece_3->type = "TOP";
        $piece_3->is_dress = false;
        $piece_3->position = "2";
        $piece_3->height = 702.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 702.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit02_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit02_top1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit02_top1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit02_top1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit02_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit02_top2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit02_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit02_top2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit02_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit02_top3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit02_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit02_top3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit02_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit02_top4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit02_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit02_top4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit02_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(3));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u15p4

        $piece_4 = new Piece();
        $piece_4->name = "Front Button Mini Skirt";
        $piece_4->description = "Classic checked skirt.";
        $piece_4->brand()->associate(PieceBrand::find(86));
        $piece_4->size = json_encode(array("S"));
        $piece_4->type = "BOTTOM";
        $piece_4->is_dress = false;
        $piece_4->position = "3";
        $piece_4->height = 599.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 599.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit02_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit02_bot1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit02_bot1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit02_bot1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit02_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit02_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit02_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit02_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit02_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit02_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit02_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit02_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit02_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit02_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit02_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit02_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit02_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(6));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u15p5

        $piece_5 = new Piece();
        $piece_5->name = "Multi Patterned Pumps";
        $piece_5->description = "Biege pumps with gold plate gives an added elegance.";
        $piece_5->brand()->associate(PieceBrand::find(88));
        $piece_5->size = json_encode(array("35"));
        $piece_5->type = "FEET";
        $piece_5->is_dress = false;
        $piece_5->position = "4";
        $piece_5->height = 427.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 427.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit02_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit02_shoes1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit02_shoes1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit02_shoes1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit02_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit02_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit02_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit02_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit02_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit02_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit02_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit02_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit02_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit02_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit02_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit02_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit02_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(7));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u15p6

        $piece_6 = new Piece();
        $piece_6->name = "Knit Top with Collar";
        $piece_6->description = "White cable knit pullover.";
        $piece_6->brand()->associate(PieceBrand::find(70));
        $piece_6->size = json_encode(array("One Size"));
        $piece_6->type = "TOP";
        $piece_6->is_dress = false;
        $piece_6->position = "2";
        $piece_6->height = 699.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 699.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit03_top1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit03_top1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit03_top1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit03_top1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit03_top1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit03_top2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit03_top2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit03_top2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit03_top2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit03_top3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit03_top3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit03_top3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit03_top3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit03_top4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit03_top4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit03_top4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit03_top4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(3));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u15p7

        $piece_7 = new Piece();
        $piece_7->name = "Flower Flare Skirt";
        $piece_7->description = "2-tone flower flare skirt. Kaki in colour.";
        $piece_7->brand()->associate(PieceBrand::find(73));
        $piece_7->size = json_encode(array("Free"));
        $piece_7->type = "BOTTOM";
        $piece_7->is_dress = false;
        $piece_7->position = "3";
        $piece_7->height = 815.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 815.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit03_bot1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit03_bot1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit03_bot1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit03_bot1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit03_bot1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit03_bot2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit03_bot2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit03_bot2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit03_bot2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit03_bot3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit03_bot3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit03_bot3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit03_bot3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit03_bot4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit03_bot4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit03_bot4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit03_bot4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(6));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u15p8

        $piece_8 = new Piece();
        $piece_8->name = "Koba Stitch Flat Shoes";
        $piece_8->description = "White lace-up shoes with stitching at the edge.";
        $piece_8->brand()->associate(PieceBrand::find(98));
        $piece_8->size = json_encode(array("S"));
        $piece_8->type = "FEET";
        $piece_8->is_dress = false;
        $piece_8->position = "4";
        $piece_8->height = 346.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 346.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/15/user15_outfit03_shoes1.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/15/user15_outfit03_shoes1.jpg");
        $image->small = cdn("/pieces/15/user15_outfit03_shoes1.jpg");
        $image->medium = cdn("/pieces/15/user15_outfit03_shoes1.jpg");
        $image->original = cdn("/pieces/15/user15_outfit03_shoes1.jpg");

        $additional_image_1 = new stdClass();
        $additional_image_1->thumbnail = cdn("/pieces/15/user15_outfit03_shoes2.jpg");
        $additional_image_1->small = cdn("/pieces/15/user15_outfit03_shoes2.jpg");
        $additional_image_1->medium = cdn("/pieces/15/user15_outfit03_shoes2.jpg");
        $additional_image_1->original = cdn("/pieces/15/user15_outfit03_shoes2.jpg");

        $additional_image_2 = new stdClass();
        $additional_image_2->thumbnail = cdn("/pieces/15/user15_outfit03_shoes3.jpg");
        $additional_image_2->small = cdn("/pieces/15/user15_outfit03_shoes3.jpg");
        $additional_image_2->medium = cdn("/pieces/15/user15_outfit03_shoes3.jpg");
        $additional_image_2->original = cdn("/pieces/15/user15_outfit03_shoes3.jpg");

        $additional_image_3 = new stdClass();
        $additional_image_3->thumbnail = cdn("/pieces/15/user15_outfit03_shoes4.jpg");
        $additional_image_3->small = cdn("/pieces/15/user15_outfit03_shoes4.jpg");
        $additional_image_3->medium = cdn("/pieces/15/user15_outfit03_shoes4.jpg");
        $additional_image_3->original = cdn("/pieces/15/user15_outfit03_shoes4.jpg");

        $media->images = array($image, $additional_image_1, $additional_image_2, $additional_image_3);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(7));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // create 3 outfits
        // outfit 1: piece 1, 2
        // outfit 2: piece 3, 4, 5
        // outfit 3: piece 6, 7, 8

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User 15 Outfit 1";
        $outfit_1->description = "Lace dress outfit.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/15/user15_outfit01.jpg");
        $image->small = cdn("/outfits/15/user15_outfit01.jpg");
        $image->medium = cdn("/outfits/15/user15_outfit01.jpg");
        $image->original = cdn("/outfits/15/user15_outfit01.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1826";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User 15 Outfit 2";
        $outfit_2->description = "Lace top and checked mini skirt.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/15/user15_outfit02.jpg");
        $image->small = cdn("/outfits/15/user15_outfit02.jpg");
        $image->medium = cdn("/outfits/15/user15_outfit02.jpg");
        $image->original = cdn("/outfits/15/user15_outfit02.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1728";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_3);
        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User 15 Outfit 3";
        $outfit_3->description = "Knit top with floral skirt.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/15/user15_outfit03.jpg");
        $image->small = cdn("/outfits/15/user15_outfit03.jpg");
        $image->medium = cdn("/outfits/15/user15_outfit03.jpg");
        $image->original = cdn("/outfits/15/user15_outfit03.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1830";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_6);
        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
    }

    public function staging() {
        // empty 3 tables
        DB::table('pieces')->truncate();
        DB::table('outfits')->truncate();
        DB::table('pieces_outfits')->truncate();

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 1 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(1); // find cameron

        // create the pieces first

        // u1p1
        $piece_1 = new Piece();
        $piece_1->name = "Eyeglasses";
        $piece_1->description = "Oversized square acetate Sunglasses with patent calfskin temples and CC signature";
        $piece_1->brand()->associate(PieceBrand::find(1));
        $piece_1->size = json_encode(array("-"));
        $piece_1->type = "HEAD";
        $piece_1->is_dress = false;
        $piece_1->position = "1";
        $piece_1->height = 470.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 470.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit1_head.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit1_head.jpg");
        $image->small = cdn("/pieces/1/user1_outfit1_head.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit1_head.jpg");
        $image->original = cdn("/pieces/1/user1_outfit1_head.jpg");

        $media->images = array($image);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(1));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u1p2

        $piece_2 = new Piece();
        $piece_2->name = "White Crop Top";
        $piece_2->description = "This sleeveless top features a chic print. Perfect to pair with anything high-waisted for a fun warm-weather look.";
        $piece_2->brand()->associate(PieceBrand::find(2));
        $piece_2->size = json_encode(array("XS"));
        $piece_2->type = "TOP";
        $piece_2->is_dress = false;
        $piece_2->position = "2";
        $piece_2->height = 572.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 572.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit1_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit1_top.jpg");
        $image->small = cdn("/pieces/1/user1_outfit1_top.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit1_top.jpg");
        $image->original = cdn("/pieces/1/user1_outfit1_top.jpg");

        $media->images = array($image);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(3));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u1p3

        $piece_3 = new Piece();
        $piece_3->name = "Ripped Mid Wash Short";
        $piece_3->description = "Stretch cotton denim\nMid-rise waist\nFly fastening\nClassic five pocket design";
        $piece_3->brand()->associate(PieceBrand::find(3));
        $piece_3->size = json_encode(array("XS"));
        $piece_3->type = "BOTTOM";
        $piece_3->is_dress = false;
        $piece_3->position = "3";
        $piece_3->height = 524.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 524.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit1_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit1_bot.jpg");
        $image->small = cdn("/pieces/1/user1_outfit1_bot.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit1_bot.jpg");
        $image->original = cdn("/pieces/1/user1_outfit1_bot.jpg");

        $media->images = array($image);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(5));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // u1p4

        $piece_4 = new Piece();
        $piece_4->name = "Black Nubuck Cat Loafers";
        $piece_4->description = "Nubuck leather loafers in black. Round toe. Cat detailing at toe in black and white buffed leather.";
        $piece_4->brand()->associate(PieceBrand::find(4));
        $piece_4->size = json_encode(array("US 6"));
        $piece_4->type = "FEET";
        $piece_4->is_dress = false;
        $piece_4->position = "4";
        $piece_4->height = 380.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 380.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit1_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit1_shoes.jpg");
        $image->small = cdn("/pieces/1/user1_outfit1_shoes.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit1_shoes.jpg");
        $image->original = cdn("/pieces/1/user1_outfit1_shoes.jpg");

        $media->images = array($image);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(7));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Sunglasses";
        $piece_5->description = "Black acetate frames with metal rivets\nMetal GG logo on the tips\nGrey lens\n100% UVA/UVB protection";
        $piece_5->brand()->associate(PieceBrand::find(5));
        $piece_5->size = json_encode(array("-"));
        $piece_5->type = "HEAD";
        $piece_5->is_dress = false;
        $piece_5->position = "1";
        $piece_5->height = 456.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 456.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit2_head.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit2_head.jpg");
        $image->small = cdn("/pieces/1/user1_outfit2_head.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit2_head.jpg");
        $image->original = cdn("/pieces/1/user1_outfit2_head.jpg");

        $media->images = array($image);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(1));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Boxy Striped Top";
        $piece_6->description = "We gave this boxy short-sleeved top a classic print of nautical stripes, but textured them subtly for a rope-like effect.";
        $piece_6->brand()->associate(PieceBrand::find(2));
        $piece_6->size = json_encode(array("XS"));
        $piece_6->type = "TOP";
        $piece_6->is_dress = false;
        $piece_6->position = "2";
        $piece_6->height = 586.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 586.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit2_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit2_top.jpg");
        $image->small = cdn("/pieces/1/user1_outfit2_top.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit2_top.jpg");
        $image->original = cdn("/pieces/1/user1_outfit2_top.jpg");

        $media->images = array($image);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(3));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Cuffed Denim Shorts";
        $piece_7->description = "This pair features a cuffed hem and a buttoned fly. Wear it to flea markets, brunch, and everywhere in between.";
        $piece_7->brand()->associate(PieceBrand::find(2));
        $piece_7->size = json_encode(array("XS"));
        $piece_7->type = "BOTTOM";
        $piece_7->is_dress = false;
        $piece_7->position = "3";
        $piece_7->height = 578.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 578.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit2_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit2_bot.jpg");
        $image->small = cdn("/pieces/1/user1_outfit2_bot.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit2_bot.jpg");
        $image->original = cdn("/pieces/1/user1_outfit2_bot.jpg");

        $media->images = array($image);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(5));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Anchor Print Chuck Taylor Sneaker";
        $piece_8->description = "Lace-up front with D-rings\nCanvas lining, cushioning insole\nRubber midsole\nRubber traction outsole.";
        $piece_8->brand()->associate(PieceBrand::find(6));
        $piece_8->size = json_encode(array("US 6"));
        $piece_8->type = "FEET";
        $piece_8->is_dress = false;
        $piece_8->position = "4";
        $piece_8->height = 458.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 458.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit2_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit2_shoes.jpg");
        $image->small = cdn("/pieces/1/user1_outfit2_shoes.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit2_shoes.jpg");
        $image->original = cdn("/pieces/1/user1_outfit2_shoes.jpg");

        $media->images = array($image);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(7));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Black Floppy Hat";
        $piece_9->description = "Equally great for creating a shady respite from intense rays and looking just plain cool, this laid-back fedora is crafted from durable paper straw and finished with a sleek contrast hat band.";
        $piece_9->brand()->associate(PieceBrand::find(2));
        $piece_9->size = json_encode(array("-"));
        $piece_9->type = "HEAD";
        $piece_9->is_dress = false;
        $piece_9->position = "1";
        $piece_9->height = 432.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 432.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit3_head.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit3_head.jpg");
        $image->small = cdn("/pieces/1/user1_outfit3_head.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit3_head.jpg");
        $image->original = cdn("/pieces/1/user1_outfit3_head.jpg");

        $media->images = array($image);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(2));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // u1p10

        $piece_10 = new Piece();
        $piece_10->name = "Grey Crop Top";
        $piece_10->description = "Reflecting its logo, this plain grey tee has a clean and simple design. Fitted, with short sleeves and a round neck, it's an effortlessly chic weekend option.";
        $piece_10->brand()->associate(PieceBrand::find(7));
        $piece_10->size = json_encode(array("XS"));
        $piece_10->type = "TOP";
        $piece_10->is_dress = false;
        $piece_10->position = "2";
        $piece_10->height = 652.0;
        $piece_10->width = 750.0;
        $piece_10->aspectRatio = 750.0 / 652.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit3_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit3_top.jpg");
        $image->small = cdn("/pieces/1/user1_outfit3_top.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit3_top.jpg");
        $image->original = cdn("/pieces/1/user1_outfit3_top.jpg");

        $media->images = array($image);

        $piece_10->images = json_encode($media);

        $piece_10->category()->associate(PieceCategory::find(3));
        $piece_10->user()->associate($user);
        $piece_10->save();

        // u1p11

        $piece_11 = new Piece();
        $piece_11->name = "White Daisy Shorts";
        $piece_11->description = "MOTO white denim low rise shorts with multiple pockets, cut-off hem and classic trims. 98% Cotton, 2% Elastane. Machine wash.";
        $piece_11->brand()->associate(PieceBrand::find(8));
        $piece_11->size = json_encode(array("XS"));
        $piece_11->type = "BOTTOM";
        $piece_11->is_dress = false;
        $piece_11->position = "3";
        $piece_11->height = 550.0;
        $piece_11->width = 750.0;
        $piece_11->aspectRatio = 750.0 / 550.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit3_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit3_bot.jpg");
        $image->small = cdn("/pieces/1/user1_outfit3_bot.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit3_bot.jpg");
        $image->original = cdn("/pieces/1/user1_outfit3_bot.jpg");

        $media->images = array($image);

        $piece_11->images = json_encode($media);

        $piece_11->category()->associate(PieceCategory::find(5));
        $piece_11->user()->associate($user);
        $piece_11->save();

        // u1p12

        $piece_12 = new Piece();
        $piece_12->name = "Chuck Taylor Classic";
        $piece_12->description = "The Chuck Taylor All Star is the most iconic sneaker in the world, recognized for its unmistakable silhouette and cultural authenticity.";
        $piece_12->brand()->associate(PieceBrand::find(6));
        $piece_12->size = json_encode(array("US 6"));
        $piece_12->type = "FEET";
        $piece_12->is_dress = false;
        $piece_12->position = "4";
        $piece_12->height = 384.0;
        $piece_12->width = 750.0;
        $piece_12->aspectRatio = 750.0 / 384.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit3_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit3_shoes.jpg");
        $image->small = cdn("/pieces/1/user1_outfit3_shoes.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit3_shoes.jpg");
        $image->original = cdn("/pieces/1/user1_outfit3_shoes.jpg");

        $media->images = array($image);

        $piece_12->images = json_encode($media);

        $piece_12->category()->associate(PieceCategory::find(7));
        $piece_12->user()->associate($user);
        $piece_12->save();

        // u1p13

        $piece_13 = new Piece();
        $piece_13->name = "Tropical Printed Dress";
        $piece_13->description = "Tropical Printed Silk Dress by Giada Forte Resort. 100% silk.";
        $piece_13->brand()->associate(PieceBrand::find(7));
        $piece_13->size = json_encode(array("-"));
        $piece_13->type = "TOP";
        $piece_13->is_dress = true;
        $piece_13->position = "2";
        $piece_13->height = 1634.0;
        $piece_13->width = 750.0;
        $piece_13->aspectRatio = 750.0 / 1634.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit4_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit4_top.jpg");
        $image->small = cdn("/pieces/1/user1_outfit4_top.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit4_top.jpg");
        $image->original = cdn("/pieces/1/user1_outfit4_top.jpg");

        $media->images = array($image);

        $piece_13->images = json_encode($media);

        $piece_13->category()->associate(PieceCategory::find(4));
        $piece_13->user()->associate($user);
        $piece_13->save();

        // u1p14

        $piece_14 = new Piece();
        $piece_14->name = "Vintage Gold Shoes";
        $piece_14->description = "Bows are the best, but when they're gilded and on a shoe? Well it's better than the best.";
        $piece_14->brand()->associate(PieceBrand::find(9));
        $piece_14->size = json_encode(array("US 6"));
        $piece_14->type = "FEET";
        $piece_14->is_dress = false;
        $piece_14->position = "4";
        $piece_14->height = 382.0;
        $piece_14->width = 750.0;
        $piece_14->aspectRatio = 750.0 / 382.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/1/user1_outfit4_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/1/user1_outfit4_shoes.jpg");
        $image->small = cdn("/pieces/1/user1_outfit4_shoes.jpg");
        $image->medium = cdn("/pieces/1/user1_outfit4_shoes.jpg");
        $image->original = cdn("/pieces/1/user1_outfit4_shoes.jpg");

        $media->images = array($image);

        $piece_14->images = json_encode($media);

        $piece_14->category()->associate(PieceCategory::find(7));
        $piece_14->user()->associate($user);
        $piece_14->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3, 4
        // outfit 2: piece 5, 6, 7, 8
        // outfit 3: piece 9, 10, 11, 12
        // outfit 4: piece 13, 14

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User Outfit 1";
        $outfit_1->description = "Great outfit for a sunny day.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/1/user1_outfit1.jpg");
        $image->small = cdn("/outfits/1/user1_outfit1.jpg");
        $image->medium = cdn("/outfits/1/user1_outfit1.jpg");
        $image->original = cdn("/outfits/1/user1_outfit1.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1940";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
        $outfit_1->pieces()->save($piece_4);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User Outfit 2";
        $outfit_2->description = "Wearing this for a BBQ party by the beach.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/1/user1_outfit2.jpg");
        $image->small = cdn("/outfits/1/user1_outfit2.jpg");
        $image->medium = cdn("/outfits/1/user1_outfit2.jpg");
        $image->original = cdn("/outfits/1/user1_outfit2.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "2070";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);
        $outfit_2->pieces()->save($piece_7);
        $outfit_2->pieces()->save($piece_8);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User Outfit 3";
        $outfit_3->description = "Going to the Gardens by the Bay.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/1/user1_outfit3.jpg");
        $image->small = cdn("/outfits/1/user1_outfit3.jpg");
        $image->medium = cdn("/outfits/1/user1_outfit3.jpg");
        $image->original = cdn("/outfits/1/user1_outfit3.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "2016";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_9);
        $outfit_3->pieces()->save($piece_10);
        $outfit_3->pieces()->save($piece_11);
        $outfit_3->pieces()->save($piece_12);

        //4
        $outfit_4 = new Outfit();
        $outfit_4->name = "User Outfit 4";
        $outfit_4->description = "Ready for prom night!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/1/user1_outfit4.jpg");
        $image->small = cdn("/outfits/1/user1_outfit4.jpg");
        $image->medium = cdn("/outfits/1/user1_outfit4.jpg");
        $image->original = cdn("/outfits/1/user1_outfit4.jpg");
        $media->images = $image;

        $outfit_4->images = json_encode($media);
        $outfit_4->height = "2016";
        $outfit_4->width = "750";
        $outfit_4->user()->associate($user);
        $outfit_4->save();

        $outfit_4->pieces()->save($piece_13);
        $outfit_4->pieces()->save($piece_14);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 2 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(2); // find tingzhi

        // create the pieces first

        // u2p1
        $piece_1 = new Piece();
        $piece_1->name = "Keep the Wild in You Tank Top";
        $piece_1->description = "Each shirt is created by hand using a professional screen printing process. We work with New Avenues INK in Portland.";
        $piece_1->brand()->associate(PieceBrand::find(8));
        $piece_1->size = json_encode(array("XS"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 874.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 874.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit1_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit1_top.jpg");
        $image->small = cdn("/pieces/2/user2_outfit1_top.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit1_top.jpg");
        $image->original = cdn("/pieces/2/user2_outfit1_top.jpg");

        $media->images = array($image);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u2p2

        $piece_2 = new Piece();
        $piece_2->name = "High-Waisted Knit Shorts";
        $piece_2->description = "These ribbed knit shorts feature a high-waist and zippered back.";
        $piece_2->brand()->associate(PieceBrand::find(2));
        $piece_2->size = json_encode(array("XS"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 550.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 550.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit1_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit1_bot.jpg");
        $image->small = cdn("/pieces/2/user2_outfit1_bot.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit1_bot.jpg");
        $image->original = cdn("/pieces/2/user2_outfit1_bot.jpg");

        $media->images = array($image);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(5));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u2p3

        $piece_3 = new Piece();
        $piece_3->name = "Chuck Taylor Classic";
        $piece_3->description = "The Chuck Taylor All Star is the most iconic sneaker in the world, recognized for its unmistakable silhouette and cultural authenticity.";
        $piece_3->brand()->associate(PieceBrand::find(6));
        $piece_3->size = json_encode(array("US 7"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 456.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 456.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit1_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit1_shoes.jpg");
        $image->small = cdn("/pieces/2/user2_outfit1_shoes.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit1_shoes.jpg");
        $image->original = cdn("/pieces/2/user2_outfit1_shoes.jpg");

        $media->images = array($image);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();


        // u2p4

        $piece_4 = new Piece();
        $piece_4->name = "Stripe Pullover";
        $piece_4->description = "Made with recycled cotton yarn, this sweater features contrasting stripes on body and sleeves.";
        $piece_4->brand()->associate(PieceBrand::find(10));
        $piece_4->size = json_encode(array("XS"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 760.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 760.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit2_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit2_top.jpg");
        $image->small = cdn("/pieces/2/user2_outfit2_top.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit2_top.jpg");
        $image->original = cdn("/pieces/2/user2_outfit2_top.jpg");

        $media->images = array($image);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Medium Wash High-Waist Jean Cuff Short";
        $piece_5->description = "Introducing American Apparel Jeans! A classic style and wash unlike anything else that's been on the market for the last 15 years.";
        $piece_5->brand()->associate(PieceBrand::find(10));
        $piece_5->size = json_encode(array("XS"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 530.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 530.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit2_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit2_bot.jpg");
        $image->small = cdn("/pieces/2/user2_outfit2_bot.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit2_bot.jpg");
        $image->original = cdn("/pieces/2/user2_outfit2_bot.jpg");

        $media->images = array($image);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(5));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Customized Converse Shoes";
        $piece_6->description = "Make your own sneakers 24K gold. Gold acrylic paint, gold liquid gilding and mod podge.";
        $piece_6->brand()->associate(PieceBrand::find(6));
        $piece_6->size = json_encode(array("XS"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 428.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 428.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit2_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit2_shoes.jpg");
        $image->small = cdn("/pieces/2/user2_outfit2_shoes.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit2_shoes.jpg");
        $image->original = cdn("/pieces/2/user2_outfit2_shoes.jpg");

        $media->images = array($image);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Pullover Hoodie";
        $piece_7->description = "Pullover, made of 60% cotton/40% polyester, is a 280gm fleece pullover hooded sweatshirt.";
        $piece_7->brand()->associate(PieceBrand::find(11));
        $piece_7->size = json_encode(array("Free"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = false;
        $piece_7->position = "2";
        $piece_7->height = 816.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 816.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit3_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit3_top.jpg");
        $image->small = cdn("/pieces/2/user2_outfit3_top.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit3_top.jpg");
        $image->original = cdn("/pieces/2/user2_outfit3_top.jpg");

        $media->images = array($image);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(3));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Chino Shorts";
        $piece_8->description = "These chino shorts made with soft fabric feel light and cool. They're perfect for a feminine look when you're on the run. Available in cool seasonal colors.";
        $piece_8->brand()->associate(PieceBrand::find(12));
        $piece_8->size = json_encode(array("XS"));
        $piece_8->type = "BOTTOM";
        $piece_8->is_dress = false;
        $piece_8->position = "3";
        $piece_8->height = 442.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 442.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit3_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit3_bot.jpg");
        $image->small = cdn("/pieces/2/user2_outfit3_bot.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit3_bot.jpg");
        $image->original = cdn("/pieces/2/user2_outfit3_bot.jpg");

        $media->images = array($image);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(5));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Vans Brigata Slim";
        $piece_9->description = "Sure up your style with the casual cool of the Vans Brigata Slim shoe! Nautically-inspired silhouette with a slim profile. Durable four-eyelet canvas upper.";
        $piece_9->brand()->associate(PieceBrand::find(11));
        $piece_9->size = json_encode(array("US 7"));
        $piece_9->type = "FEET";
        $piece_9->is_dress = false;
        $piece_9->position = "4";
        $piece_9->height = 450.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 450.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/2/user2_outfit3_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/2/user2_outfit3_shoes.jpg");
        $image->small = cdn("/pieces/2/user2_outfit3_shoes.jpg");
        $image->medium = cdn("/pieces/2/user2_outfit3_shoes.jpg");
        $image->original = cdn("/pieces/2/user2_outfit3_shoes.jpg");

        $media->images = array($image);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(7));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User Outfit 1";
        $outfit_1->description = "Love this top so much. I belong to the wild!!!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/2/user2_outfit1.jpg");
        $image->small = cdn("/outfits/2/user2_outfit1.jpg");
        $image->medium = cdn("/outfits/2/user2_outfit1.jpg");
        $image->original = cdn("/outfits/2/user2_outfit1.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1880";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User Outfit 2";
        $outfit_2->description = "Outfit of the day, with my self-made golden shoes.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/2/user2_outfit2.jpg");
        $image->small = cdn("/outfits/2/user2_outfit2.jpg");
        $image->medium = cdn("/outfits/2/user2_outfit2.jpg");
        $image->original = cdn("/outfits/2/user2_outfit2.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "1718";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User Outfit 3";
        $outfit_3->description = "Here's how I combat the cold labs in the school.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/2/user2_outfit3.jpg");
        $image->small = cdn("/outfits/2/user2_outfit3.jpg");
        $image->medium = cdn("/outfits/2/user2_outfit3.jpg");
        $image->original = cdn("/outfits/2/user2_outfit3.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1708";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 3 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(3); // find cecilia

        // create the pieces first

        // u3p1
        $piece_1 = new Piece();
        $piece_1->name = "Spaghetti Strap Tank Top";
        $piece_1->description = "Fitted tank top in soft jersey with narrow adjustable straps.";
        $piece_1->brand()->associate(PieceBrand::find(9));
        $piece_1->size = json_encode(array("S"));
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 698.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 698.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit1_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit1_top.jpg");
        $image->small = cdn("/pieces/3/user3_outfit1_top.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit1_top.jpg");
        $image->original = cdn("/pieces/3/user3_outfit1_top.jpg");

        $media->images = array($image);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u2p2

        $piece_2 = new Piece();
        $piece_2->name = "Plaid Jacquard Full Skirt";
        $piece_2->description = "Inverted front pleating adds classic feminine flare to a red skirt tailored from graphic plaid jacquard.";
        $piece_2->brand()->associate(PieceBrand::find(13));
        $piece_2->size = json_encode(array("S"));
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 703.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 703.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit1_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit1_bot.jpg");
        $image->small = cdn("/pieces/3/user3_outfit1_bot.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit1_bot.jpg");
        $image->original = cdn("/pieces/3/user3_outfit1_bot.jpg");

        $media->images = array($image);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(6));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u2p3

        $piece_3 = new Piece();
        $piece_3->name = "Nike Stefan Janoski Premium";
        $piece_3->description = "Buy Nike SB Stefan Janoski Premium pro skate shoes in Digital Floral-Camo. In-store only colourway available in limited numbers.";
        $piece_3->brand()->associate(PieceBrand::find(14));
        $piece_3->size = json_encode(array("US 8"));
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 512.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 512.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit1_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit1_shoes.jpg");
        $image->small = cdn("/pieces/3/user3_outfit1_shoes.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit1_shoes.jpg");
        $image->original = cdn("/pieces/3/user3_outfit1_shoes.jpg");

        $media->images = array($image);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();


        // u2p4

        $piece_4 = new Piece();
        $piece_4->name = "White Spaghetti Strap Lace Vest";
        $piece_4->description = "Hot Tops! 2014 New Summer Fashion.";
        $piece_4->brand()->associate(PieceBrand::find(10));
        $piece_4->size = json_encode(array("XS"));
        $piece_4->type = "TOP";
        $piece_4->is_dress = false;
        $piece_4->position = "2";
        $piece_4->height = 616.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 616.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit2_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit2_top.jpg");
        $image->small = cdn("/pieces/3/user3_outfit2_top.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit2_top.jpg");
        $image->original = cdn("/pieces/3/user3_outfit2_top.jpg");

        $media->images = array($image);

        $piece_4->images = json_encode($media);

        $piece_4->category()->associate(PieceCategory::find(3));
        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Asymmetrical Long Skirt";
        $piece_5->description = "A yoke of stretchy smocking fits smoothly over the top of a long, A-line skirt cut from cool and breathable linen chambray and finished with a breezy asymmetrical hem.";
        $piece_5->brand()->associate(PieceBrand::find(13));
        $piece_5->size = json_encode(array("S"));
        $piece_5->type = "BOTTOM";
        $piece_5->is_dress = false;
        $piece_5->position = "3";
        $piece_5->height = 1008.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 1008.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit2_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit2_bot.jpg");
        $image->small = cdn("/pieces/3/user3_outfit2_bot.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit2_bot.jpg");
        $image->original = cdn("/pieces/3/user3_outfit2_bot.jpg");

        $media->images = array($image);

        $piece_5->images = json_encode($media);

        $piece_5->category()->associate(PieceCategory::find(6));
        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Palm View Wide Fit High Heel";
        $piece_6->description = "Suede-look finish\nCut-away detailing\nPin buckle fastening\nSharp point toe";
        $piece_6->brand()->associate(PieceBrand::find(15));
        $piece_6->size = json_encode(array("US 8"));
        $piece_6->type = "FEET";
        $piece_6->is_dress = false;
        $piece_6->position = "4";
        $piece_6->height = 508.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 508.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit2_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit2_shoes.jpg");
        $image->small = cdn("/pieces/3/user3_outfit2_shoes.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit2_shoes.jpg");
        $image->original = cdn("/pieces/3/user3_outfit2_shoes.jpg");

        $media->images = array($image);

        $piece_6->images = json_encode($media);

        $piece_6->category()->associate(PieceCategory::find(7));
        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Loose Knit Sweater";
        $piece_7->description = "Oversized knit sweater in a cotton and linen blend.";
        $piece_7->brand()->associate(PieceBrand::find(9));
        $piece_7->size = json_encode(array("S"));
        $piece_7->type = "TOP";
        $piece_7->is_dress = false;
        $piece_7->position = "2";
        $piece_7->height = 773.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 773.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit3_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit3_top.jpg");
        $image->small = cdn("/pieces/3/user3_outfit3_top.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit3_top.jpg");
        $image->original = cdn("/pieces/3/user3_outfit3_top.jpg");

        $media->images = array($image);

        $piece_7->images = json_encode($media);

        $piece_7->category()->associate(PieceCategory::find(3));
        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Black Tartan Skirt";
        $piece_8->description = "Show off a shapely silhouette in this structured bonded skirt. Comes with a fixed waistband, zip fastening and bold grint print for added edge.";
        $piece_8->brand()->associate(PieceBrand::find(16));
        $piece_8->size = json_encode(array("S"));
        $piece_8->type = "BOTTOM";
        $piece_8->is_dress = false;
        $piece_8->position = "3";
        $piece_8->height = 630.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 630.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit3_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit3_bot.jpg");
        $image->small = cdn("/pieces/3/user3_outfit3_bot.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit3_bot.jpg");
        $image->original = cdn("/pieces/3/user3_outfit3_bot.jpg");

        $media->images = array($image);

        $piece_8->images = json_encode($media);

        $piece_8->category()->associate(PieceCategory::find(6));
        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Silence + Noise Chunky Zipper Boot";
        $piece_9->description = "Ankle-length boots, from UO's own Silence + Noise label, crafted from rich nubuck leather. Propped up on a chunky heel and finished off with a side zip closure.";
        $piece_9->brand()->associate(PieceBrand::find(17));
        $piece_9->size = json_encode(array("US 8"));
        $piece_9->type = "FEET";
        $piece_9->is_dress = false;
        $piece_9->position = "4";
        $piece_9->height = 537.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 537.0;

        $media = new stdClass();
        $media->cover = cdn("/pieces/3/user3_outfit3_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/3/user3_outfit3_shoes.jpg");
        $image->small = cdn("/pieces/3/user3_outfit3_shoes.jpg");
        $image->medium = cdn("/pieces/3/user3_outfit3_shoes.jpg");
        $image->original = cdn("/pieces/3/user3_outfit3_shoes.jpg");

        $media->images = array($image);

        $piece_9->images = json_encode($media);

        $piece_9->category()->associate(PieceCategory::find(7));
        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "User Outfit 1";
        $outfit_1->description = "Everything looks good with my limited edition floral print Nike shoes.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/3/user3_outfit1.jpg");
        $image->small = cdn("/outfits/3/user3_outfit1.jpg");
        $image->medium = cdn("/outfits/3/user3_outfit1.jpg");
        $image->original = cdn("/outfits/3/user3_outfit1.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1910";
        $outfit_1->width = "750";
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "User Outfit 2";
        $outfit_2->description = "Off for a picnic :)";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/3/user3_outfit2.jpg");
        $image->small = cdn("/outfits/3/user3_outfit2.jpg");
        $image->medium = cdn("/outfits/3/user3_outfit2.jpg");
        $image->original = cdn("/outfits/3/user3_outfit2.jpg");
        $media->images = $image;

        $outfit_2->images = json_encode($media);
        $outfit_2->height = "2132";
        $outfit_2->width = "750";
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "User Outfit 3";
        $outfit_3->description = "Love my outfit of the day";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/3/user3_outfit3.jpg");
        $image->small = cdn("/outfits/3/user3_outfit3.jpg");
        $image->medium = cdn("/outfits/3/user3_outfit3.jpg");
        $image->original = cdn("/outfits/3/user3_outfit3.jpg");
        $media->images = $image;

        $outfit_3->images = json_encode($media);
        $outfit_3->height = "1940";
        $outfit_3->width = "750";
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        // create 1 spruced outfit
        $piece_1 = Piece::find(9);  // cameron's outfit 3 hat
        $piece_2 = Piece::find(10); // cameron's outfit 3 top
        $piece_3 = Piece::find(16); // tingzhi's outfit 1 bottom
        $piece_4 = Piece::find(12); // cameron's outfit 3 shoes

        $outfit_1 = new Outfit();
        $outfit_1->name = "Spruced Outfit 1";
        $outfit_1->description = "Looking good with red shorts.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/3/user3_outfit4.jpg");
        $image->small = cdn("/outfits/3/user3_outfit4.jpg");
        $image->medium = cdn("/outfits/3/user3_outfit4.jpg");
        $image->original = cdn("/outfits/3/user3_outfit4.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "2016";
        $outfit_1->width = "750";
        $outfit_1->inspiredBy()->associate(User::find(1)); // inspired by cameron, cecilia was browsing cameron's outfits
        $outfit_1->user()->associate($user); // posted by cecilia
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
        $outfit_1->pieces()->save($piece_4);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        Shop 1 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(4); // find sprubixshop

        // create the pieces first

        // u4p1
        $piece_1 = new Piece();
        $piece_1->name = "Mint Tank-Top Endless Summer";
        $piece_1->description = "BELLA + CANVAS Women's Flowy Boxy Tank" .
            "\n- 3.7 oz., 65% polyester / 35% viscose" .
            "\n- 30 single jersey" .
            "\n- Side seams" .
            "\n- Cropped body length" .
            "\n- Easy, drapey fit";
        $piece_1->brand()->associate(PieceBrand::find(18));
        $sizes = array("S", "M");
        $piece_1->size = json_encode($sizes);
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 638.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 638.0;

        $quantity = new stdClass();

        foreach($sizes as $size) {
            $quantity->$size = "5";
        }

        $piece_1->quantity = json_encode($quantity);
        $piece_1->price = 22.00;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user4_outfit1_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user4_outfit1_top.jpg");
        $image->small = cdn("/pieces/4/user4_outfit1_top.jpg");
        $image->medium = cdn("/pieces/4/user4_outfit1_top.jpg");
        $image->original = cdn("/pieces/4/user4_outfit1_top.jpg");

        $media->images = array($image);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u4p2

        $piece_2 = new Piece();
        $piece_2->name = "Highwaisted Dark Acid Wash Frayed Distressed Shorts";
        $piece_2->description = "Prepare for the season ahead! These blue acid wash high waisted frayed denim shorts with revealing pockets will make you stand out from the crowd!";
        $piece_2->brand()->associate(PieceBrand::find(18));

        $sizes = array("XS", "S", "M", "L");
        $piece_2->size = json_encode($sizes);
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 523.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 523.0;

        $quantity = new stdClass();

        foreach($sizes as $size) {
            $quantity->$size = "10";
        }

        $piece_2->quantity = json_encode($quantity);
        $piece_2->price = 18.00;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user4_outfit1_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user4_outfit1_bot.jpg");
        $image->small = cdn("/pieces/4/user4_outfit1_bot.jpg");
        $image->medium = cdn("/pieces/4/user4_outfit1_bot.jpg");
        $image->original = cdn("/pieces/4/user4_outfit1_bot.jpg");

        $media->images = array($image);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(5));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u4p3

        $piece_3 = new Piece();
        $piece_3->name = "Carol Flats";
        $piece_3->description = "Out of the box you will feel compelled to show off in them. Just make sure that they get seen by as many people as possible!";
        $piece_3->brand()->associate(PieceBrand::find(18));

        $sizes = array("US 7", "US 8");
        $piece_3->size = json_encode($sizes);
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 477.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 477.0;

        $quantity = new stdClass();

        foreach($sizes as $size) {
            $quantity->$size = "8";
        }

        $piece_3->quantity = json_encode($quantity);
        $piece_3->price = 25.00;

        $media = new stdClass();
        $media->cover = cdn("/pieces/4/user4_outfit1_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/4/user4_outfit1_shoes.jpg");
        $image->small = cdn("/pieces/4/user4_outfit1_shoes.jpg");
        $image->medium = cdn("/pieces/4/user4_outfit1_shoes.jpg");
        $image->original = cdn("/pieces/4/user4_outfit1_shoes.jpg");

        $media->images = array($image);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // create 1 outfits
        // outfit 1: piece 1, 2, 3

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "Shop Outfit 1";
        $outfit_1->description = "Beat the hot weather with a singlet and shorts!";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/4/user4_outfit1.jpg");
        $image->small = cdn("/outfits/4/user4_outfit1.jpg");
        $image->medium = cdn("/outfits/4/user4_outfit1.jpg");
        $image->original = cdn("/outfits/4/user4_outfit1.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1636";
        $outfit_1->width = "750";
        $outfit_1->purchasable = true;
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        Shop 2 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(5); // find flufflea

        // create the pieces first

        // u5p1
        $piece_1 = new Piece();
        $piece_1->name = "Front Lace Blouse";
        $piece_1->description = "The lacey flower design gives an impact on the front side of the blouse. It is designed to go well with layering as well. Of course, it also act as a one-piece jacket.";
        $piece_1->brand()->associate(PieceBrand::find(19));
        $sizes = array("S", "M", "L");
        $piece_1->size = json_encode($sizes);
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 697.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 697.0;

        $quantity = new stdClass();

        foreach($sizes as $size) {
            $quantity->$size = "10";
        }

        $piece_1->quantity = json_encode($quantity);
        $piece_1->price = 30.00;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user5_outfit1_top.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user5_outfit1_top.jpg");
        $image->small = cdn("/pieces/5/user5_outfit1_top.jpg");
        $image->medium = cdn("/pieces/5/user5_outfit1_top.jpg");
        $image->original = cdn("/pieces/5/user5_outfit1_top.jpg");

        $media->images = array($image);

        $piece_1->images = json_encode($media);

        $piece_1->category()->associate(PieceCategory::find(3));
        $piece_1->user()->associate($user);
        $piece_1->save();

        // u4p2

        $piece_2 = new Piece();
        $piece_2->name = "Wrap-style Skirt";
        $piece_2->description = "The ribbon tied to the waist serves as stylish design for the wrap-skirt. It gives a feminine touch and skirt will definitely gives you a mature feel.";
        $piece_2->brand()->associate(PieceBrand::find(19));

        $sizes = array("XS", "S", "M", "L");
        $piece_2->size = json_encode($sizes);
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 663.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 663.0;

        $quantity = new stdClass();

        foreach($sizes as $size) {
            $quantity->$size = "10";
        }

        $piece_2->quantity = json_encode($quantity);
        $piece_2->price = 25.00;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user5_outfit1_bot.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user5_outfit1_bot.jpg");
        $image->small = cdn("/pieces/5/user5_outfit1_bot.jpg");
        $image->medium = cdn("/pieces/5/user5_outfit1_bot.jpg");
        $image->original = cdn("/pieces/5/user5_outfit1_bot.jpg");

        $media->images = array($image);

        $piece_2->images = json_encode($media);

        $piece_2->category()->associate(PieceCategory::find(6));
        $piece_2->user()->associate($user);
        $piece_2->save();

        // u4p3

        $piece_3 = new Piece();
        $piece_3->name = "Pointed Squareheel Pumps";
        $piece_3->description = "Pointed pumps. It has a not too thing heels as the heels are square-shaped.";
        $piece_3->brand()->associate(PieceBrand::find(19));

        $sizes = array("UK 6", "UK 7", "UK 8");
        $piece_3->size = json_encode($sizes);
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 412.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 412.0;

        $quantity = new stdClass();

        foreach($sizes as $size) {
            $quantity->$size = "10";
        }

        $piece_3->quantity = json_encode($quantity);
        $piece_3->price = 35.00;

        $media = new stdClass();
        $media->cover = cdn("/pieces/5/user5_outfit1_shoes.jpg");

        $image = new stdClass();
        $image->thumbnail = cdn("/pieces/5/user5_outfit1_shoes.jpg");
        $image->small = cdn("/pieces/5/user5_outfit1_shoes.jpg");
        $image->medium = cdn("/pieces/5/user5_outfit1_shoes.jpg");
        $image->original = cdn("/pieces/5/user5_outfit1_shoes.jpg");

        $media->images = array($image);

        $piece_3->images = json_encode($media);

        $piece_3->category()->associate(PieceCategory::find(7));
        $piece_3->user()->associate($user);
        $piece_3->save();

        // create 1 outfits
        // outfit 1: piece 1, 2, 3

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "Shop Outfit 1";
        $outfit_1->description = "An outfit with brands from Japan.";

        $media = new stdClass();
        $image = new stdClass();
        $image->thumbnail = cdn("/outfits/5/user5_outfit1.jpg");
        $image->small = cdn("/outfits/5/user5_outfit1.jpg");
        $image->medium = cdn("/outfits/5/user5_outfit1.jpg");
        $image->original = cdn("/outfits/5/user5_outfit1.jpg");
        $media->images = $image;

        $outfit_1->images = json_encode($media);
        $outfit_1->height = "1772";
        $outfit_1->width = "750";
        $outfit_1->purchasable = true;
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
    }
}