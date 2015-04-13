<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // empty the users table first
        DB::table('users')->delete();

        // user 1
        $user_1 = new User();
        $user_1->username = "jasmine";
        $user_1->email = "developers@sprubix.com";
        $user_1->password = bcrypt("password");
        $user_1->name = "Jasmine";
        $user_1->image = "https://sprubixtest.s3.amazonaws.com/users/1/profile_display_user1_jasmine.jpg";
        $user_1->cover = "https://sprubixtest.s3.amazonaws.com/users/1/profile_cover_user1_jasmine.jpg";
        $user_1->save();

        // user 2
        $user_2 = new User();
        $user_2->username = "tingzhi";
        $user_2->email = "tingzhi@example.com";
        $user_2->password = bcrypt("password");
        $user_2->name = "TingZhi";
        $user_2->image = "https://sprubixtest.s3.amazonaws.com/users/2/profile_display_user2_tingzhi.jpg";
        $user_2->cover = "https://sprubixtest.s3.amazonaws.com/users/2/profile_cover_user2_tingzhi.jpg";
        $user_2->save();

        // user 3
        $user_3 = new User();
        $user_3->username = "cecilia";
        $user_3->email = "cecilia@example.com";
        $user_3->password = bcrypt("password");
        $user_3->name = "Cecilia";
        $user_3->image = "https://sprubixtest.s3.amazonaws.com/users/3/profile_display_user3_cecilia.jpg";
        $user_3->cover = "https://sprubixtest.s3.amazonaws.com/users/3/profile_cover_user3_cecilia.jpg";
        $user_3->save();
    }

}