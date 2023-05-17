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
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('t_ID');
            $table->integer('u_ID');
            $table->string('t_type');
            $table->date('t_date')->default(now()->toDateString());
            $table->time('t_time')->default(now()->toTimeString());
            $table->string('t_status')->default("New");
            $table->integer('t_priority')->default(3);
            $table->integer('t_severity')->default(1);
            $table->string('t_category');
            $table->string('t_assignedTo')->default("Not Assigned");
            $table->string('t_cc');
            $table->string('t_title');
            $table->longText('t_content');
            $table->longText('t_resolution')->nullable()->default("Not Yet Resolved");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
