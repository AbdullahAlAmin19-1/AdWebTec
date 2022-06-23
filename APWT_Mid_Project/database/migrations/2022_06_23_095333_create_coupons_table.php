<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('co_id');
            $table->integer('co_code')->unique();
            $table->integer('co_amount');
            $table->integer('c_id')->unsigned();
            $table->foreign('c_id')->references('v_id')->on('vendors');
            // $table->integer('cc_id')->unsigned();
            // $table->foreign('cc_id')->references('cc_id')->on('customer_coupons');
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
        Schema::dropIfExists('coupons');
    }
}
