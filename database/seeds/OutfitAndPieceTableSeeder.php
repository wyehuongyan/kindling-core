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
        $piece_1->name = "Eyeglasses";
        $piece_1->description = "Oversized square acetate Sunglasses with patent calfskin temples and CC signature";
        $piece_1->category = "Accessory";
        $piece_1->brand = "Chanel";
        $piece_1->size = "-";
        $piece_1->type = "HEAD";
        $piece_1->position = "1";
        $piece_1->height = 234.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 234.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_head.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_head.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_head.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_head.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_head.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_head.jpg";

        $media->images = array($image);

        $piece_1->images = json_encode($media);
        $piece_1->save();

        $piece_1->user()->associate($user);
        $piece_1->save();

        // u1p2

        $piece_2 = new Piece();
        $piece_2->name = "White Crop Top";
        $piece_2->description = "This sleeveless top features a chic print. Perfect to pair with anything high-waisted for a fun warm-weather look.";
        $piece_2->category = "Top";
        $piece_2->brand = "Forever 21";
        $piece_2->size = "XS";
        $piece_2->type = "TOP";
        $piece_2->position = "2";
        $piece_2->height = 286.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 286.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_top.jpg";

        $media->images = array($image);

        $piece_2->images = json_encode($media);
        $piece_2->save();

        $piece_2->user()->associate($user);
        $piece_2->save();

        // u1p3

        $piece_3 = new Piece();
        $piece_3->name = "Ripped Mid Wash Short";
        $piece_3->description = "Stretch cotton denim\nMid-rise waist\nFly fastening\nClassic five pocket design";
        $piece_3->category = "Pants";
        $piece_3->brand = "Pull&Bear";
        $piece_3->size = "XS";
        $piece_3->type = "BOTTOM";
        $piece_3->position = "3";
        $piece_3->height = 262.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 262.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_bot.jpg";

        $media->images = array($image);

        $piece_3->images = json_encode($media);
        $piece_3->save();

        $piece_3->user()->associate($user);
        $piece_3->save();

        // u1p4

        $piece_4 = new Piece();
        $piece_4->name = "Black Nubuck Cat Loafers";
        $piece_4->description = "Nubuck leather loafers in black. Round toe. Cat detailing at toe in black and white buffed leather.";
        $piece_4->category = "Shoes";
        $piece_4->brand = "Marc by Marc Jacobs";
        $piece_4->size = "US 6";
        $piece_4->type = "FEET";
        $piece_4->position = "4";
        $piece_4->height = 190.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 190.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit1_shoes.jpg";

        $media->images = array($image);

        $piece_4->images = json_encode($media);
        $piece_4->save();

        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Sunglasses";
        $piece_5->description = "Black acetate frames with metal rivets\nMetal GG logo on the tips\nGrey lens\n100% UVA/UVB protection";
        $piece_5->category = "Accessory";
        $piece_5->brand = "Gucci";
        $piece_5->size = "-";
        $piece_5->type = "HEAD";
        $piece_5->position = "1";
        $piece_5->height = 228.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 228.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_head.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_head.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_head.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_head.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_head.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_head.jpg";

        $media->images = array($image);

        $piece_5->images = json_encode($media);
        $piece_5->save();

        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Boxy Striped Top";
        $piece_6->description = "We gave this boxy short-sleeved top a classic print of nautical stripes, but textured them subtly for a rope-like effect.";
        $piece_6->category = "Top";
        $piece_6->brand = "Forever 21";
        $piece_6->size = "XS";
        $piece_6->type = "TOP";
        $piece_6->position = "2";
        $piece_6->height = 293.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 293.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_top.jpg";

        $media->images = array($image);

        $piece_6->images = json_encode($media);
        $piece_6->save();

        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Cuffed Denim Shorts";
        $piece_7->description = "This pair features a cuffed hem and a buttoned fly. Wear it to flea markets, brunch, and everywhere in between.";
        $piece_7->category = "Pants";
        $piece_7->brand = "Forever 21";
        $piece_7->size = "XS";
        $piece_7->type = "BOTTOM";
        $piece_7->position = "3";
        $piece_7->height = 289.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 289.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_bot.jpg";

        $media->images = array($image);

        $piece_7->images = json_encode($media);
        $piece_7->save();

        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Anchor Print Chuck Taylor Sneaker";
        $piece_8->description = "\nLace-up front with D-rings\nCanvas lining, cushioning insole\nRubber midsole\nRubber traction outsole.";
        $piece_8->category = "Shoes";
        $piece_8->brand = "Converse";
        $piece_8->size = "US 6";
        $piece_8->type = "FEET";
        $piece_8->position = "4";
        $piece_8->height = 229.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 229.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit2_shoes.jpg";

        $media->images = array($image);

        $piece_8->images = json_encode($media);
        $piece_8->save();

        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Black Floppy Hat";
        $piece_9->description = "Equally great for creating a shady respite from intense rays and looking just plain cool, this laid-back fedora is crafted from durable paper straw and finished with a sleek contrast hat band.";
        $piece_9->category = "Hat";
        $piece_9->brand = "Forever 21";
        $piece_9->size = "-";
        $piece_9->type = "HEAD";
        $piece_9->position = "1";
        $piece_9->height = 216.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 216.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_head.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_head.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_head.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_head.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_head.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_head.jpg";

        $media->images = array($image);

        $piece_9->images = json_encode($media);
        $piece_9->save();

        $piece_9->user()->associate($user);
        $piece_9->save();

        // u1p10

        $piece_10 = new Piece();
        $piece_10->name = "Grey Crop Top";
        $piece_10->description = "Reflecting its logo, this plain grey tee has a clean and simple design. Fitted, with short sleeves and a round neck, it's an effortlessly chic weekend option.";
        $piece_10->category = "Top";
        $piece_10->brand = "River Island";
        $piece_10->size = "XS";
        $piece_10->type = "TOP";
        $piece_10->position = "2";
        $piece_10->height = 325.0;
        $piece_10->width = 750.0;
        $piece_10->aspectRatio = 750.0 / 325.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_top.jpg";

        $media->images = array($image);

        $piece_10->images = json_encode($media);
        $piece_10->save();

        $piece_10->user()->associate($user);
        $piece_10->save();

        // u1p11

        $piece_11 = new Piece();
        $piece_11->name = "White Daisy Shorts";
        $piece_11->description = "MOTO white denim low rise shorts with multiple pockets, cut-off hem and classic trims. 98% Cotton, 2% Elastane. Machine wash.";
        $piece_11->category = "Pants";
        $piece_11->brand = "Topshop";
        $piece_11->size = "XS";
        $piece_11->type = "BOTTOM";
        $piece_11->position = "3";
        $piece_11->height = 275.0;
        $piece_11->width = 750.0;
        $piece_11->aspectRatio = 750.0 / 275.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_bot.jpg";

        $media->images = array($image);

        $piece_11->images = json_encode($media);
        $piece_11->save();

        $piece_11->user()->associate($user);
        $piece_11->save();

        // u1p12

        $piece_12 = new Piece();
        $piece_12->name = "Chuck Taylor Classic";
        $piece_12->description = "The Chuck Taylor All Star is the most iconic sneaker in the world, recognized for its unmistakable silhouette and cultural authenticity.";
        $piece_12->category = "Shoes";
        $piece_12->brand = "Converse";
        $piece_12->size = "US 6";
        $piece_12->type = "FEET";
        $piece_12->position = "4";
        $piece_12->height = 192.0;
        $piece_12->width = 750.0;
        $piece_12->aspectRatio = 750.0 / 192.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/1/user1_outfit3_shoes.jpg";

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
        $outfit_1->description = "Great outfit for a sunny day.";
        $outfit_1->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/1/user1_outfit1.jpg";
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
        $outfit_2->description = "Wearing this for a BBQ party by the beach.";
        $outfit_2->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/1/user1_outfit2.jpg";
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
        $outfit_3->description = "Going to the Gardens by the Bay.";
        $outfit_3->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/1/user1_outfit3.jpg";
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
        $piece_1->name = "Keep the Wild in You Tank Top";
        $piece_1->description = "Each shirt is created by hand using a professional screen printing process. We work with New Avenues INK in Portland.";
        $piece_1->category = "Top";
        $piece_1->brand = "Topshop";
        $piece_1->size = "XS";
        $piece_1->type = "TOP";
        $piece_1->position = "2";
        $piece_1->height = 437.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 437.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_top.jpg";

        $media->images = array($image);

        $piece_1->images = json_encode($media);
        $piece_1->save();

        $piece_1->user()->associate($user);
        $piece_1->save();

        // u2p2

        $piece_2 = new Piece();
        $piece_2->name = "High-Waisted Knit Shorts";
        $piece_2->description = "These ribbed knit shorts feature a high-waist and zippered back.";
        $piece_2->category = "Pants";
        $piece_2->brand = "Forever 21";
        $piece_2->size = "XS";
        $piece_2->type = "BOTTOM";
        $piece_2->position = "3";
        $piece_2->height = 275.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 275.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_bot.jpg";

        $media->images = array($image);

        $piece_2->images = json_encode($media);
        $piece_2->save();

        $piece_2->user()->associate($user);
        $piece_2->save();

        // u2p3

        $piece_3 = new Piece();
        $piece_3->name = "Chuck Taylor Classic";
        $piece_3->description = "The Chuck Taylor All Star is the most iconic sneaker in the world, recognized for its unmistakable silhouette and cultural authenticity.";
        $piece_3->category = "Shoes";
        $piece_3->brand = "Converse";
        $piece_3->size = "US 7";
        $piece_3->type = "FEET";
        $piece_3->position = "4";
        $piece_3->height = 228.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 228.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit1_shoes.jpg";

        $media->images = array($image);

        $piece_3->images = json_encode($media);
        $piece_3->save();

        $piece_3->user()->associate($user);
        $piece_3->save();


        // u2p4

        $piece_4 = new Piece();
        $piece_4->name = "Stripe Pullover";
        $piece_4->description = "Made with recycled cotton yarn, this sweater features contrasting stripes on body and sleeves.";
        $piece_4->category = "Top";
        $piece_4->brand = "American Apparel";
        $piece_4->size = "XS";
        $piece_4->type = "TOP";
        $piece_4->position = "2";
        $piece_4->height = 380.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 380.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_top.jpg";

        $media->images = array($image);

        $piece_4->images = json_encode($media);
        $piece_4->save();

        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Medium Wash High-Waist Jean Cuff Short";
        $piece_5->description = "Introducing American Apparel Jeans! A classic style and wash unlike anything else that's been on the market for the last 15 years.";
        $piece_5->category = "Pants";
        $piece_5->brand = "American Apparel";
        $piece_5->size = "XS";
        $piece_5->type = "BOTTOM";
        $piece_5->position = "3";
        $piece_5->height = 265.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 265.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_bot.jpg";

        $media->images = array($image);

        $piece_5->images = json_encode($media);
        $piece_5->save();

        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Customized Converse Shoes";
        $piece_6->description = "Make your own sneakers 24K gold. Gold acrylic paint, gold liquid gilding and mod podge.";
        $piece_6->category = "Shoes";
        $piece_6->brand = "Converse";
        $piece_6->size = "XS";
        $piece_6->type = "FEET";
        $piece_6->position = "4";
        $piece_6->height = 214.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 214.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit2_shoes.jpg";

        $media->images = array($image);

        $piece_6->images = json_encode($media);
        $piece_6->save();

        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Pullover Hoodie";
        $piece_7->description = "Pullover, made of 60% cotton/40% polyester, is a 280gm fleece pullover hooded sweatshirt.";
        $piece_7->category = "Top";
        $piece_7->brand = "Vans";
        $piece_7->size = "Free";
        $piece_7->type = "TOP";
        $piece_7->position = "2";
        $piece_7->height = 408.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 408.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_top.jpg";

        $media->images = array($image);

        $piece_7->images = json_encode($media);
        $piece_7->save();

        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Chino Shorts";
        $piece_8->description = "These chino shorts made with soft fabric feel light and cool. They're perfect for a feminine look when you're on the run. Available in cool seasonal colors.";
        $piece_8->category = "Pants";
        $piece_8->brand = "Uniqlo";
        $piece_8->size = "XS";
        $piece_8->type = "BOTTOM";
        $piece_8->position = "3";
        $piece_8->height = 221.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 221.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_bot.jpg";

        $media->images = array($image);

        $piece_8->images = json_encode($media);
        $piece_8->save();

        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Vans Brigata Slim";
        $piece_9->description = "Sure up your style with the casual cool of the Vans Brigata Slim shoe! Nautically-inspired silhouette with a slim profile. Durable four-eyelet canvas upper.";
        $piece_9->category = "Shoes";
        $piece_9->brand = "Vans";
        $piece_9->size = "US 7";
        $piece_9->type = "FEET";
        $piece_9->position = "4";
        $piece_9->height = 225.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 225.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/2/user2_outfit3_shoes.jpg";

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
        $outfit_1->description = "Love this top so much. I belong to the wild!!!";
        $outfit_1->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/2/user2_outfit1.jpg";
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
        $outfit_2->description = "Outfit of the day, with my self-made golden shoes.";
        $outfit_2->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/2/user2_outfit2.jpg";
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
        $outfit_3->description = "Here's how I combat the cold labs in the school.";
        $outfit_3->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/2/user2_outfit3.jpg";
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
        $piece_1->name = "Spaghetti Strap Tank Top";
        $piece_1->description = "Fitted tank top in soft jersey with narrow adjustable straps.";
        $piece_1->category = "Top";
        $piece_1->brand = "H&M";
        $piece_1->size = "S";
        $piece_1->type = "TOP";
        $piece_1->position = "2";
        $piece_1->height = 349.0;
        $piece_1->width = 750.0;
        $piece_1->aspectRatio = 750.0 / 349.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_top.jpg";

        $media->images = array($image);

        $piece_1->images = json_encode($media);
        $piece_1->save();

        $piece_1->user()->associate($user);
        $piece_1->save();

        // u2p2

        $piece_2 = new Piece();
        $piece_2->name = "Plaid Jacquard Full Skirt";
        $piece_2->description = "Inverted front pleating adds classic feminine flare to a red skirt tailored from graphic plaid jacquard.";
        $piece_2->category = "Skirt";
        $piece_2->brand = "Nordstorm";
        $piece_2->size = "S";
        $piece_2->type = "BOTTOM";
        $piece_2->position = "3";
        $piece_2->height = 350.0;
        $piece_2->width = 750.0;
        $piece_2->aspectRatio = 750.0 / 350.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_bot.jpg";

        $media->images = array($image);

        $piece_2->images = json_encode($media);
        $piece_2->save();

        $piece_2->user()->associate($user);
        $piece_2->save();

        // u2p3

        $piece_3 = new Piece();
        $piece_3->name = "Nike Stefan Janoski Premium";
        $piece_3->description = "Buy Nike SB Stefan Janoski Premium pro skate shoes in Digital Floral-Camo. In-store only colourway available in limited numbers.";
        $piece_3->category = "Shoes";
        $piece_3->brand = "Nike";
        $piece_3->size = "US 8";
        $piece_3->type = "FEET";
        $piece_3->position = "4";
        $piece_3->height = 256.0;
        $piece_3->width = 750.0;
        $piece_3->aspectRatio = 750.0 / 256.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit1_shoes.jpg";

        $media->images = array($image);

        $piece_3->images = json_encode($media);
        $piece_3->save();

        $piece_3->user()->associate($user);
        $piece_3->save();


        // u2p4

        $piece_4 = new Piece();
        $piece_4->name = "White Spaghetti Strap Lace Vest";
        $piece_4->description = "Hot Tops! 2014 New Summer Fashion.";
        $piece_4->category = "Top";
        $piece_4->brand = "American Apparel";
        $piece_4->size = "XS";
        $piece_4->type = "TOP";
        $piece_4->position = "2";
        $piece_4->height = 308.0;
        $piece_4->width = 750.0;
        $piece_4->aspectRatio = 750.0 / 308.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_top.jpg";

        $media->images = array($image);

        $piece_4->images = json_encode($media);
        $piece_4->save();

        $piece_4->user()->associate($user);
        $piece_4->save();

        // u1p5

        $piece_5 = new Piece();
        $piece_5->name = "Asymmetrical Long Skirt";
        $piece_5->description = "A yoke of stretchy smocking fits smoothly over the top of a long, A-line skirt cut from cool and breathable linen chambray and finished with a breezy asymmetrical hem.";
        $piece_5->category = "Skirt";
        $piece_5->brand = "Nordstorm";
        $piece_5->size = "S";
        $piece_5->type = "BOTTOM";
        $piece_5->position = "3";
        $piece_5->height = 504.0;
        $piece_5->width = 750.0;
        $piece_5->aspectRatio = 750.0 / 504.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_bot.jpg";

        $media->images = array($image);

        $piece_5->images = json_encode($media);
        $piece_5->save();

        $piece_5->user()->associate($user);
        $piece_5->save();

        // u1p6

        $piece_6 = new Piece();
        $piece_6->name = "Palm View Wide Fit High Heel";
        $piece_6->description = "Suede-look finish\nCut-away detailing\nPin buckle fastening\nSharp point toe";
        $piece_6->category = "Shoes";
        $piece_6->brand = "ASOS";
        $piece_6->size = "US 8";
        $piece_6->type = "FEET";
        $piece_6->position = "4";
        $piece_6->height = 254.0;
        $piece_6->width = 750.0;
        $piece_6->aspectRatio = 750.0 / 254.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit2_shoes.jpg";

        $media->images = array($image);

        $piece_6->images = json_encode($media);
        $piece_6->save();

        $piece_6->user()->associate($user);
        $piece_6->save();

        // u1p7

        $piece_7 = new Piece();
        $piece_7->name = "Loose Knit Sweater";
        $piece_7->description = "Oversized knit sweater in a cotton and linen blend.";
        $piece_7->category = "Top";
        $piece_7->brand = "H&M";
        $piece_7->size = "S";
        $piece_7->type = "TOP";
        $piece_7->position = "2";
        $piece_7->height = 389.0;
        $piece_7->width = 750.0;
        $piece_7->aspectRatio = 750.0 / 389.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_top.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_top.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_top.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_top.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_top.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_top.jpg";

        $media->images = array($image);

        $piece_7->images = json_encode($media);
        $piece_7->save();

        $piece_7->user()->associate($user);
        $piece_7->save();

        // u1p8

        $piece_8 = new Piece();
        $piece_8->name = "Black Tartan Skirt";
        $piece_8->description = "Show off a shapely silhouette in this structured bonded skirt. Comes with a fixed waistband, zip fastening and bold grint print for added edge.";
        $piece_8->category = "Skirt";
        $piece_8->brand = "New Look";
        $piece_8->size = "S";
        $piece_8->type = "BOTTOM";
        $piece_8->position = "3";
        $piece_8->height = 315.0;
        $piece_8->width = 750.0;
        $piece_8->aspectRatio = 750.0 / 315.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_bot.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_bot.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_bot.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_bot.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_bot.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_bot.jpg";

        $media->images = array($image);

        $piece_8->images = json_encode($media);
        $piece_8->save();

        $piece_8->user()->associate($user);
        $piece_8->save();

        // u1p9

        $piece_9 = new Piece();
        $piece_9->name = "Silence + Noise Chunky Zipper Boot";
        $piece_9->description = "Ankle-length boots, from UO's own Silence + Noise label, crafted from rich nubuck leather. Propped up on a chunky heel and finished off with a side zip closure.";
        $piece_9->category = "Shoes";
        $piece_9->brand = "Urban Outfitters";
        $piece_9->size = "US 8";
        $piece_9->type = "FEET";
        $piece_9->position = "4";
        $piece_9->height = 266.0;
        $piece_9->width = 750.0;
        $piece_9->aspectRatio = 750.0 / 266.0;

        $media = new stdClass();
        $media->cover = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_shoes.jpg";

        $image = new stdClass();
        $image->thumbnail = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_shoes.jpg";
        $image->small = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_shoes.jpg";
        $image->medium = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_shoes.jpg";
        $image->large = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_shoes.jpg";
        $image->original = "http://d33m37h1i2d8gt.cloudfront.net/pieces/3/user3_outfit3_shoes.jpg";

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
        $outfit_1->description = "Everything looks good with my limited edition floral print Nike shoes.";
        $outfit_1->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/3/user3_outfit1.jpg";
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
        $outfit_2->description = "Off for a picnic :)";
        $outfit_2->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/3/user3_outfit2.jpg";
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
        $outfit_3->description = "Love my outfit of the day";
        $outfit_3->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/3/user3_outfit3.jpg";
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
        $outfit_1->description = "Looking good with red shorts.";
        $outfit_1->images = "http://d33m37h1i2d8gt.cloudfront.net/outfits/3/user3_outfit4.jpg";
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