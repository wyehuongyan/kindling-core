<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShiftPaymentMethodToUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_orders', function (Blueprint $table) {
            //
            $table->bigInteger('user_payment_method_id');
            $table->bigInteger('user_shipping_address_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_orders', function (Blueprint $table) {
            //
            $table->dropColumn('user_payment_method_id');
            $table->dropColumn('user_shipping_address_id');
        });
    }
}
