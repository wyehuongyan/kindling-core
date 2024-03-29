<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactNumberToUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('contact_number');
        });

        Schema::table('user_info', function (Blueprint $table) {
            //
            $table->string('contact_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_info', function (Blueprint $table) {
            //
            $table->dropColumn('contact_number');
        });

        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('contact_number')->nullable();
        });
    }
}
