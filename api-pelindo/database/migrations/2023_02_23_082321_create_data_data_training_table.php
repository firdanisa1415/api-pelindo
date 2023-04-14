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
<<<<<<< HEAD:api-pelindo/database/migrations/2014_10_12_000001_create_data_pelaporans_table.php
        Schema::create('data_pelaporans', function (Blueprint $table) {
=======
        Schema::create('data_data_training', function (Blueprint $table) {
>>>>>>> dataStories:api-pelindo/database/migrations/2023_02_23_082321_create_data_data_training_table.php
            $table->id('id');
            $table->string('id_pelaporan');
            $table->integer('user_id');
            // $table->foreignId('id_user')->constrained('courses')->onDelete('cascade');
            $table->string('judul_pelaporan');
            $table->string('isi_pelaporan');
            $table->string('harapan');
            $table->string('jenis_product');
<<<<<<< HEAD:api-pelindo/database/migrations/2014_10_12_000001_create_data_pelaporans_table.php
            $table->integer('pic_pelaporan');
            $table->string('nama_pic');
=======
            $table->string('pic_pelaporan');
>>>>>>> dataStories:api-pelindo/database/migrations/2023_02_23_082321_create_data_data_training_table.php
            // $table->enum('jenis_pelaporan', ['incident', 'RFC']);
            // $table->foreignId('id_operator')->constrained('pic')->onDelete('cascade');
            // $table->enum('status', ['Open', 'In Progress', 'Review', 'Done']);
            $table->string('klasifikasi');
            $table->string('status');
            $table->string('lampiran')->nullable();
            $table->string('tanggal_mulai');
            $table->string('tanggal_selesai');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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
