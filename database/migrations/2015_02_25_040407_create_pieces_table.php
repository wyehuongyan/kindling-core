<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiecesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pieces', function(Blueprint $table)
		{
            $table->engine = 'Aria';
			$table->bigIncrements('id');
            $table->string('type');
            $table->bigInteger('position');
            $table->string('name');
            $table->text('description');
            $table->text('images');
            $table->bigInteger("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('pieces');
	}

}
