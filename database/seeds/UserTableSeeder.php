<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Shopper;
use App\Models\UserGender;
use Carbon\Carbon;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // empty the users table first
        DB::table('users')->truncate();
        DB::table('shoppers')->truncate();
        DB::table('user_info')->truncate();

        // clear Mixpanel events queue
        $mixpanel = Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
        $mixpanel->reset();

        // user 1
        $user_1 = new User();
        $user_1->username = "cameron";
        $user_1->email = "cameron@example.com";
        $user_1->password = bcrypt("password");
        $user_1->name = "Cameron";
        $user_1->image = cdn("/users/1/profile_display_user1_cameron.jpg");
        $user_1->cover = cdn("/users/1/profile_cover_user1_cameron.jpg");
        $user_1->save();

        // // polymorphic shopper 1
        $shopper_1 = new Shopper();
        $shopper_1->save();
        $shopper_1->user()->save($user_1);
        $shopper_1->save();

        // // user 1 info
        $user_info_1 = new UserInfo();
        $user_info_1->first_name = "Cameron";
        $user_info_1->gender()->associate(UserGender::find(2));
        $user_info_1->user()->associate($user_1);
        $user_info_1->save();

        // // user 1 mixpanel
        $user_distinct_id_1 = (uniqid()."-".dechex($user_1->id));
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

        // user 2
        $user_2 = new User();
        $user_2->username = "tingzhi";
        $user_2->email = "tingzhi@example.com";
        $user_2->password = bcrypt("password");
        $user_2->name = "TingZhi";
        $user_2->image = cdn("/users/2/profile_display_user2_tingzhi.jpg");
        $user_2->cover = cdn("/users/2/profile_cover_user2_tingzhi.jpg");
        $user_2->save();

        // // polymorphic shopper 2
        $shopper_2 = new Shopper();
        $shopper_2->save();
        $shopper_2->user()->save($user_2);
        $shopper_2->save();

        // // user 2 info
        $user_info_2 = new UserInfo();
        $user_info_2->first_name = "TingZhi";
        $user_info_2->gender()->associate(UserGender::find(2));
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

        // user 3
        $user_3 = new User();
        $user_3->username = "cecilia";
        $user_3->email = "cecilia@example.com";
        $user_3->password = bcrypt("password");
        $user_3->name = "Cecilia";
        $user_3->image = cdn("/users/3/profile_display_user3_cecilia.jpg");
        $user_3->cover = cdn("/users/3/profile_cover_user3_cecilia.jpg");
        $user_3->save();

        // // polymorphic shopper 3
        $shopper_3 = new Shopper();
        $shopper_3->save();
        $shopper_3->user()->save($user_3);
        $shopper_3->save();

        // // user 3 info
        $user_info_3 = new UserInfo();
        $user_info_3->first_name = "Cecilia";
        $user_info_3->gender()->associate(UserGender::find(2));
        $user_info_3->user()->associate($user_3);
        $user_info_3->save();

        // // user 3 mixpanel
        $user_distinct_id_3 = strtoupper(uniqid()."-".dechex($user_3->id));
        $mixpanel->createAlias($user_distinct_id_3, $user_3->id);
        $mixpanel->people->set($user_3->id, array(
            '$email'                    => $user_3->email,
            'ID'                        => $user_3->id,
            'Username'                  => $user_3->username,
            '$first_name'               => $user_3->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_3,
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