<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('cart_id');    
            $table->integer('p_quantity');
            $table->integer('id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('id')->references('id')->on('customers');
            $table->integer('p_id')->unsigned();//->nullable(); //For Nullable Value -MR
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
        Schema::dropIfExists('carts');
    }
}
