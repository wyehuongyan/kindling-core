<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiecesOutfits extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pieces_outfits', function(Blueprint $table)
		{
            $table->engine = 'Aria';
			$table->bigIncrements('id');
            $table->bigInteger('piece_id')->unsigned();
            $table->foreign('piece_id')->references('id')->on('pieces');
            $table->bigInteger('outfit_id')->unsigned();
            $table->foreign('outfit_id')->references('id')->on('outfits');
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
		Schema::drop('pieces_outfits');
	}

}
