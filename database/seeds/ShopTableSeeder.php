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
        $user_1 = new User();
        $user_1->username = "sprubixshop";
        $user_1->email = "developers@sprubix.com";
        $user_1->password = bcrypt("password");
        $user_1->name = "Sprubix Shop";
        $user_1->image = cdn("/users/4/profile_display_user4_sprubixshop.jpg");
        $user_1->cover = cdn("/users/4/profile_cover_user4_sprubixshop_2.jpg");
        $user_1->save();

        // // polymorphic shop 1
        $shop = new Shop();
        $shop->save();
        $shop->user()->save($user_1);

        $shop->owner()->associate($user_1);
        $shop->save();

        // // shop 1 user info
        $user_info_1 = new UserInfo();
        $user_info_1->first_name = "Sprubix";
        $user_info_1->gender()->associate(UserGender::find(3));
        $user_info_1->user()->associate($user_1);
        $user_info_1->save();

        // shop 2
        $user_2 = new User();
        $user_2->username = "flufflea";
        $user_2->email = "shop@flufflea.com";
        $user_2->password = bcrypt("password");
        $user_2->name = "Flufflea";
        $user_2->image = cdn("/users/5/profile_display_user5_flufflea.jpg");
        $user_2->cover = cdn("/users/5/profile_cover_user5_flufflea.jpg");
        $user_2->save();

        // // polymorphic shop 2
        $shop = new Shop();
        $shop->save();
        $shop->user()->save($user_2);

        $shop->owner()->associate($user_2);
        $shop->save();

        // // shop 2 user info
        $user_info_2 = new UserInfo();
        $user_info_2->first_name = "Flufflea";
        $user_info_2->gender()->associate(UserGender::find(3));
        $user_info_2->user()->associate($user_2);
        $user_info_2->save();
    }
}