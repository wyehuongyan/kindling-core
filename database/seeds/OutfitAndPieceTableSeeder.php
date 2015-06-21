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
        $piece_1->name = "Eyeglasses";
        $piece_1->description = "Oversized square acetate Sunglasses with patent calfskin temples and CC signature";
        $piece_1->brand()->associate(PieceBrand::find(1));
        $piece_1->size = "-";
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
        $piece_2->size = "XS";
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
        $piece_3->size = "XS";
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
        $piece_4->size = "US 6";
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
        $piece_5->size = "-";
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
        $piece_6->size = "XS";
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
        $piece_7->size = "XS";
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
        $piece_8->description = "\nLace-up front with D-rings\nCanvas lining, cushioning insole\nRubber midsole\nRubber traction outsole.";
        $piece_8->brand()->associate(PieceBrand::find(6));
        $piece_8->size = "US 6";
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
        $piece_9->size = "-";
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
        $piece_10->size = "XS";
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
        $piece_11->size = "XS";
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
        $piece_12->size = "US 6";
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
        $piece_13->size = "-";
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
        $piece_14->size = "US 6";
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
        $piece_1->size = "XS";
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
        $piece_2->size = "XS";
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
        $piece_3->size = "US 7";
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
        $piece_4->size = "XS";
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
        $piece_5->size = "XS";
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
        $piece_6->size = "XS";
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
        $piece_7->size = "Free";
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
        $piece_8->size = "XS";
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
        $piece_9->size = "US 7";
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
        $piece_1->size = "S";
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
        $piece_2->size = "S";
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
        $piece_3->size = "US 8";
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
        $piece_4->size = "XS";
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
        $piece_5->size = "S";
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
        $piece_6->size = "US 8";
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
        $piece_7->size = "S";
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
        $piece_8->size = "S";
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
        $piece_9->size = "US 8";
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
        $piece_1 = Piece::find(9);  // jasmine's outfit 3 hat
        $piece_2 = Piece::find(10); // jasmine's outfit 3 top
        $piece_3 = Piece::find(14); // tingzhi's outfit 1 bottom
        $piece_4 = Piece::find(12); // jasmine's outfit 3 shoes

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
        $outfit_1->inspiredBy()->associate(User::find(1)); // inspired by jasmine, cecilia was browsing jasmine's outfits
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
        $piece_1->size = "S";
        $piece_1->type = "TOP";
        $piece_1->is_dress = false;
        $piece_1->position = "2";
        $piece_1->height = 638.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 638.0;

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
        $piece_2->size = "S";
        $piece_2->type = "BOTTOM";
        $piece_2->is_dress = false;
        $piece_2->position = "3";
        $piece_2->height = 523.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 523.0;

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
        $piece_3->size = "S";
        $piece_3->type = "FEET";
        $piece_3->is_dress = false;
        $piece_3->position = "4";
        $piece_3->height = 477.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 477.0;

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
        $outfit_1->user()->associate($user);
        $outfit_1->save();

        $outfit_1->pieces()->save($piece_1);
        $outfit_1->pieces()->save($piece_2);
        $outfit_1->pieces()->save($piece_3);
    }
}