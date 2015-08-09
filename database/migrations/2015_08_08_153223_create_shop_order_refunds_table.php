<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopOrderRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_order_refunds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->bigInteger('shop_order_id');
            $table->decimal('refund_amount');
            $table->boolean('refunded')->default(false);
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
        Schema::drop('shop_order_refunds');
    }
}
