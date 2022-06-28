<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('c_id');            
            $table->string('c_username', 100)->unique();
            $table->string('c_name', 100);
            $table->string('c_email', 100)->unique();
            $table->integer('c_phone');
            $table->string('c_password', 100);
            $table->string('c_gender');
            $table->string('c_dob');
            $table->string('c_address', 300);
            $table->integer('cart_id')->nullable();
            $table->string('c_propic')->nullable(); //For Nullable Value -MR
            $table->integer('cco_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cco_id')->references('cco_id')->on('customer_coupons');
            $table->integer('cp_id')->unsigned()->nullable();; //For Nullable Value -MR
            // $table->foreign('cp_id')->references('cp_id')->on('customer_products');
            $table->integer('cd_id')->unsigned()->nullable();; //For Nullable Value -MR
            // $table->foreign('cd_id')->references('cd_id')->on('customer_deliverymans');
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
        Schema::dropIfExists('customers');
    }
}
