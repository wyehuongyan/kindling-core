<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follows', function(Blueprint $table)
		{
            $table->engine = 'Aria';
            $table->bigIncrements('id');
            $table->bigInteger("follower_id")->unsigned();
            $table->foreign('follower_id')->references('id')->on('users');
            $table->bigInteger("following_id")->unsigned();
            $table->foreign('following_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('follows');
	}

}
