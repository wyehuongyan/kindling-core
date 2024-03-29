<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->bigIncrements('id');
            $table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password', 60);
            $table->string('name');
            $table->text('description');
            $table->text('image');
            $table->text('cover');
            $table->string('firebase_token')->nullable();
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
