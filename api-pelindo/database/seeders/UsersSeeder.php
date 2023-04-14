<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
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
        $operatorRole = Role::where('name', 'operator')->first();

        $karyawan1 = User::create([
            'nama_karyawan' => 'Rahmat Yoyok P.',
            'nrp' => '123456',
            'divisi_id' => 1,
            'email' => 'yoyok@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        $karyawan1->assignRole($operatorRole);
        $karyawan2 = User::create([
            'nama_karyawan' => 'Agus Setyawan',
            'nrp' => '1234567',
            'divisi_id' => 1,
            'email' => 'agus@gmail.com',
            'password' => bcrypt('1234567'),
        ]);
        $karyawan2->assignRole($operatorRole);
        $karyawan3 = User::create([
            'nama_karyawan' => 'Ahmad Zaki U.',
            'nrp' => '12345678',
            'divisi_id' => 1,
            'email' => 'zaki@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $karyawan3->assignRole($operatorRole);
    }
}
