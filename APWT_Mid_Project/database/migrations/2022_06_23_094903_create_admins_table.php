<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
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
            $table->string('a_propic');
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
        Schema::dropIfExists('admins');
    }
}
