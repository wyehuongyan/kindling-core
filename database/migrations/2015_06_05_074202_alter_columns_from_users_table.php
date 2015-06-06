<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnsFromUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			// add two new columns
            $table->timestamp('suspended_at')->nullable();
            $table->string('contact_number');
            $table->integer('shoppable_id');
            $table->string('shoppable_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // remove two columns
        DB::statement('ALTER TABLE users DROP suspended_at');
        DB::statement('ALTER TABLE users DROP contact_number');
	}

}
