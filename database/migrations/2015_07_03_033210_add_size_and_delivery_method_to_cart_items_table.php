<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSizeAndDeliveryMethodToCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            //
            $table->String('size');
            $table->bigInteger('delivery_option_id');
            $table->dropColumn('shop_id');
            $table->bigInteger('seller_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            //
            $table->dropColumn('size');
            $table->dropColumn('delivery_option_id');
            $table->dropColumn('seller_id');
            $table->bigInteger('shop_id');
        });
    }
}
