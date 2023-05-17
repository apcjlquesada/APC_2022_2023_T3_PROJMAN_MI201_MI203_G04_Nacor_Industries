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
            $table->increments('sh_ID');
            $table->integer('t_ID');
            $table->string('sh_Status');
            $table->date('sh_date')->default(now()->toDateString());
            $table->time('sh_time')->default(now()->toTimeString());
            $table->string('sh_AssignedTo')->nullable();
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
