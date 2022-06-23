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
            $table->foreign('co_id')->references('co_id')->on('coupons');
            $table->foreign('c_id')->references('c_id')->on('customers');
            $table->foreign('v_id')->references('v_id')->on('vendors');
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
