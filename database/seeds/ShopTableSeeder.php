<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserGender;

class ShopTableSeeder extends Seeder {

    public function run()
    {
        // empty the shops table first
        DB::table('shops')->truncate();

        // cameron owns sprubix shop
        $owner = User::find(1);

        // shop 1
        $user = new User();
        $user->username = "sprubixshop";
        $user->email = "developers@sprubix.com";
        $user->password = bcrypt("password");
        $user->name = "Sprubix Shop";
        $user->image = cdn("/users/4/profile_display_user4_sprubixshop.jpg");
        $user->cover = cdn("/users/4/profile_cover_user4_sprubixshop_2.jpg");
        $user->save();

        // // polymorphic shop 1
        $shop = new Shop();
        $shop->save();
        $shop->user()->save($user);

        $shop->owner()->associate($user);
        $shop->save();

        // // shop 1 user info
        $user_info = new UserInfo();
        $user_info->first_name = "Sprubix";
        $user_info->gender()->associate(UserGender::find(3));
        $user_info->user()->associate($user);
        $user_info->save();
    }
}