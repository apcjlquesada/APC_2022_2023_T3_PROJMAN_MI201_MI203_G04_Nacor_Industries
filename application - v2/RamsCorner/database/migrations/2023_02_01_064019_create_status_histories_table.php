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
        Schema::create('status_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('sh_ID')->autoIncrement();
            $table->unsignedBigInteger('t_ID');
            $table->string('sh_Status');
            $table->date('sh_datetime')->default(now());
            $table->string('sh_AssignedTo')->nullable();
            $table->string('sh_message')->nullable();
            $table->string('sh_doneBy')->nullable();

            $table->foreign('t_ID')->references('t_ID')->on('tickets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_histories');
    }
};
