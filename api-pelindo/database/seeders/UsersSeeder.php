<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
                'nama_karyawan' => 'Rahmat Yoyok P.',
                'nrp' => '123456',
                'divisi_id' => 7,
                'role_id' => 2,
                'email' => 'yoyok@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'nama_karyawan' => 'Agus Setyawan',
                'nrp' => '1234567',
                'divisi_id' => 7,
                'role_id' => 2,
                'email' => 'agus@gmail.com',
                'password' => bcrypt('1234567'),
            ],
            [
                'nama_karyawan' => 'Ahmad Zaki U.',
                'nrp' => '12345678',
                'divisi_id' => 7,
                'role_id' => 2,
                'email' => 'zaki@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'nama_karyawan' => 'Firda Aininnisa',
                'nrp' => '12345',
                'divisi_id' => 7,
                'role_id' => 1,
                'email' => 'firdanisa1415@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];

        User::insert($data);
    }
}
