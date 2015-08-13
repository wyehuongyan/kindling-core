<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shopper;
use App\Models\ShopperGender;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // empty the users table first
        DB::table('users')->truncate();
        DB::table('shoppers')->truncate();

        // user 1
        $user_1 = new User();
        $user_1->username = "cameron";
        $user_1->email = "cameron@example.com";
        $user_1->password = bcrypt("password");
        $user_1->name = "Cameron";
        $user_1->image = "https://d33m37h1i2d8gt.cloudfront.net/users/1/profile_display_user1_cameron.jpg";
        $user_1->cover = "https://d33m37h1i2d8gt.cloudfront.net/users/1/profile_cover_user1_cameron.jpg";
        $user_1->save();

        // // polymorphic shopper 1
        $shopper_1 = new Shopper();
        $shopper_1->first_name = "Cameron";
        $shopper_1->save();
        $shopper_1->gender()->associate(ShopperGender::find(2));
        $shopper_1->user()->save($user_1);
        $shopper_1->save();

        // user 2
        $user_2 = new User();
        $user_2->username = "tingzhi";
        $user_2->email = "tingzhi@example.com";
        $user_2->password = bcrypt("password");
        $user_2->name = "TingZhi";
        $user_2->image = "https://d33m37h1i2d8gt.cloudfront.net/users/2/profile_display_user2_tingzhi.jpg";
        $user_2->cover = "https://d33m37h1i2d8gt.cloudfront.net/users/2/profile_cover_user2_tingzhi.jpg";
        $user_2->save();

        // // polymorphic shopper 2
        $shopper_2 = new Shopper();
        $shopper_2->first_name = "TingZhi";
        $shopper_2->save();
        $shopper_2->gender()->associate(ShopperGender::find(2));
        $shopper_2->user()->save($user_2);
        $shopper_2->save();

        // user 3
        $user_3 = new User();
        $user_3->username = "cecilia";
        $user_3->email = "cecilia@example.com";
        $user_3->password = bcrypt("password");
        $user_3->name = "Cecilia";
        $user_3->image = "https://d33m37h1i2d8gt.cloudfront.net/users/3/profile_display_user3_cecilia.jpg";
        $user_3->cover = "https://d33m37h1i2d8gt.cloudfront.net/users/3/profile_cover_user3_cecilia.jpg";
        $user_3->save();

        // // polymorphic shopper 3
        $shopper_3 = new Shopper();
        $shopper_3->first_name = "Cecilia";
        $shopper_3->save();
        $shopper_3->gender()->associate(ShopperGender::find(2));
        $shopper_3->user()->save($user_3);
        $shopper_3->save();
    }

}