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
            $table->unsignedBigInteger('t_ID')->autoIncrement();
            $table->unsignedBigInteger('u_ID');
            $table->string('t_status')->default("New");
            $table->integer('t_impact')->default(3);
            $table->integer('t_urgency')->default(3);
            $table->integer('t_priority')->default(3);
            $table->string('t_category');
            $table->date('t_datetime')->default(now());
            $table->date('t_due')->nullable();
            $table->string('t_assignedTo')->default("Not Assigned");
            $table->string('t_cc');
            $table->string('t_title');
            $table->string('t_image');
            $table->longText('t_description');
            $table->longText('t_resolution')->nullable()->default("Not Yet Resolved");
            $table->bigInteger('t_views')->default(0);




            $table->foreign('u_ID')->references('u_ID')->on('reporters')->onDelete('cascade');




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
