<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kecamatans')->insert([
            [
                'nama_kecamatan' => 'Kecamatan Sumbersari',
                'latitude' => 123,
                'longitude' => 123,
            ],
            [
                'nama_kecamatan' => 'Kecamatan Tanggul',
                'latitude' => 123,
                'longitude' => 123,
            ]

        ]);
    }
}
