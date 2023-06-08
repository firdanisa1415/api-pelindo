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
        $divisi = [
            [
                'nama_divisi' => 'Divisi Sumber Daya dan Umum',
            ],
            [
                'nama_divisi' => 'Divisi Operasional dan HSSE',
            ],
            [
                'nama_divisi' => 'Biro Satuan Pengawas Internal',
            ],
            [
                'nama_divisi' => 'Divisi Komersial dan Pemasaran',
            ],
            [
                'nama_divisi' => 'Divisi Asesmen, Pelatihan, dan Konsultasi',
            ],
            [
                'nama_divisi' => 'Pengadaan Barang dan Jasa',
            ],
            [
                'nama_divisi' => 'Divisi Teknologi dan Informasi',
            ],
            [
                'nama_divisi' => 'Divisi Keuangan',
            ],
            [
                'nama_divisi' => 'Biro Hukum dan Sekretaris Perusahaan',
            ],
        ];

        Divisi::insert($divisi);

    }
}
