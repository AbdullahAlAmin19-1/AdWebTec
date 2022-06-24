<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_products', function (Blueprint $table) {
            $table->increments('cartp_id');
            $table->integer('cart_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('cart_id')->references('cart_id')->on('carts');
            $table->integer('p_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('p_id')->references('p_id')->on('products');
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
        Schema::dropIfExists('cart_products');
    }
}
