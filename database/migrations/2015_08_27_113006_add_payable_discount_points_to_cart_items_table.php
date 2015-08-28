<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPayableDiscountPointsToCartItemsTable extends Migration
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
            $table->decimal('total_payable_price');
            $table->decimal('total_discount')->default(0);
            $table->decimal('points_applied')->default(0);
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
            $table->dropColumn('total_payable_price');
            $table->dropColumn('total_discount');
            $table->dropColumn('points_applied');
        });
    }
}
