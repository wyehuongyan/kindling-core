<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReturnCartItemsToShopOrderRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_order_refunds', function (Blueprint $table) {
            //
            $table->text('return_cart_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_order_refunds', function (Blueprint $table) {
            //
            $table->dropColumn('return_cart_items');
        });
    }
}
