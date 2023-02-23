<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisi::create([
            'nama_divisi' => 'Divisi Sumber Daya dan Umum'
        ]);
        Divisi::create([
            'nama_divisi' => 'Divisi Operasional dan HSSE'
        ]);
        Divisi::create([
            'nama_divisi' => 'Biro Satuan Pengawas Internal'
        ]);
        Divisi::create([
            'nama_divisi' => 'Divisi Komersial dan Pemasaran'
        ]);
        Divisi::create([
            'nama_divisi' => 'Divisi Asesmen, Pelatihan, dan Konsultasi'
        ]);
        Divisi::create([
            'nama_divisi' => 'Pengadaan Barang dan Jasa'
        ]);
        Divisi::create([
            'nama_divisi' => 'Divisi Teknologi dan Informasi'
        ]);
        Divisi::create([
            'nama_divisi' => 'Divisi Keuangan'
        ]);
        Divisi::create([
            'nama_divisi' => 'Biro Hukum dan Sekretaris Perusahaan'
        ]);
        
    }
}
