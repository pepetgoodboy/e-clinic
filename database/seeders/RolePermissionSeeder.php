<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create role
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Petugas Pendaftaran']);
        Role::create(['name' => 'Dokter']);
        Role::create(['name' => 'Kasir']);

    }
}