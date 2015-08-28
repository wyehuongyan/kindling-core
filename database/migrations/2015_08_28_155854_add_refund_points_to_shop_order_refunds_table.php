<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRefundPointsToShopOrderRefundsTable extends Migration
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
            $table->decimal('refund_points')->default(0);
        });

        Schema::table('shop_orders', function (Blueprint $table) {
            //
            $table->decimal('refunded_points')->default(0);
        });

        Schema::table('cart_items', function (Blueprint $table) {
            //
            $table->decimal('refundable_points')->default(0);
            $table->decimal('refunded_points')->default(0);
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
            $table->dropColumn('refundable_points');
            $table->dropColumn('refunded_points');
        });

        Schema::table('shop_orders', function (Blueprint $table) {
            //
            $table->dropColumn('refunded_points');
        });

        Schema::table('shop_order_refunds', function (Blueprint $table) {
            //
            $table->dropColumn('refund_points');
        });
    }
}
