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
        Schema::create('data_epics', function (Blueprint $table) {
            // $table->id();
            $table->string('id_epic')->primary();
            $table->integer('user_id');
            $table->string('judul_epic');
            $table->string('isi_epic');
            $table->string('harapan');
            $table->string('status');
            $table->timestamp('tanggal_mulai')->useCurrent();
            $table->date('tanggal_selesai')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_epics');
    }
};
