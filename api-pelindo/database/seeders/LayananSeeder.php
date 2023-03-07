<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_layanan' => 'Divisi Sumber Daya dan Umum',
            ],
            [
                'nama_layanan' => 'Divisi Operasional dan HSSE',
            ],
            [
                'nama_layanan' => 'Biro Satuan Pengawas Internal',
            ],
            [
                'nama_layanan' => 'Divisi Komersial dan Pemasaran',
            ],
            [
                'nama_layanan' => 'Divisi Asesmen, Pelatihan, dan Konsultasi',
            ],
            [
                'nama_layanan' => 'Pengadaan Barang dan Jasa',
            ],
            [
                'nama_layanan' => 'Divisi Teknologi dan Informasi',
            ],
            [
                'nama_layanan' => 'Divisi Keuangan',
            ],
            [
                'nama_layanan' => 'Biro Hukum dan Sekretaris Perusahaan',
            ],
        ];

        Layanan::insert($data);
    }
}
