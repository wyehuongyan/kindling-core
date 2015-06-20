<?php

use Illuminate\Database\Seeder;
use App\Models\PieceBrand;

class PieceBrandTableSeeder extends Seeder {

    public function run()
    {
        // empty the piece brand table first
        DB::table('piece_brands')->delete();

        $brand_1 = new PieceBrand(); // 1
        $brand_1->name = "Chanel";
        $brand_1->save();

        $brand_2 = new PieceBrand(); // 2
        $brand_2->name = "Forever 21";
        $brand_2->save();

        $brand_3 = new PieceBrand(); // 3
        $brand_3->name = "Pull&Bear";
        $brand_3->save();

        $brand_4 = new PieceBrand(); // 4
        $brand_4->name = "Marc by Marc Jacobs";
        $brand_4->save();

        $brand_5 = new PieceBrand(); // 5
        $brand_5->name = "Gucci";
        $brand_5->save();

        $brand_6 = new PieceBrand(); // 6
        $brand_6->name = "Converse";
        $brand_6->save();

        $brand_7 = new PieceBrand(); // 7
        $brand_7->name = "River Island";
        $brand_7->save();

        $brand_8 = new PieceBrand(); // 8
        $brand_8->name = "Topshop";
        $brand_8->save();

        $brand_9 = new PieceBrand(); // 9
        $brand_9->name = "H&M";
        $brand_9->save();

        $brand_10 = new PieceBrand(); // 10
        $brand_10->name = "American Apparel";
        $brand_10->save();

        $brand_11 = new PieceBrand(); // 11
        $brand_11->name = "Vans";
        $brand_11->save();

        $brand_12 = new PieceBrand(); // 12
        $brand_12->name = "Uniqlo";
        $brand_12->save();

        $brand_13 = new PieceBrand(); // 13
        $brand_13->name = "Nordstorm";
        $brand_13->save();

        $brand_14 = new PieceBrand(); // 14
        $brand_14->name = "Nike";
        $brand_14->save();

        $brand_15 = new PieceBrand(); // 15
        $brand_15->name = "ASOS";
        $brand_15->save();

        $brand_16 = new PieceBrand(); // 16
        $brand_16->name = "New Look";
        $brand_16->save();

        $brand_17 = new PieceBrand(); // 17
        $brand_17->name = "Urban Outfitters";
        $brand_17->save();
    }
}