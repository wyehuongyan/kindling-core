<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowTableSeeder extends Seeder {

    public function run()
    {
        // empty the follows table first
        DB::table('follows')->delete();

        // retrieve user 1 (jasmine)
        $user_1 = User::find(1);
        $user_2 = User::find(2);
        $user_3 = User::find(3);

        // user 1 follows user 2 and user 3
        $user_1->following()->save($user_2);
        $user_1->following()->save($user_3);

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