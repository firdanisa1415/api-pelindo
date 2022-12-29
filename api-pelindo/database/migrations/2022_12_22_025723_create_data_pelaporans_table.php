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
            // $table->string('id', 100);
            $table->string('id_pelaporan', 100)->primary();
            // $table->foreignId('id_user')->constrained('courses')->onDelete('cascade');
            $table->string('judul_pelaporan', 250);
            $table->string('isi_pelaporan', 500);
            $table->string('harapan', 500);
            $table->string('jenis_product', 50);
            // $table->enum('jenis_pelaporan', ['incident', 'RFC']);
            // $table->foreignId('id_operator')->constrained('pic')->onDelete('cascade');
            $table->enum('status', ['Open', 'In Progress', 'Review', 'Done']);
            $table->string('lampiran');
            $table->timestamp('tanggal_mulai')->useCurrent();
            $table->timestamp('tanggal_selesai')->useCurrent();
            // $table->timestamp('tanggal_selesai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pelaporans');
    }
};
