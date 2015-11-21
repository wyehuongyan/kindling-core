<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowTableSeeder extends Seeder {

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
        // empty the follows table first
        DB::table('follows')->truncate();

        // retrieve users
        $user_1 = User::find(1);
        $user_2 = User::find(2);
        $user_3 = User::find(3);
        $user_4 = User::find(4);
        $user_5 = User::find(5);
        $user_6 = User::find(6);
        $user_7 = User::find(7);
        $user_8 = User::find(8);
        $user_9 = User::find(9);
        $user_10 = User::find(10);
        $user_11 = User::find(11);
        $user_12 = User::find(12);
        $user_13 = User::find(13);
        $user_14 = User::find(14);
        $user_15 = User::find(15);

        // by default, users follow themselves so mainfeed shows their own postings
        $user_1->following()->save($user_1);
        $user_2->following()->save($user_2);
        $user_3->following()->save($user_3);
        $user_4->following()->save($user_4);
        $user_5->following()->save($user_5);
        $user_6->following()->save($user_6);
        $user_7->following()->save($user_7);
        $user_8->following()->save($user_8);
        $user_9->following()->save($user_9);
        $user_10->following()->save($user_10);
        $user_11->following()->save($user_11);
        $user_12->following()->save($user_12);
        $user_13->following()->save($user_13);
        $user_14->following()->save($user_14);
        $user_15->following()->save($user_15);

        // all of them will follow sprubix (production)
        //// user 1
        $user_2->following()->save($user_1);
        $user_3->following()->save($user_1);
        $user_4->following()->save($user_1);
        $user_5->following()->save($user_1);
        $user_6->following()->save($user_1);
        $user_7->following()->save($user_1);
        $user_8->following()->save($user_1);
        $user_9->following()->save($user_1);
        $user_10->following()->save($user_1);
        $user_11->following()->save($user_1);
        $user_12->following()->save($user_1);
        $user_13->following()->save($user_1);
        $user_14->following()->save($user_1);
        $user_15->following()->save($user_1);

        // everyone follows each other
        //// user 4
        $user_1->following()->save($user_4);
        $user_2->following()->save($user_4);
        $user_3->following()->save($user_4);
        $user_5->following()->save($user_4);
        $user_6->following()->save($user_4);
        $user_7->following()->save($user_4);
        $user_8->following()->save($user_4);
        $user_9->following()->save($user_4);
        $user_10->following()->save($user_4);
        $user_11->following()->save($user_4);
        $user_12->following()->save($user_4);
        $user_13->following()->save($user_4);
        $user_14->following()->save($user_4);
        $user_15->following()->save($user_4);

        //// user 5
        $user_1->following()->save($user_5);
        $user_2->following()->save($user_5);
        $user_3->following()->save($user_5);
        $user_4->following()->save($user_5);
        $user_6->following()->save($user_5);
        $user_7->following()->save($user_5);
        $user_8->following()->save($user_5);
        $user_9->following()->save($user_5);
        $user_10->following()->save($user_5);
        $user_11->following()->save($user_5);
        $user_12->following()->save($user_5);
        $user_13->following()->save($user_5);
        $user_14->following()->save($user_5);
        $user_15->following()->save($user_5);

        //// user 6
        $user_1->following()->save($user_6);
        $user_2->following()->save($user_6);
        $user_3->following()->save($user_6);
        $user_4->following()->save($user_6);
        $user_5->following()->save($user_6);
        $user_7->following()->save($user_6);
        $user_8->following()->save($user_6);
        $user_9->following()->save($user_6);
        $user_10->following()->save($user_6);
        $user_11->following()->save($user_6);
        $user_12->following()->save($user_6);
        $user_13->following()->save($user_6);
        $user_14->following()->save($user_6);
        $user_15->following()->save($user_6);

        //// user 7
        $user_1->following()->save($user_7);
        $user_2->following()->save($user_7);
        $user_3->following()->save($user_7);
        $user_4->following()->save($user_7);
        $user_5->following()->save($user_7);
        $user_6->following()->save($user_7);
        $user_8->following()->save($user_7);
        $user_9->following()->save($user_7);
        $user_10->following()->save($user_7);
        $user_11->following()->save($user_7);
        $user_12->following()->save($user_7);
        $user_13->following()->save($user_7);
        $user_14->following()->save($user_7);
        $user_15->following()->save($user_7);

        //// user 8
        $user_1->following()->save($user_8);
        $user_2->following()->save($user_8);
        $user_3->following()->save($user_8);
        $user_4->following()->save($user_8);
        $user_5->following()->save($user_8);
        $user_6->following()->save($user_8);
        $user_7->following()->save($user_8);
        $user_9->following()->save($user_8);
        $user_10->following()->save($user_8);
        $user_11->following()->save($user_8);
        $user_12->following()->save($user_8);
        $user_13->following()->save($user_8);
        $user_14->following()->save($user_8);
        $user_15->following()->save($user_8);

        //// user 9
        $user_1->following()->save($user_9);
        $user_2->following()->save($user_9);
        $user_3->following()->save($user_9);
        $user_4->following()->save($user_9);
        $user_5->following()->save($user_9);
        $user_6->following()->save($user_9);
        $user_7->following()->save($user_9);
        $user_8->following()->save($user_9);
        $user_10->following()->save($user_9);
        $user_11->following()->save($user_9);
        $user_12->following()->save($user_9);
        $user_13->following()->save($user_9);
        $user_14->following()->save($user_9);
        $user_15->following()->save($user_9);

        //// user 10
        $user_1->following()->save($user_10);
        $user_2->following()->save($user_10);
        $user_3->following()->save($user_10);
        $user_4->following()->save($user_10);
        $user_5->following()->save($user_10);
        $user_6->following()->save($user_10);
        $user_7->following()->save($user_10);
        $user_8->following()->save($user_10);
        $user_9->following()->save($user_10);
        $user_11->following()->save($user_10);
        $user_12->following()->save($user_10);
        $user_13->following()->save($user_10);
        $user_14->following()->save($user_10);
        $user_15->following()->save($user_10);

        //// user 11
        $user_1->following()->save($user_11);
        $user_2->following()->save($user_11);
        $user_3->following()->save($user_11);
        $user_4->following()->save($user_11);
        $user_5->following()->save($user_11);
        $user_6->following()->save($user_11);
        $user_7->following()->save($user_11);
        $user_8->following()->save($user_11);
        $user_9->following()->save($user_11);
        $user_10->following()->save($user_11);
        $user_12->following()->save($user_11);
        $user_13->following()->save($user_11);
        $user_14->following()->save($user_11);
        $user_15->following()->save($user_11);

        //// user 12
        $user_1->following()->save($user_12);
        $user_2->following()->save($user_12);
        $user_3->following()->save($user_12);
        $user_4->following()->save($user_12);
        $user_5->following()->save($user_12);
        $user_6->following()->save($user_12);
        $user_7->following()->save($user_12);
        $user_8->following()->save($user_12);
        $user_9->following()->save($user_12);
        $user_10->following()->save($user_12);
        $user_11->following()->save($user_12);
        $user_13->following()->save($user_12);
        $user_14->following()->save($user_12);
        $user_15->following()->save($user_12);

        //// user 13
        $user_1->following()->save($user_13);
        $user_2->following()->save($user_13);
        $user_3->following()->save($user_13);
        $user_4->following()->save($user_13);
        $user_5->following()->save($user_13);
        $user_6->following()->save($user_13);
        $user_7->following()->save($user_13);
        $user_8->following()->save($user_13);
        $user_9->following()->save($user_13);
        $user_10->following()->save($user_13);
        $user_11->following()->save($user_13);
        $user_12->following()->save($user_13);
        $user_14->following()->save($user_13);
        $user_15->following()->save($user_13);

        //// user 14
        $user_1->following()->save($user_14);
        $user_2->following()->save($user_14);
        $user_3->following()->save($user_14);
        $user_4->following()->save($user_14);
        $user_5->following()->save($user_14);
        $user_6->following()->save($user_14);
        $user_7->following()->save($user_14);
        $user_8->following()->save($user_14);
        $user_9->following()->save($user_14);
        $user_10->following()->save($user_14);
        $user_11->following()->save($user_14);
        $user_12->following()->save($user_14);
        $user_13->following()->save($user_14);
        $user_15->following()->save($user_14);

        //// user 15
        $user_1->following()->save($user_15);
        $user_2->following()->save($user_15);
        $user_3->following()->save($user_15);
        $user_4->following()->save($user_15);
        $user_5->following()->save($user_15);
        $user_6->following()->save($user_15);
        $user_7->following()->save($user_15);
        $user_8->following()->save($user_15);
        $user_9->following()->save($user_15);
        $user_10->following()->save($user_15);
        $user_11->following()->save($user_15);
        $user_12->following()->save($user_15);
        $user_13->following()->save($user_15);
        $user_14->following()->save($user_15);

        $user_1->save();
        $user_2->save();
        $user_3->save();
        $user_4->save();
        $user_5->save();
        $user_6->save();
        $user_7->save();
        $user_8->save();
        $user_9->save();
        $user_10->save();
        $user_11->save();
        $user_12->save();
        $user_13->save();
        $user_14->save();
        $user_15->save();
    }

    public function staging() {
        // empty the follows table first
        DB::table('follows')->truncate();

        // retrieve users
        $user_1 = User::find(1);
        $user_2 = User::find(2);
        $user_3 = User::find(3);
        $user_4 = User::find(4);
        $user_5 = User::find(5);

        // by default, users follow themselves so mainfeed shows their own postings
        $user_1->following()->save($user_1);
        $user_2->following()->save($user_2);
        $user_3->following()->save($user_3);
        $user_4->following()->save($user_4);
        $user_5->following()->save($user_5);

        // user 1 follows user 2, user 3 and user 4
        $user_1->following()->save($user_2);
        $user_1->following()->save($user_3);
        $user_1->following()->save($user_4);

        $user_1->save();

        // user 2 follows user 1 and user 3
        $user_2->following()->save($user_1);
        $user_2->following()->save($user_3);

        $user_2->save();

        // user 3 follows user 1 and user 2
        $user_3->following()->save($user_1);
        $user_3->following()->save($user_2);

        $user_3->save();
    }
}