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
        if(env('APP_ENV') != "production") {
            // staging or local
            $this->staging();
        } else {
            // production
            $this->production();
        }
    }

    public function production() {
        // empty the users table first
        DB::table('users')->truncate();
        DB::table('shoppers')->truncate();
        DB::table('user_info')->truncate();

        // clear Mixpanel events queue
        $mixpanel = Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
        $mixpanel->reset();

        // user 1
        $user_1 = new User();
        $user_1->username = "sprubix";
        $user_1->email = "developers@sprubix.com";
        $user_1->password = bcrypt("sprubixpassword");
        $user_1->name = "Sprubix";
        $user_1->image = cdn("/users/1/user01_display.jpg");
        $user_1->cover = cdn("/users/1/user01_cover.jpg");
        $description = new \stdClass();
        $description->description = "Official Sprubix account.";
        $user_1->description = json_encode($description);
        $user_1->save();

        // // polymorphic shopper 1
        $shopper_1 = new Shopper();
        $shopper_1->save();
        $shopper_1->user()->save($user_1);
        $shopper_1->save();

        // // user 1 info
        $user_info_1 = new UserInfo();
        $user_info_1->first_name = "Sprubix";
        $user_info_1->gender()->associate(UserGender::find(3));
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
        $user_2->username = "chinhan";
        $user_2->email = "chinhan@sprubix.com";
        $user_2->password = bcrypt("chinhan");
        $user_2->name = "Chin Han";
        $user_2->image = cdn("/users/2/user02_display.jpg");
        $user_2->cover = cdn("/users/2/user02_cover.jpg");
        $user_2->facebook_account_id = "10153091949198499";
        $description = new \stdClass();
        $description->description = "Believes in singularity.";
        $user_2->description = json_encode($description);
        $user_2->save();

        // // polymorphic shopper 2
        $shopper_2 = new Shopper();
        $shopper_2->save();
        $shopper_2->user()->save($user_2);
        $shopper_2->save();

        // // user 2 info
        $user_info_2 = new UserInfo();
        $user_info_2->first_name = "Chin Han";
        $user_info_2->gender()->associate(UserGender::find(1));
        $user_info_2->user()->associate($user_2);
        $user_info_2->save();

        // // user 2 mixpanel
        $user_distinct_id_2 = (uniqid()."-".dechex($user_2->id));
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
        $user_3->username = "wyehuong";
        $user_3->email = "wyehuong@sprubix.com";
        $user_3->password = bcrypt("wyehuong");
        $user_3->name = "Wye Huong";
        $user_3->image = cdn("/users/3/user03_display.jpg");
        $user_3->cover = cdn("/users/3/user03_cover.jpg");
        $user_3->facebook_account_id = "10153082360907467";
        $description = new \stdClass();
        $description->description = "I build cool stuff, with incredible people.";
        $user_3->description = json_encode($description);
        $user_3->save();

        // // polymorphic shopper 3
        $shopper_3 = new Shopper();
        $shopper_3->save();
        $shopper_3->user()->save($user_3);
        $shopper_3->save();

        // // user 3 info
        $user_info_3 = new UserInfo();
        $user_info_3->first_name = "Wye Huong";
        $user_info_3->gender()->associate(UserGender::find(1));
        $user_info_3->user()->associate($user_3);
        $user_info_3->save();

        // // user 3 mixpanel
        $user_distinct_id_3 = (uniqid()."-".dechex($user_3->id));
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

        // user 4
        $user_4 = new User();
        $user_4->username = "alicewunderland";
        $user_4->email = "neatpresto@gmail.com";
        $user_4->password = bcrypt("sprubixpassword");
        $user_4->name = "Alice";
        $user_4->image = cdn("/users/4/user04_display.jpg");
        $user_4->cover = cdn("/users/4/user04_cover.jpg");
        $description = new \stdClass();
        $description->description = "Me and my wanderlust.";
        $user_4->description = json_encode($description);
        $user_4->save();

        // // polymorphic shopper 4
        $shopper_4 = new Shopper();
        $shopper_4->save();
        $shopper_4->user()->save($user_4);
        $shopper_4->save();

        // // user 4 info
        $user_info_4 = new UserInfo();
        $user_info_4->first_name = "Alice";
        $user_info_4->gender()->associate(UserGender::find(2));
        $user_info_4->user()->associate($user_4);
        $user_info_4->save();

        // // user 4 mixpanel
        $user_distinct_id_4 = (uniqid()."-".dechex($user_4->id));
        $mixpanel->createAlias($user_distinct_id_4, $user_4->id);
        $mixpanel->people->set($user_4->id, array(
            '$email'                    => $user_4->email,
            'ID'                        => $user_4->id,
            'Username'                  => $user_4->username,
            '$first_name'               => $user_4->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_4,
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

        // user 5
        $user_5 = new User();
        $user_5->username = "bellasugar";
        $user_5->email = "twigsrated@gmail.com";
        $user_5->password = bcrypt("sprubixpassword");
        $user_5->name = "Bella";
        $user_5->image = cdn("/users/5/user05_display.jpg");
        $user_5->cover = cdn("/users/5/user05_cover.jpg");
        $description = new \stdClass();
        $description->description = "Eat, laugh, sleep and shop.";
        $user_5->description = json_encode($description);
        $user_5->save();

        // // polymorphic shopper 5
        $shopper_5 = new Shopper();
        $shopper_5->save();
        $shopper_5->user()->save($user_5);
        $shopper_5->save();

        // // user 5 info
        $user_info_5 = new UserInfo();
        $user_info_5->first_name = "Bella";
        $user_info_5->gender()->associate(UserGender::find(2));
        $user_info_5->user()->associate($user_5);
        $user_info_5->save();

        // // user 5 mixpanel
        $user_distinct_id_5 = strtoupper(uniqid()."-".dechex($user_5->id));
        $mixpanel->createAlias($user_distinct_id_5, $user_5->id);
        $mixpanel->people->set($user_5->id, array(
            '$email'                    => $user_5->email,
            'ID'                        => $user_5->id,
            'Username'                  => $user_5->username,
            '$first_name'               => $user_5->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_5,
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

        // user 6
        $user_6 = new User();
        $user_6->username = "cassandragon";
        $user_6->email = "pochardfull@gmail.com";
        $user_6->password = bcrypt("sprubixpassword");
        $user_6->name = "Cassandra";
        $user_6->image = cdn("/users/6/user06_display.jpg");
        $user_6->cover = cdn("/users/6/user06_cover.jpg");
        $description = new \stdClass();
        $description->description = "Documenting the world\nwith heart for wandering.";
        $user_6->description = json_encode($description);
        $user_6->save();

        // // polymorphic shopper 6
        $shopper_6 = new Shopper();
        $shopper_6->save();
        $shopper_6->user()->save($user_6);
        $shopper_6->save();

        // // user 6 info
        $user_info_6 = new UserInfo();
        $user_info_6->first_name = "Cassandra";
        $user_info_6->gender()->associate(UserGender::find(2));
        $user_info_6->user()->associate($user_6);
        $user_info_6->save();

        // // user 6 mixpanel
        $user_distinct_id_6 = strtoupper(uniqid()."-".dechex($user_6->id));
        $mixpanel->createAlias($user_distinct_id_6, $user_6->id);
        $mixpanel->people->set($user_6->id, array(
            '$email'                    => $user_6->email,
            'ID'                        => $user_6->id,
            'Username'                  => $user_6->username,
            '$first_name'               => $user_6->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_6,
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

        // user 7
        $user_7 = new User();
        $user_7->username = "danielledoll";
        $user_7->email = "nickerplanck@gmail.com";
        $user_7->password = bcrypt("sprubixpassword");
        $user_7->name = "Danielle";
        $user_7->image = cdn("/users/7/user07_display.jpg");
        $user_7->cover = cdn("/users/7/user07_cover.jpg");
        $description = new \stdClass();
        $description->description = "Coloring my life\none photo at a time.";
        $user_7->description = json_encode($description);
        $user_7->save();

        // // polymorphic shopper 7
        $shopper_7 = new Shopper();
        $shopper_7->save();
        $shopper_7->user()->save($user_7);
        $shopper_7->save();

        // // user 7 info
        $user_info_7 = new UserInfo();
        $user_info_7->first_name = "Danielle";
        $user_info_7->gender()->associate(UserGender::find(2));
        $user_info_7->user()->associate($user_7);
        $user_info_7->save();

        // // user 7 mixpanel
        $user_distinct_id_7 = strtoupper(uniqid()."-".dechex($user_7->id));
        $mixpanel->createAlias($user_distinct_id_7, $user_7->id);
        $mixpanel->people->set($user_7->id, array(
            '$email'                    => $user_7->email,
            'ID'                        => $user_7->id,
            'Username'                  => $user_7->username,
            '$first_name'               => $user_7->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_7,
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

        // user 8
        $user_8 = new User();
        $user_8->username = "elsafreeze";
        $user_8->email = "chimpsfrost@gmail.com";
        $user_8->password = bcrypt("sprubixpassword");
        $user_8->name = "Elsa";
        $user_8->image = cdn("/users/8/user08_display.jpg");
        $user_8->cover = cdn("/users/8/user08_cover.jpg");
        $description = new \stdClass();
        $description->description = "Life has its ups and downs.";
        $user_8->description = json_encode($description);
        $user_8->save();

        // // polymorphic shopper 8
        $shopper_8 = new Shopper();
        $shopper_8->save();
        $shopper_8->user()->save($user_8);
        $shopper_8->save();

        // // user 8 info
        $user_info_8 = new UserInfo();
        $user_info_8->first_name = "Elsa";
        $user_info_8->gender()->associate(UserGender::find(2));
        $user_info_8->user()->associate($user_8);
        $user_info_8->save();

        // // user 8 mixpanel
        $user_distinct_id_8 = strtoupper(uniqid()."-".dechex($user_8->id));
        $mixpanel->createAlias($user_distinct_id_8, $user_8->id);
        $mixpanel->people->set($user_8->id, array(
            '$email'                    => $user_8->email,
            'ID'                        => $user_8->id,
            'Username'                  => $user_8->username,
            '$first_name'               => $user_8->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_8,
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

        // user 9
        $user_9 = new User();
        $user_9->username = "feliciangel";
        $user_9->email = "puffinswiss@gmail.com";
        $user_9->password = bcrypt("sprubixpassword");
        $user_9->name = "Felicia";
        $user_9->image = cdn("/users/9/user09_display.jpg");
        $user_9->cover = cdn("/users/9/user09_cover.jpg");
        $description = new \stdClass();
        $description->description = "Loves travelling, loves Japan.";
        $user_9->description = json_encode($description);
        $user_9->save();

        // // polymorphic shopper 9
        $shopper_9 = new Shopper();
        $shopper_9->save();
        $shopper_9->user()->save($user_9);
        $shopper_9->save();

        // // user 9 info
        $user_info_9 = new UserInfo();
        $user_info_9->first_name = "Felicia";
        $user_info_9->gender()->associate(UserGender::find(2));
        $user_info_9->user()->associate($user_9);
        $user_info_9->save();

        // // user 9 mixpanel
        $user_distinct_id_9 = strtoupper(uniqid()."-".dechex($user_9->id));
        $mixpanel->createAlias($user_distinct_id_9, $user_9->id);
        $mixpanel->people->set($user_9->id, array(
            '$email'                    => $user_9->email,
            'ID'                        => $user_9->id,
            'Username'                  => $user_9->username,
            '$first_name'               => $user_9->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_9,
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

        // user 10
        $user_10 = new User();
        $user_10->username = "gisellepixie";
        $user_10->email = "worthyspiced@gmail.com";
        $user_10->password = bcrypt("sprubixpassword");
        $user_10->name = "Giselle";
        $user_10->image = cdn("/users/10/user10_display.jpg");
        $user_10->cover = cdn("/users/10/user10_cover.jpg");
        $description = new \stdClass();
        $description->description = "A bit of a loner.\nRunning, music, tattoos are my passion!";
        $user_10->description = json_encode($description);
        $user_10->save();

        // // polymorphic shopper 10
        $shopper_10 = new Shopper();
        $shopper_10->save();
        $shopper_10->user()->save($user_10);
        $shopper_10->save();

        // // user 10 info
        $user_info_10 = new UserInfo();
        $user_info_10->first_name = "Giselle";
        $user_info_10->gender()->associate(UserGender::find(2));
        $user_info_10->user()->associate($user_10);
        $user_info_10->save();

        // // user 10 mixpanel
        $user_distinct_id_10 = strtoupper(uniqid()."-".dechex($user_10->id));
        $mixpanel->createAlias($user_distinct_id_10, $user_10->id);
        $mixpanel->people->set($user_10->id, array(
            '$email'                    => $user_10->email,
            'ID'                        => $user_10->id,
            'Username'                  => $user_10->username,
            '$first_name'               => $user_10->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_10,
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

        // user 11
        $user_11 = new User();
        $user_11->username = "helenmelon";
        $user_11->email = "milkymelonjuice@gmail.com";
        $user_11->password = bcrypt("sprubixpassword");
        $user_11->name = "Helen";
        $user_11->image = cdn("/users/11/user11_display.jpg");
        $user_11->cover = cdn("/users/11/user11_cover.jpg");
        $description = new \stdClass();
        $description->description = "Everything happens for a good reason.\nI'm one of them!";
        $user_11->description = json_encode($description);
        $user_11->save();

        // // polymorphic shopper 11
        $shopper_11 = new Shopper();
        $shopper_11->save();
        $shopper_11->user()->save($user_11);
        $shopper_11->save();

        // // user 11 info
        $user_info_11 = new UserInfo();
        $user_info_11->first_name = "Helen";
        $user_info_11->gender()->associate(UserGender::find(2));
        $user_info_11->user()->associate($user_11);
        $user_info_11->save();

        // // user 11 mixpanel
        $user_distinct_id_11 = strtoupper(uniqid()."-".dechex($user_11->id));
        $mixpanel->createAlias($user_distinct_id_11, $user_11->id);
        $mixpanel->people->set($user_11->id, array(
            '$email'                    => $user_11->email,
            'ID'                        => $user_11->id,
            'Username'                  => $user_11->username,
            '$first_name'               => $user_11->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_11,
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

        // user 12
        $user_12 = new User();
        $user_12->username = "ivyscotch";
        $user_12->email = "defiantbulb@gmail.com";
        $user_12->password = bcrypt("sprubixpassword");
        $user_12->name = "Ivy";
        $user_12->image = cdn("/users/12/user12_display.jpg");
        $user_12->cover = cdn("/users/12/user12_cover.jpg");
        $description = new \stdClass();
        $description->description = "All about travel, food, \nculture, events and music.";
        $user_12->description = json_encode($description);
        $user_12->save();

        // // polymorphic shopper 12
        $shopper_12 = new Shopper();
        $shopper_12->save();
        $shopper_12->user()->save($user_12);
        $shopper_12->save();

        // // user 12 info
        $user_info_12 = new UserInfo();
        $user_info_12->first_name = "Ivy";
        $user_info_12->gender()->associate(UserGender::find(2));
        $user_info_12->user()->associate($user_12);
        $user_info_12->save();

        // // user 12 mixpanel
        $user_distinct_id_12 = strtoupper(uniqid()."-".dechex($user_12->id));
        $mixpanel->createAlias($user_distinct_id_12, $user_12->id);
        $mixpanel->people->set($user_12->id, array(
            '$email'                    => $user_12->email,
            'ID'                        => $user_12->id,
            'Username'                  => $user_12->username,
            '$first_name'               => $user_12->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_12,
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

        // user 13
        $user_13 = new User();
        $user_13->username = "jessicaroll";
        $user_13->email = "jubilantlittle@gmail.com";
        $user_13->password = bcrypt("sprubixpassword");
        $user_13->name = "Jessica";
        $user_13->image = cdn("/users/13/user13_display.jpg");
        $user_13->cover = cdn("/users/13/user13_cover.jpg");
        $description = new \stdClass();
        $description->description = "Love the life you live,\nlive the life you love.";
        $user_13->description = json_encode($description);
        $user_13->save();

        // // polymorphic shopper 10
        $shopper_13 = new Shopper();
        $shopper_13->save();
        $shopper_13->user()->save($user_13);
        $shopper_13->save();

        // // user 13 info
        $user_info_13 = new UserInfo();
        $user_info_13->first_name = "Jessica";
        $user_info_13->gender()->associate(UserGender::find(2));
        $user_info_13->user()->associate($user_13);
        $user_info_13->save();

        // // user 13 mixpanel
        $user_distinct_id_13 = strtoupper(uniqid()."-".dechex($user_13->id));
        $mixpanel->createAlias($user_distinct_id_13, $user_13->id);
        $mixpanel->people->set($user_13->id, array(
            '$email'                    => $user_13->email,
            'ID'                        => $user_13->id,
            'Username'                  => $user_13->username,
            '$first_name'               => $user_13->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_13,
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

        // user 14
        $user_14 = new User();
        $user_14->username = "katiecat";
        $user_14->email = "pancakebuzzer@gmail.com";
        $user_14->password = bcrypt("sprubixpassword");
        $user_14->name = "Katie";
        $user_14->image = cdn("/users/14/user14_display.jpg");
        $user_14->cover = cdn("/users/14/user14_cover.jpg");
        $description = new \stdClass();
        $description->description = "Be the change you want to see\nin the world.";
        $user_14->description = json_encode($description);
        $user_14->save();

        // // polymorphic shopper 14
        $shopper_14 = new Shopper();
        $shopper_14->save();
        $shopper_14->user()->save($user_14);
        $shopper_14->save();

        // // user 14 info
        $user_info_14 = new UserInfo();
        $user_info_14->first_name = "Katie";
        $user_info_14->gender()->associate(UserGender::find(2));
        $user_info_14->user()->associate($user_14);
        $user_info_14->save();

        // // user 14 mixpanel
        $user_distinct_id_14 = strtoupper(uniqid()."-".dechex($user_14->id));
        $mixpanel->createAlias($user_distinct_id_14, $user_14->id);
        $mixpanel->people->set($user_14->id, array(
            '$email'                    => $user_14->email,
            'ID'                        => $user_14->id,
            'Username'                  => $user_14->username,
            '$first_name'               => $user_14->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_14,
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

        // user 15
        $user_15 = new User();
        $user_15->username = "lucilalace";
        $user_15->email = "meltingbump@gmail.com";
        $user_15->password = bcrypt("sprubixpassword");
        $user_15->name = "Lucila";
        $user_15->image = cdn("/users/15/user15_display.jpg");
        $user_15->cover = cdn("/users/15/user15_cover.jpg");
        $description = new \stdClass();
        $description->description = "Happiness is not something ready-made,\nit comes from your actions.";
        $user_15->description = json_encode($description);
        $user_15->save();

        // // polymorphic shopper 15
        $shopper_15 = new Shopper();
        $shopper_15->save();
        $shopper_15->user()->save($user_15);
        $shopper_15->save();

        // // user 15 info
        $user_info_15 = new UserInfo();
        $user_info_15->first_name = "Lucila";
        $user_info_15->gender()->associate(UserGender::find(2));
        $user_info_15->user()->associate($user_15);
        $user_info_15->save();

        // // user 15 mixpanel
        $user_distinct_id_15 = strtoupper(uniqid()."-".dechex($user_15->id));
        $mixpanel->createAlias($user_distinct_id_15, $user_15->id);
        $mixpanel->people->set($user_15->id, array(
            '$email'                    => $user_15->email,
            'ID'                        => $user_15->id,
            'Username'                  => $user_15->username,
            '$first_name'               => $user_15->username,
            '$last_name'                =>  "",
            '$created'                  => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a"),
            'Distinct ID'               => $user_distinct_id_15,
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

    public function staging() {
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
        $user_1->password = bcrypt("zxcvbnm.,?!'");
        $user_1->name = "Cameron";
        $user_1->image = cdn("/users/1/profile_display_user1_cameron.jpg");
        $user_1->cover = cdn("/users/1/profile_cover_user1_cameron.jpg");
        $description = new \stdClass();
        $description->description = "Deciding what not to do is as\nimportant as deciding what to do.";
        $user_1->description = json_encode($description);
        $user_1->verified_at = Carbon::now();
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
        $user_2->password = bcrypt("zxcvbnm.,?!'");
        $user_2->name = "TingZhi";
        $user_2->image = cdn("/users/2/profile_display_user2_tingzhi.jpg");
        $user_2->cover = cdn("/users/2/profile_cover_user2_tingzhi.jpg");
        $description = new \stdClass();
        $description->description = "Sometimes life is going to hit\nyou in the head with a brick.\nDon't lose faith.";
        $user_2->description = json_encode($description);
        $user_2->verified_at = Carbon::now();
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
        $user_3->password = bcrypt("zxcvbnm.,?!'");
        $user_3->name = "Cecilia";
        $user_3->image = cdn("/users/3/profile_display_user3_cecilia.jpg");
        $user_3->cover = cdn("/users/3/profile_cover_user3_cecilia.jpg");
        $description = new \stdClass();
        $description->description = "We're here to put a dent in\nthe universe. Otherwise why\nelse even be here?";
        $user_3->description = json_encode($description);
        $user_3->verified_at = Carbon::now();
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