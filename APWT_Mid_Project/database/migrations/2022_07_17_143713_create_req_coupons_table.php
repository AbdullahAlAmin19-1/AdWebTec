<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique(); //integer to string -MR
            $table->integer('amount');
            $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('id')->on('vendors');
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
        Schema::dropIfExists('req_coupons');
    }
}
