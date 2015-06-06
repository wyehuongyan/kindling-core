<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;

class ShopTableSeeder extends Seeder {

    public function run()
    {
        // empty the shops table first
        DB::table('shops')->delete();

        // jasmine owns sprubix shop
        $owner = User::find(1);

        // shop 1
        $user = new User();
        $user->username = "sprubixshop";
        $user->email = "developers@sprubix.com";
        $user->password = bcrypt("password");
        $user->name = "Sprubix Shop";
        $user->image = "https://d33m37h1i2d8gt.cloudfront.net/users/4/profile_display_user4_sprubixshop.jpg";
        $user->cover = "https://d33m37h1i2d8gt.cloudfront.net/users/4/profile_cover_user4_sprubixshop.jpg";
        $user->save();

        // // polymorphic shop 1
        $shop = new Shop();
        $shop->save();
        $shop->user()->save($user);

        $shop->owner()->associate($user);
        $shop->save();
    }
}