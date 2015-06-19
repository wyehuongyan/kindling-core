<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutfitsCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outfits_categories', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('outfit_id')->unsigned();
            $table->foreign('outfit_id')->references('id')->on('outfits');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('outfit_categories');
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
        Schema::drop('outfits_categories');
    }

}
