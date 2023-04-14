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
        Schema::create('data_pelaporans', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_pelaporan');
            $table->integer('user_id');
            $table->string('judul_pelaporan');
            $table->string('isi_pelaporan');
            $table->string('harapan');
            $table->string('jenis_product');
            $table->integer('pic_pelaporan');
            $table->string('nama_pic');
            $table->string('klasifikasi');
            $table->string('status');
            $table->string('lampiran')->nullable();
            $table->string('tanggal_mulai');
            $table->string('tanggal_selesai');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            // $table->foreignId('id_user')->constrained('courses')->onDelete('cascade');
            // $table->enum('jenis_pelaporan', ['incident', 'RFC']);
            // $table->foreignId('id_operator')->constrained('pic')->onDelete('cascade');
            // $table->enum('status', ['Open', 'In Progress', 'Review', 'Done']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_data_training');
    }
};
