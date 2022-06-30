<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('p_id');
            $table->string('p_name', 100);
            $table->string('p_catergory');
            $table->string('p_thumbnail');
            $table->string('p_gallery');
            $table->integer('p_price');            
            $table->integer('p_stock');          
            $table->string('p_color')->nullable();          
            $table->integer('p_size')->nullable();

            $table->string('p_description', 300)->nullable();

            $table->integer('v_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('id')->on('vendors');
            $table->integer('cp_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cp_id')->references('cp_id')->on('customer_products');
            $table->integer('cartp_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cartp_id')->references('cartp_id')->on('cart_products');
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
        Schema::dropIfExists('products');
    }
}
