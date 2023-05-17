<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('u_ID');
            $table->string('u_fname');
            $table->string('u_mname');
            $table->string('u_lname');
            $table->string('u_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('u_role');
            $table->string('u_password');
            $table->string('u_division')->nullable();
            $table->string('u_divRole')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
