<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::statement("SET foreign_key_checks = 0");
		Model::unguard();

        $this->call('ShopperGenderTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('ShopTableSeeder');
        $this->call('FollowTableSeeder');
        $this->call('PieceCategoryTableSeeder');
        $this->call('PieceBrandTableSeeder');
        $this->call('OutfitCategoryTableSeeder');
        $this->call('OutfitAndPieceTableSeeder');
        $this->call('OrderStatusTableSeeder');
        $this->call('RefundStatusTableSeeder');
	}

}
