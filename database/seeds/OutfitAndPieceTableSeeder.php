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


        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 1 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(1); // find jasmine

        // create the pieces first

        // u1p1
        $piece_1 = new Piece();
        $piece_1->name = "Piece 1";
        $piece_1->description = "Example Piece Description 1";
        $piece_1->type = "HEAD";
        $piece_1->position = "1";
        $piece_1->height = 234.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 234.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_head.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_head.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_head.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_head.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_head.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_head.jpg";

        $media->images = array($image);

        $piece_1->images = json_encode($media);
        $piece_1->save();

        $piece_1->user()->associate($user);
        $piece_1->save();

        // u1p2

        $piece_2 = new Piece();
        $piece_2->name = "Piece 2";
        $piece_2->description = "Example Piece Description 2";
        $piece_2->type = "TOP";
        $piece_2->position = "2";
        $piece_2->height = 286.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 286.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_top.jpg";

        $media->images = array($image);

        $piece_2->images = json_encode($media);
        $piece_2->save();

        $piece_2->user()->associate($user);
        $piece_2->save();

        // u1p3

        $piece_3 = new Piece();
        $piece_3->name = "Piece 3";
        $piece_3->description = "Example Piece Description 3";
        $piece_3->type = "BOTTOM";
        $piece_3->position = "3";
        $piece_3->height = 262.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 262.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_bot.jpg";

        $media->images = array($image);

        $piece_3->images = json_encode($media);
        $piece_3->save();

        $piece_3->user()->associate($user);
        $piece_3->save();

        // u1p4

        $piece_4 = new Piece();
        $piece_4->name = "Piece 4";
        $piece_4->description = "Example Piece Description 4";
        $piece_4->type = "FEET";
        $piece_4->position = "4";
        $piece_4->height = 190.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 190.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit1_shoes.jpg";

        $media->images = array($image);

        $piece_4->images = json_encode($media);
        $piece_4->save();

        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Piece 5";
        $piece_5->description = "Example Piece Description 5";
        $piece_5->type = "HEAD";
        $piece_5->position = "1";
        $piece_5->height = 228.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 228.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_head.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_head.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_head.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_head.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_head.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_head.jpg";

        $media->images = array($image);

        $piece_5->images = json_encode($media);
        $piece_5->save();

        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Piece 6";
        $piece_6->description = "Example Piece Description 6";
        $piece_6->type = "TOP";
        $piece_6->position = "2";
        $piece_6->height = 293.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 293.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_top.jpg";

        $media->images = array($image);

        $piece_6->images = json_encode($media);
        $piece_6->save();

        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Piece 7";
        $piece_7->description = "Example Piece Description 7";
        $piece_7->type = "BOTTOM";
        $piece_7->position = "3";
        $piece_7->height = 289.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 289.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_bot.jpg";

        $media->images = array($image);

        $piece_7->images = json_encode($media);
        $piece_7->save();

        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Piece 8";
        $piece_8->description = "Example Piece Description 8";
        $piece_8->type = "FEET";
        $piece_8->position = "4";
        $piece_8->height = 229.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 229.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit2_shoes.jpg";

        $media->images = array($image);

        $piece_8->images = json_encode($media);
        $piece_8->save();

        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Piece 9";
        $piece_9->description = "Example Piece Description 9";
        $piece_9->type = "HEAD";
        $piece_9->position = "1";
        $piece_9->height = 216.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 216.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_head.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_head.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_head.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_head.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_head.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_head.jpg";

        $media->images = array($image);

        $piece_9->images = json_encode($media);
        $piece_9->save();

        $piece_9->user()->associate($user);
        $piece_9->save();

        // u1p10

        $piece_10 = new Piece();
        $piece_10->name = "Piece 10";
        $piece_10->description = "Example Piece Description 10";
        $piece_10->type = "TOP";
        $piece_10->position = "2";
        $piece_10->height = 325.0;
        $piece_10->width = 750.0;
        $piece_10->aspectRatio = 750.0 / 325.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_top.jpg";

        $media->images = array($image);

        $piece_10->images = json_encode($media);
        $piece_10->save();

        $piece_10->user()->associate($user);
        $piece_10->save();

        // u1p11

        $piece_11 = new Piece();
        $piece_11->name = "Piece 11";
        $piece_11->description = "Example Piece Description 11";
        $piece_11->type = "BOTTOM";
        $piece_11->position = "3";
        $piece_11->height = 275.0;
        $piece_11->width = 750.0;
        $piece_11->aspectRatio = 750.0 / 275.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_bot.jpg";

        $media->images = array($image);

        $piece_11->images = json_encode($media);
        $piece_11->save();

        $piece_11->user()->associate($user);
        $piece_11->save();

        // u1p12

        $piece_12 = new Piece();
        $piece_12->name = "Piece 12";
        $piece_12->description = "Example Piece Description 12";
        $piece_12->type = "FEET";
        $piece_12->position = "4";
        $piece_12->height = 192.0;
        $piece_12->width = 750.0;
        $piece_12->aspectRatio = 750.0 / 192.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/1/user1_outfit3_shoes.jpg";

        $media->images = array($image);

        $piece_12->images = json_encode($media);
        $piece_12->save();

        $piece_12->user()->associate($user);
        $piece_12->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3, 4
        // outfit 2: piece 5, 6, 7, 8
        // outfit 3: piece 9, 10, 11, 12

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "Example Outfit 1";
        $outfit_1->description = "Example Outfit Description 1";
        $outfit_1->images = "https://sprubixtest.s3.amazonaws.com/outfits/1/user1_outfit1.jpg";
        $outfit_1->height = "970";
        $outfit_1->width = "750";
        $outfit_1->save();
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
        $outfit_1->pieces()->save($piece_4);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "Example Outfit 2";
        $outfit_2->description = "Example Outfit Description 2";
        $outfit_2->images = "https://sprubixtest.s3.amazonaws.com/outfits/1/user1_outfit2.jpg";
        $outfit_2->height = "1035";
        $outfit_2->width = "750";
        $outfit_2->save();
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);
        $outfit_2->pieces()->save($piece_7);
        $outfit_2->pieces()->save($piece_8);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "Example Outfit 3";
        $outfit_3->description = "Example Outfit Description 3";
        $outfit_3->images = "https://sprubixtest.s3.amazonaws.com/outfits/1/user1_outfit3.jpg";
        $outfit_3->height = "1008";
        $outfit_3->width = "750";
        $outfit_3->save();
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_9);
        $outfit_3->pieces()->save($piece_10);
        $outfit_3->pieces()->save($piece_11);
        $outfit_3->pieces()->save($piece_12);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*                                        User 2 Pieces & Outfits                                       */
        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        $user = User::find(2); // find tingzhi

        // create the pieces first

        // u2p1
        $piece_1 = new Piece();
        $piece_1->name = "Piece 1";
        $piece_1->description = "Example Piece Description 1";
        $piece_1->type = "TOP";
        $piece_1->position = "2";
        $piece_1->height = 437.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 437.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_top.jpg";

        $media->images = array($image);

        $piece_1->images = json_encode($media);
        $piece_1->save();

        $piece_1->user()->associate($user);
        $piece_1->save();

        // u2p2

        $piece_2 = new Piece();
        $piece_2->name = "Piece 2";
        $piece_2->description = "Example Piece Description 2";
        $piece_2->type = "BOTTOM";
        $piece_2->position = "3";
        $piece_2->height = 275.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 275.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_bot.jpg";

        $media->images = array($image);

        $piece_2->images = json_encode($media);
        $piece_2->save();

        $piece_2->user()->associate($user);
        $piece_2->save();

        // u2p3

        $piece_3 = new Piece();
        $piece_3->name = "Piece 3";
        $piece_3->description = "Example Piece Description 3";
        $piece_3->type = "FEET";
        $piece_3->position = "4";
        $piece_3->height = 228.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 228.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit1_shoes.jpg";

        $media->images = array($image);

        $piece_3->images = json_encode($media);
        $piece_3->save();

        $piece_3->user()->associate($user);
        $piece_3->save();


        // u2p4

        $piece_4 = new Piece();
        $piece_4->name = "Piece 4";
        $piece_4->description = "Example Piece Description 4";
        $piece_4->type = "TOP";
        $piece_4->position = "2";
        $piece_4->height = 380.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 380.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_top.jpg";

        $media->images = array($image);

        $piece_4->images = json_encode($media);
        $piece_4->save();

        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Piece 5";
        $piece_5->description = "Example Piece Description 5";
        $piece_5->type = "BOTTOM";
        $piece_5->position = "3";
        $piece_5->height = 265.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 265.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_bot.jpg";

        $media->images = array($image);

        $piece_5->images = json_encode($media);
        $piece_5->save();

        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Piece 6";
        $piece_6->description = "Example Piece Description 6";
        $piece_6->type = "FEET";
        $piece_6->position = "4";
        $piece_6->height = 214.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 214.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit2_shoes.jpg";

        $media->images = array($image);

        $piece_6->images = json_encode($media);
        $piece_6->save();

        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Piece 7";
        $piece_7->description = "Example Piece Description 7";
        $piece_7->type = "TOP";
        $piece_7->position = "2";
        $piece_7->height = 408.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 408.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_top.jpg";

        $media->images = array($image);

        $piece_7->images = json_encode($media);
        $piece_7->save();

        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Piece 8";
        $piece_8->description = "Example Piece Description 8";
        $piece_8->type = "BOTTOM";
        $piece_8->position = "3";
        $piece_8->height = 221.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 221.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_bot.jpg";

        $media->images = array($image);

        $piece_8->images = json_encode($media);
        $piece_8->save();

        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Piece 9";
        $piece_9->description = "Example Piece Description 9";
        $piece_9->type = "FEET";
        $piece_9->position = "4";
        $piece_9->height = 225.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 225.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/2/user2_outfit3_shoes.jpg";

        $media->images = array($image);

        $piece_9->images = json_encode($media);
        $piece_9->save();

        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "Example Outfit 1";
        $outfit_1->description = "Example Outfit Description 1";
        $outfit_1->images = "https://sprubixtest.s3.amazonaws.com/outfits/2/user2_outfit1.jpg";
        $outfit_1->height = "940";
        $outfit_1->width = "750";
        //$outfit_1->inspiredBy()->associate($user); // testing inspired_by
        $outfit_1->save();
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "Example Outfit 2";
        $outfit_2->description = "Example Outfit Description 2";
        $outfit_2->images = "https://sprubixtest.s3.amazonaws.com/outfits/2/user2_outfit2.jpg";
        $outfit_2->height = "859";
        $outfit_2->width = "750";
        $outfit_2->save();
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "Example Outfit 3";
        $outfit_3->description = "Example Outfit Description 3";
        $outfit_3->images = "https://sprubixtest.s3.amazonaws.com/outfits/2/user2_outfit3.jpg";
        $outfit_3->height = "854";
        $outfit_3->width = "750";
        $outfit_3->save();
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
        $piece_1->name = "Piece 1";
        $piece_1->description = "Example Piece Description 1";
        $piece_1->type = "TOP";
        $piece_1->position = "2";
        $piece_1->height = 349.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 349.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_top.jpg";

        $media->images = array($image);

        $piece_1->images = json_encode($media);
        $piece_1->save();

        $piece_1->user()->associate($user);
        $piece_1->save();

        // u2p2

        $piece_2 = new Piece();
        $piece_2->name = "Piece 2";
        $piece_2->description = "Example Piece Description 2";
        $piece_2->type = "BOTTOM";
        $piece_2->position = "3";
        $piece_2->height = 350.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 350.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_bot.jpg";

        $media->images = array($image);

        $piece_2->images = json_encode($media);
        $piece_2->save();

        $piece_2->user()->associate($user);
        $piece_2->save();

        // u2p3

        $piece_3 = new Piece();
        $piece_3->name = "Piece 3";
        $piece_3->description = "Example Piece Description 3";
        $piece_3->type = "FEET";
        $piece_3->position = "4";
        $piece_3->height = 256.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 256.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit1_shoes.jpg";

        $media->images = array($image);

        $piece_3->images = json_encode($media);
        $piece_3->save();

        $piece_3->user()->associate($user);
        $piece_3->save();


        // u2p4

        $piece_4 = new Piece();
        $piece_4->name = "Piece 4";
        $piece_4->description = "Example Piece Description 4";
        $piece_4->type = "TOP";
        $piece_4->position = "2";
        $piece_4->height = 308.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 308.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_top.jpg";

        $media->images = array($image);

        $piece_4->images = json_encode($media);
        $piece_4->save();

        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Piece 5";
        $piece_5->description = "Example Piece Description 5";
        $piece_5->type = "BOTTOM";
        $piece_5->position = "3";
        $piece_5->height = 504.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 504.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_bot.jpg";

        $media->images = array($image);

        $piece_5->images = json_encode($media);
        $piece_5->save();

        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Piece 6";
        $piece_6->description = "Example Piece Description 6";
        $piece_6->type = "FEET";
        $piece_6->position = "4";
        $piece_6->height = 254.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 254.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit2_shoes.jpg";

        $media->images = array($image);

        $piece_6->images = json_encode($media);
        $piece_6->save();

        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Piece 7";
        $piece_7->description = "Example Piece Description 7";
        $piece_7->type = "TOP";
        $piece_7->position = "2";
        $piece_7->height = 389.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 389.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_top.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_top.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_top.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_top.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_top.jpg";

        $media->images = array($image);

        $piece_7->images = json_encode($media);
        $piece_7->save();

        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Piece 8";
        $piece_8->description = "Example Piece Description 8";
        $piece_8->type = "BOTTOM";
        $piece_8->position = "3";
        $piece_8->height = 315.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 315.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_bot.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_bot.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_bot.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_bot.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_bot.jpg";

        $media->images = array($image);

        $piece_8->images = json_encode($media);
        $piece_8->save();

        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Piece 9";
        $piece_9->description = "Example Piece Description 9";
        $piece_9->type = "FEET";
        $piece_9->position = "4";
        $piece_9->height = 266.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 266.0;

        $media = new stdClass();
        $media->cover = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_shoes.jpg";
        $image->small = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_shoes.jpg";
        $image->medium = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_shoes.jpg";
        $image->large = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_shoes.jpg";
        $image->original = "https://sprubixtest.s3.amazonaws.com/pieces/3/user3_outfit3_shoes.jpg";

        $media->images = array($image);

        $piece_9->images = json_encode($media);
        $piece_9->save();

        $piece_9->user()->associate($user);
        $piece_9->save();

        // create 3 outfits
        // outfit 1: piece 1, 2, 3
        // outfit 2: piece 4, 5, 6
        // outfit 3: piece 7, 8, 9

        // 1
        $outfit_1 = new Outfit();
        $outfit_1->name = "Example Outfit 1";
        $outfit_1->description = "Example Outfit Description 1";
        $outfit_1->images = "https://sprubixtest.s3.amazonaws.com/outfits/3/user3_outfit1.jpg";
        $outfit_1->height = "955";
        $outfit_1->width = "750";
        $outfit_1->save();
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);

        // 2
        $outfit_2 = new Outfit();
        $outfit_2->name = "Example Outfit 2";
        $outfit_2->description = "Example Outfit Description 2";
        $outfit_2->images = "https://sprubixtest.s3.amazonaws.com/outfits/3/user3_outfit2.jpg";
        $outfit_2->height = "1066";
        $outfit_2->width = "750";
        $outfit_2->save();
        $outfit_2->user()->associate($user);
        $outfit_2->save();

        $outfit_2->pieces()->save($piece_4);
        $outfit_2->pieces()->save($piece_5);
        $outfit_2->pieces()->save($piece_6);

        // 3
        $outfit_3 = new Outfit();
        $outfit_3->name = "Example Outfit 3";
        $outfit_3->description = "Example Outfit Description 3";
        $outfit_3->images = "https://sprubixtest.s3.amazonaws.com/outfits/3/user3_outfit3.jpg";
        $outfit_3->height = "970";
        $outfit_3->width = "750";
        $outfit_3->save();
        $outfit_3->user()->associate($user);
        $outfit_3->save();

        $outfit_3->pieces()->save($piece_7);
        $outfit_3->pieces()->save($piece_8);
        $outfit_3->pieces()->save($piece_9);

        // create 1 spruced outfit
        $piece_1 = Piece::find(9);  // jasmine's outfit 3 hat
        $piece_2 = Piece::find(10); // jasmine's outfit 3 top
        $piece_3 = Piece::find(14); // tingzhi's outfit 1 bottom
        $piece_4 = Piece::find(12); // jasmine's outfit 3 shoes

        $outfit_1 = new Outfit();
        $outfit_1->name = "Spruced Outfit 1";
        $outfit_1->description = "Spruced Outfit Description 1";
        $outfit_1->images = "https://sprubixtest.s3.amazonaws.com/outfits/3/user3_outfit4.jpg";
        $outfit_1->height = "1008";
        $outfit_1->width = "750";
        $outfit_1->inspiredBy()->associate(User::find(1)); // inspired by jasmine, cecilia was browsing jasmine's outfits
        $outfit_1->save();
        $outfit_1->user()->associate($user); // posted by cecilia
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
        $outfit_1->pieces()->save($piece_4);
    }
}