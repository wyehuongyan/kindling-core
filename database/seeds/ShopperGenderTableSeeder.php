<?php

use Illuminate\Database\Seeder;
use App\Models\ShopperGender;

class ShopperGenderTableSeeder extends Seeder {

    public function run()
    {
        // empty the shopper gender table first
        DB::table('shopper_gender')->delete();

        $male = new ShopperGender();
        $male->gender = "Male";
        $male->save();

        $female = new ShopperGender();
        $female->gender = "Female";
        $female->save();

        $other = new ShopperGender();
        $other->gender = "Other";
        $other->save();
    }
}