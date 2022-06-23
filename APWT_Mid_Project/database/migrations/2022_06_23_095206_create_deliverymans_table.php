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
            $table->increments('d_id');            
            $table->string('d_username', 100)->unique();
            $table->string('d_name', 100);
            $table->string('d_email', 100)->unique();
            $table->integer('d_phoneNumber')->unique();
            $table->string('d_password', 100);
            $table->string('d_gender');
            $table->string('d_dob');
            $table->string('d_address', 300);
            $table->string('d_valid');
            $table->integer('d_nid')->unique();            
            $table->string('d_propic');
            // $table->integer('cd_id')->unsigned();
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
        Schema::dropIfExists('deliverymans');
    }
}
