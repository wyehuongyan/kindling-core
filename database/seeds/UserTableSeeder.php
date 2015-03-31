<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // empty the users table first
        DB::table('users')->delete();

        $user = new User();
        $user->username = "developers";
        $user->email = "developers@sprubix.com";
        $user->password = bcrypt("password");
        $user->save();
    }

}