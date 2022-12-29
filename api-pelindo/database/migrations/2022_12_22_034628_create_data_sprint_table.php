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
        Schema::create('data_sprint', function (Blueprint $table) {
            $table->string('id_sprint', 100)->primary();
            $table->timestamp('tanggal_mulai')->useCurrent();
            $table->timestamp('tanggal_akhir')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_sprint');
    }
};
