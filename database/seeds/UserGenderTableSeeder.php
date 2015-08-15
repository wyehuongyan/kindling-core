<?php

use Illuminate\Database\Seeder;
use App\Models\UserGender;

class UserGenderTableSeeder extends Seeder {

    public function run()
    {
        // empty the shopper gender table first
        DB::table('user_gender')->truncate();

        $male = new UserGender();
        $male->gender = "Male";
        $male->save();

        $female = new UserGender();
        $female->gender = "Female";
        $female->save();

        $other = new UserGender();
        $other->gender = "Other";
        $other->save();
    }
}