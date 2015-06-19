<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piece_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        // remove category from pieces table and add category_id
        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn("category");
            $table->bigInteger("category_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('piece_categories');

        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn("category_id");
            $table->string("category");
        });
    }
}
