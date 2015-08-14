<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRefundReasonToShopOrderRefundsTable extends Migration
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
            $table->text("refund_reason");
            $table->bigInteger("user_id");
            $table->bigInteger("buyer_id");
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
            $table->dropColumn("refund_reason");
            $table->dropColumn("user_id");
            $table->dropColumn("buyer_id");
        });
    }
}
