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
        Schema::create('data_data_training', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_pelaporan');
            // $table->foreignId('id_user')->constrained('courses')->onDelete('cascade');
            $table->string('judul_pelaporan');
            $table->string('isi_pelaporan');
            $table->string('harapan');
            $table->string('jenis_product');
            $table->string('pic_pelaporan');
            // $table->enum('jenis_pelaporan', ['incident', 'RFC']);
            // $table->foreignId('id_operator')->constrained('pic')->onDelete('cascade');
            // $table->enum('status', ['Open', 'In Progress', 'Review', 'Done']);
            $table->string("status");
            $table->string('lampiran');
            $table->string('tanggal_mulai');
            $table->string('tanggal_selesai');
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
