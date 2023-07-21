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
        Schema::create('k_b_s', function (Blueprint $table) {
            $table->unsignedBigInteger('kb_ID')->autoIncrement();
            $table->string('kb_title');
            $table->string('kb_category');
            $table->longText('kb_content');
            $table->longText('kb_resolution');
            $table->boolean('kb_view')->default(False);
            $table->boolean('kb_approved')->default(False);
            $table->boolean('kb_modify')->default(False);
            $table->date('dateModified');
            $table->bigInteger('kb_watch');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('k_b_s');
    }
};
