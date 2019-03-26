<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->timestamps();
        });
        Schema::create('payment', function (Blueprint $table){
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('subtotal1');
            $table->integer('discount');
            $table->integer('total_payment');
            $table->integer('payment');
            $table->integer('change_payment');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('seller', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seller_code');
            $table->string('seller_name');
            $table->string('address');
            $table->string('phone_number');
            $table->timestamps();
        });
        Schema::create('master_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_code');
            $table->integer('seller_id')->unsigned();
            $table->string('item_name');
            $table->string('weight');
            $table->integer('price');
            $table->integer('stock');
            $table->foreign('seller_id')->references('id')->on('seller')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('transaction', function (Blueprint $table){
            $table->increments('id');
            $table->string('transaction_code');
            $table->date('date');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('transaction_detail', function (Blueprint $table){
            $table->increments('no');
            $table->integer('transaction_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('master_item');
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
        Schema::dropIfExists('customer');
        Schema::dropIfExists('payment');
        Schema::dropIfExists('seller');
        Schema::dropIfExists('master_item');
        Schema::dropIfExists('transaction');
        Schema::dropIfExists('transaction_detail');
    }
}
