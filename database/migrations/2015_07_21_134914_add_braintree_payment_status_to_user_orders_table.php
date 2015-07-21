<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBraintreePaymentStatusToUserOrdersTable extends Migration
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
            $table->string('braintree_payment_status')->nullable();
            $table->string('braintree_payment_status_code')->nullable();
            $table->string('braintree_payment_status_text')->nullable();
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
            $table->dropColumn('braintree_payment_status');
            $table->dropColumn('braintree_payment_status_code');
            $table->dropColumn('braintree_payment_status_text');
        });
    }
}
