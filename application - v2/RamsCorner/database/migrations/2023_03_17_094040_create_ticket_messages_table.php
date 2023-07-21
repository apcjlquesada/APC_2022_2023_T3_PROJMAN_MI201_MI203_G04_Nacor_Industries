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
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('mID')->autoIncrement();
            $table->unsignedBigInteger('us_id');
            $table->unsignedBigInteger('tix_id');
            $table->longText('m_content');
            $table->timestamps();

            $table->foreign('us_id')->references('u_ID')->on('reporters')->onDelete('cascade');
            $table->foreign('tix_id')->references('t_ID')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_messages');
    }
};
