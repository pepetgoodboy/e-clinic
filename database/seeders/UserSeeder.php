<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $admin->assignRole('Admin');

        $petugas = User::create([
            'name' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('petugas123')
        ]);
        $petugas->assignRole('Petugas Pendaftaran');

        $dokter = User::create([
            'name' => 'dokter',
            'email' => 'dokter@gmail.com',
            'password' => bcrypt('dokter123')
        ]);
        $dokter->assignRole('Dokter');

        $kasir = User::create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('kasir123')
        ]);
        $kasir->assignRole('Kasir');
    }
}