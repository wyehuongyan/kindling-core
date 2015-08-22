<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerificationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            //
            $table->dropColumn("verified_at");
        });

        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('verification_code');
            $table->timestamp('verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('verified_at');
            $table->dropColumn('verification_code');
        });

        Schema::table('shops', function (Blueprint $table) {
            //
            $table->timestamp("verified_at")->nullable();
        });
    }
}
