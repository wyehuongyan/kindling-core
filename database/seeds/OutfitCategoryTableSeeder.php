<?php

use Illuminate\Database\Seeder;
use App\Models\OutfitCategory;

class OutfitCategoryTableSeeder extends Seeder {

    public function run()
    {
        // empty the outfit category table first
        DB::table('outfit_categories')->delete();

        $category_1 = new OutfitCategory(); // 1
        $category_1->name = "Back to School";
        $category_1->save();

        $category_2 = new OutfitCategory(); // 2
        $category_2->name = "Work in Style";
        $category_2->save();

        $category_3 = new OutfitCategory(); // 3
        $category_3->name = "Party the Night";
        $category_3->save();

        $category_4 = new OutfitCategory(); // 4
        $category_4->name = "Weekend Chill Out";
        $category_4->save();
    }
}