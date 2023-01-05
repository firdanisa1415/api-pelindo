<?php

namespace Database\Seeders;
// use Haruncpi\LaravelIdGenerator\IdGenerator;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $kode_id = IdGenerator::generate(['table' => 'data_pelaporans', 'field' => 'id_pelaporan', 'length' => 10, 'prefix' => 'BUG-']);
        \App\Models\Pelaporan::create([
            'id_pelaporan' => "test" . "-" . uniqid(),
            'judul_pelaporan' => "test",
            'isi_pelaporan' => "test",
            'harapan' => "test",
            'status' => "test",
            'lampiran' => "test",
            'tanggal_mulai' => "test",
            'tanggal_selesai' => "test",
            'jenis_product' => "test",
        ]);
    }
}
