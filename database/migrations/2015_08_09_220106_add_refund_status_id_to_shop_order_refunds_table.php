<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRefundStatusIdToShopOrderRefundsTable extends Migration
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
            $table->bigInteger('refund_status_id');
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
            $table->dropColumn('refund_status_id');
        });
    }
}
