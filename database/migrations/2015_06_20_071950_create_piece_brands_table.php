<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieceBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piece_brands', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        // remove brand from pieces table and add brand_id
        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn("brand");
            $table->bigInteger("brand_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('piece_brands');

        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn("brand_id");
            $table->string("brand");
        });
    }
}
