<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('o_id');
            $table->integer('co_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('co_id')->references('co_id')->on('coupons');
            $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('c_id')->on('customers');
            $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('v_id')->on('vendors');
            $table->integer('d_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('d_id')->references('d_id')->on('deliverymans');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
