<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterShopOrderRefundsTable extends Migration
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
            $table->dropColumn("refunded");
            $table->string("braintree_transaction_id");
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
            $table->boolean("refunded")->default(false);
            $table->dropColumn("braintree_transaction_id");
        });
    }
}
