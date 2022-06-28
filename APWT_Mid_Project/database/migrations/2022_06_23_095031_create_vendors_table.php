<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('v_id');            
            $table->string('v_username', 100)->unique();
            $table->string('v_name', 100);
            $table->string('email', 100)->unique();
            $table->integer('v_phone');
            $table->string('v_password', 100);
            $table->string('v_gender');
            $table->string('v_dob');
            $table->string('v_address', 300);
            $table->string('v_propic')->nullable(); //For Nullable Value -MR
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
        Schema::dropIfExists('vendors');
    }
}
