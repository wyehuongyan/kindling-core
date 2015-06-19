<?php

use Illuminate\Database\Seeder;
use App\Models\PieceCategory;

class PieceCategoryTableSeeder extends Seeder {

    public function run()
    {
        // empty the piece category table first
        DB::table('piece_categories')->delete();

        $category_1 = new PieceCategory(); // 1
        $category_1->name = "Accessory";
        $category_1->save();

        $category_2 = new PieceCategory(); // 2
        $category_2->name = "Hat";
        $category_2->save();

        $category_3 = new PieceCategory(); // 3
        $category_3->name = "Top";
        $category_3->save();

        $category_4 = new PieceCategory(); // 4
        $category_4->name = "Dress";
        $category_4->save();

        $category_5 = new PieceCategory(); // 5
        $category_5->name = "Pants";
        $category_5->save();

        $category_6 = new PieceCategory(); // 6
        $category_6->name = "Skirt";
        $category_6->save();

        $category_7 = new PieceCategory(); // 7
        $category_7->name = "Shoes";
        $category_7->save();
    }
}