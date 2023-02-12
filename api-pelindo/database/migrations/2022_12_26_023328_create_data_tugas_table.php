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
        Schema::create('data_tugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->string('story_id');
            $table->string('isi_tugas');

            $table->foreign('story_id')->references('id_story')->on('data_story')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_tugas');
    }
};
