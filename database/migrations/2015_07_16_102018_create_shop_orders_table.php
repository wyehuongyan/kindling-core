<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->bigInteger('user_order_id');
            $table->bigInteger('user_id');
            $table->bigInteger('buyer_id');
            $table->bigInteger('delivery_option_id');
            $table->bigInteger('order_status_id');
            $table->bigInteger('user_payment_method_id');
            $table->bigInteger('user_shipping_address_id');
            $table->decimal('items_price');
            $table->decimal('shipping_rate');
            $table->decimal('total_price');
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
        Schema::drop('shop_orders');
    }
}
