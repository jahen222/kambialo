<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpayOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webpay_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('accounting_date');
            $table->string('buy_order');
            $table->string('card_number');
            $table->string('authorization_code');
            $table->string('payment_code');
            $table->string('response_code');
            $table->string('shares_number');
            $table->string('amount');
            $table->string('commerce_code');
            $table->string('transaction_date');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webpay_orders');
    }
}
