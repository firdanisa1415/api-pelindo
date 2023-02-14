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
        Schema::create('data_story', function (Blueprint $table) {
            $table->string('id_story', 100)->primary();
            $table->string('epic_id');
            $table->string('sprint_id');
            $table->string('isi_story');
            $table->string('status');

            $table->foreign('epic_id')->references('id_epic')->on('data_epics')->onDelete('cascade');
            $table->foreign('sprint_id')->references('id_sprint')->on('data_sprint')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_story');
    }
};
