<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('desas')->insert([
            [
                'nama_desa' => 'KEBONSARI',
                'id_kecamatan' => 1,
                'latitude' => -8.187484259177548,
                'longitude' => 113.7065865447946,
                'code_adm' => '35.09.21.1001'
            ],
            [
                'nama_desa' => 'SUMBERSARI',
                'id_kecamatan' => 1,
                'latitude' => -8.170600727934334,
                'longitude' => 113.71626233619732,
                'code_adm' => '35.09.21.1002'
            ],
            [
                'nama_desa' => 'KRANJINGAN',
                'id_kecamatan' => 1,
                'latitude' => -8.204756127073543,
                'longitude' => 113.7151347099882,
                'code_adm' => '35.09.21.1003'
            ],
            [
                'nama_desa' => 'SS KARANGREJO',
                'id_kecamatan' => 1,
                'latitude' => -7.9949489840699375,
                'longitude' => 111.89744798624706,
                'code_adm' => '35.09.21.1004'
            ],
            [
                'nama_desa' => 'TEGALGEDE',
                'id_kecamatan' => 1,
                'latitude' => -7.6103889358517325,
                'longitude' => 110.96882581028741,
                'code_adm' => '35.09.21.1005'
            ],
            [
                'nama_desa' => 'WIROLEGI',
                'id_kecamatan' => 1,
                'latitude' => -8.18963801712555,
                'longitude' => 113.74346658912454,
                'code_adm' => '35.09.21.1006'
            ],
            [
                'nama_desa' => 'ANTIROGO',
                'id_kecamatan' => 1,
                'latitude' => -8.149750169830597,
                'longitude' => 113.74276116858208,
                'code_adm' => '35.09.06.2007'
            ]
        ]);
    }
}
