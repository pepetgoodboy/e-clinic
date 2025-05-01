<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = now();

        Wilayah::insert([
            ['name' => 'Jakarta Selatan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jakarta Timur', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jakarta Barat', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jakarta Utara', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
