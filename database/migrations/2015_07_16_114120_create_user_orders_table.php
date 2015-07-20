<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->bigInteger('user_id');
            $table->bigInteger('order_status_id');
            $table->decimal('total_items_price');
            $table->decimal('total_shipping_rate');
            $table->decimal('total_price');
            $table->decimal('total_points');
            $table->string('braintree_transaction_id');
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
        Schema::drop('user_orders');
    }
}
