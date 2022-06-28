<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverymansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverymans', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('username', 100)->unique();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->integer('d_phone');
            $table->string('d_password', 100);
            $table->string('d_gender');
            $table->string('d_dob');
            $table->string('d_address', 300);
            $table->string('d_valid');
            $table->integer('d_nid')->unique()->nullable(); //For Nullable Value -MR            
            $table->string('d_propic')->nullable(); //For Nullable Value -MR
            $table->integer('cd_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cd_id')->references('cd_id')->on('customer_deliverymans');
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
        Schema::dropIfExists('deliverymans');
    }
}
