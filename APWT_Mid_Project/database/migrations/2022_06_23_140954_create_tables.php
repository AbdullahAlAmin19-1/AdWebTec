<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('a_id');            
            $table->string('a_username', 100)->unique();
            $table->string('a_name', 100);
            $table->string('a_email', 100)->unique();
            $table->integer('a_phone');
            $table->string('a_password', 100);
            $table->string('a_gender');
            $table->string('a_dob');
            $table->string('a_address', 300);
            $table->string('a_propic')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('v_id');            
            $table->string('v_username', 100)->unique();
            $table->string('v_name', 100);
            $table->string('v_email', 100)->unique();
            $table->integer('v_phone');
            $table->string('v_password', 100);
            $table->string('v_gender');
            $table->string('v_dob');
            $table->string('v_address', 300);
            $table->string('v_propic')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('customers', function (Blueprint $table){
            $table->increments('c_id');            
            $table->string('c_username', 100)->unique();
            $table->string('c_name', 100);
            $table->string('c_email', 100)->unique();
            $table->integer('c_phone');
            $table->string('c_password', 100);
            $table->string('c_gender');
            $table->string('c_dob');
            $table->string('c_address', 300);
            $table->string('c_propic')->nullable();
            $table->integer('cco_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cco_id')->references('cco_id')->on('customer_coupons');
            $table->integer('cp_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cp_id')->references('cp_id')->on('customer_products');
            $table->integer('cd_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cd_id')->references('cd_id')->on('customer_deliverymans');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('deliverymans', function (Blueprint $table) {
            $table->increments('d_id');            
            $table->string('d_username', 100)->unique();
            $table->string('d_name', 100);
            $table->string('d_email', 100)->unique();
            $table->integer('d_phone');
            $table->string('d_password', 100);
            $table->string('d_gender');
            $table->string('d_dob');
            $table->string('d_address', 300);
            $table->string('d_valid');
            $table->integer('d_nid')->unique()->nullable(); //For Nullable Value -MR            
            $table->string('d_propic')->nullable();
            $table->integer('cd_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cd_id')->references('cd_id')->on('customer_deliverymans');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('p_id');
            $table->string('p_name', 100);
            $table->string('p_catergory');
            $table->string('p_thumbnail');
            $table->string('p_gallery');
            $table->integer('p_price');            
            $table->integer('p_stock');          
            $table->string('p_color');          
            $table->integer('p_size');
            $table->integer('v_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('v_id')->on('vendors');
            $table->integer('cp_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cp_id')->references('cp_id')->on('customer_products');
            $table->integer('cartp_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cartp_id')->references('cartp_id')->on('cart_products');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('cart_id');    
            $table->integer('P_quantity');
            $table->integer('cartp_id')->unsigned();//->nullable(); //For Nullable Value -MR
            //$table->foreign('cartp_id')->references('cartp_id')->on('cart_products');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('o_id');
            $table->integer('co_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('co_id')->references('co_id')->on('coupons');
            $table->integer('c_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('c_id')->on('customers');
            $table->integer('v_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('v_id')->on('vendors');
            $table->integer('d_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('d_id')->references('d_id')->on('deliverymans');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('co_id');
            $table->integer('co_code')->unique();
            $table->integer('co_amount');
            $table->integer('v_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('v_id')->on('vendors');
            $table->integer('cco_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cc_id')->references('cc_id')->on('customer_coupons');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('r_id');
            $table->string('r_message', 300);
            $table->integer('c_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('c_id')->on('customers');
            $table->integer('p_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('p_id')->references('p_id')->on('products');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('customer_coupons', function (Blueprint $table) {
            $table->increments('cco_id');            
            $table->integer('c_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('c_id')->on('customers');
            $table->integer('co_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('co_id')->references('co_id')->on('coupons');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('customer_products', function (Blueprint $table) {
            $table->increments('cp_id');    
            $table->integer('c_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('c_id')->on('customers');
            $table->integer('p_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('p_id')->references('p_id')->on('products');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('customer_deliverymans', function (Blueprint $table) {
            $table->increments('cd_id');
            $table->integer('c_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('c_id')->on('customers');
            $table->integer('d_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('d_id')->references('d_id')->on('deliverymans');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('cart_products', function (Blueprint $table) {
            $table->increments('cartp_id');
            $table->integer('cart_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('cart_id')->references('cart_id')->on('carts');
            $table->integer('p_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('p_id')->references('p_id')->on('products');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });


        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('cco_id')->references('cco_id')->on('customer_coupons');
            $table->foreign('cp_id')->references('cp_id')->on('customer_products');
            $table->foreign('cd_id')->references('cd_id')->on('customer_deliverymans');
        });
        Schema::table('deliverymans', function (Blueprint $table) {
            $table->foreign('cd_id')->references('cd_id')->on('customer_deliverymans');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('cp_id')->references('cp_id')->on('customer_products');
            $table->foreign('cartp_id')->references('cartp_id')->on('cart_products');
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('cartp_id')->references('cartp_id')->on('cart_products');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('co_id')->references('co_id')->on('coupons');
        });
        Schema::table('coupons', function (Blueprint $table) {
            $table->foreign('cco_id')->references('cco_id')->on('customer_coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
