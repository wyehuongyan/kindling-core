<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutfitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('outfits', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->bigIncrements('id');
            $table->string("name");
            $table->text("description");
            $table->text('images');
            $table->float('height');
            $table->float('width');
            $table->bigInteger("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('inspired_by')->unsigned()->nullable();
            $table->foreign('inspired_by')->references('id')->on('users');
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
		Schema::drop('outfits');
	}

}
