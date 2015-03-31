<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHeightToPiecesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pieces', function(Blueprint $table)
		{
			//
            $table->float("height");
            $table->float("width");
            $table->float("aspectRatio");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pieces', function(Blueprint $table)
		{
			//
            $table->dropColumn("height");
            $table->dropColumn("width");
            $table->dropColumn("aspectRatio");
		});
	}

}
