<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserGender;
use Carbon\Carbon;

class ShopTableSeeder extends Seeder {

    public function run()
    {
        if(env('APP_ENV') != "production") {
            // staging or local
            $this->staging();
        } else {
            // production
            $this->production();
        }
    }

    public function production() {
    }

    public function staging() {
        // empty the shops table first
        DB::table('shops')->truncate();

        // clear Mixpanel events queue
        $mixpanel = Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
        $mixpanel->reset();

        // cameron owns sprubix shop
        $owner = User::find(1);

        // shop 1
        $user_1 = new User();
        $user_1->username = "sprubixshop";
        $user_1->email = "developers@sprubix.com";
        $user_1->password = bcrypt("zxcvbnm.,?!'");
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

        // // shop 1 mixpanel
        $user_distinct_id_1 = strtoupper(uniqid()."-".dechex($user_1->id));
        $mixpanel->createAlias($user_distinct_id_1, $user_1->id);
        $mixpanel->people->set($user_1->id, array(
            '$email'                    => $user_1->email,
            'ID'                        => $user_1->id,
            'Username'                  => $user_1->username,
            '$first_name'               => $user_1->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_1,
            'Points'                    => 0,
            'Outfits Exposed'           => 0,
            'Pieces Exposed'            => 0,
            'Outfits Liked'             => 0,
            'Pieces Liked'              => 0,
            'Outfits Created'           => 0,
            'Pieces Created'            => 0,
            'Spruce Outfit'             => 0,
            'Spruce Outfit Swipe'       => 0,
            'Outfit Details Viewed'     => 0,
            'Piece Details Viewed'      => 0,
            'Outfit Comments Viewed'    => 0,
            'Piece Comments Viewed'     => 0
        ));

        $mixpanel->flush();

        // shop 2
        $user_2 = new User();
        $user_2->username = "flufflea";
        $user_2->email = "shop@flufflea.com";
        $user_2->password = bcrypt("zxcvbnm.,?!'");
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

        // // user 2 mixpanel
        $user_distinct_id_2 = strtoupper(uniqid()."-".dechex($user_2->id));
        $mixpanel->createAlias($user_distinct_id_2, $user_2->id);
        $mixpanel->people->set($user_2->id, array(
            '$email'                    => $user_2->email,
            'ID'                        => $user_2->id,
            'Username'                  => $user_2->username,
            '$first_name'               => $user_2->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_2,
            'Points'                    => 0,
            'Outfits Exposed'           => 0,
            'Pieces Exposed'            => 0,
            'Outfits Liked'             => 0,
            'Pieces Liked'              => 0,
            'Outfits Created'           => 0,
            'Pieces Created'            => 0,
            'Spruce Outfit'             => 0,
            'Spruce Outfit Swipe'       => 0,
            'Outfit Details Viewed'     => 0,
            'Piece Details Viewed'      => 0,
            'Outfit Comments Viewed'    => 0,
            'Piece Comments Viewed'     => 0
        ));

        $mixpanel->flush();
        $mixpanel->reset();
    }
}