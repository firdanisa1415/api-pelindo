<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_karyawan' => 'Rahmat Yoyok P.',
            'nrp' => '123456',
            'divisi_id' => 1,
            'role_id' => 2,
            'email' => 'yoyok@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'nama_karyawan' => 'Agus Setyawan',
            'nrp' => '1234567',
            'divisi_id' => 1,
            'role_id' => 2,
            'email' => 'agus@gmail.com',
            'password' => bcrypt('1234567'),
        ]);
        User::create([
            'nama_karyawan' => 'Ahmad Zaki U.',
            'nrp' => '12345678',
            'divisi_id' => 1,
            'role_id' => 2,
            'email' => 'zaki@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
