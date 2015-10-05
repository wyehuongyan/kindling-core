<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstimatedTimeToDeliveryOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_options', function (Blueprint $table) {
            //
            $table->bigInteger('estimated_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_options', function (Blueprint $table) {
            //
            $table->dropColumn('estimated_time');
        });
    }
}
