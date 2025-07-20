<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Donasi;
use App\Models\InformasiBencana;
use App\Models\KebutuhanKorban;
use App\Models\Kecamatan;
use App\Models\LaporanBencana;
use App\Models\Posko;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'nama' => 'Farhan',
                'no_hp' => '081234567890',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
        ]);
        Kecamatan::create([
            'nama_kecamatan' => 'Sumbersari',
            'latitude' => '-8.179412',
            'longitude' => '113.725434',
        ]);

        Desa::create([
            'nama_desa' => 'Sumbersari',
            'latitude' => '-8.179412',
            'longitude' => '113.725434',
            'id_kecamatan' => 1,
            'code_adm' => 'asd',
        ]);

        LaporanBencana::create([
            'id_desa' => 1,
            'id_users' => 1,
            'nama_bencana' => "Banjir",
            'deskripsi_bencana' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque architecto animi odio nemo repellat a quos adipisci officia, officiis veritatis itaque ipsam nesciunt eos quam expedita sint suscipit, excepturi eveniet!",
            'deskripsi_alamat' => "Lorem ipsum dolor ta sint suscipit, excepturi eveniet!",
            'tingkat_bencana' => 'rendah',
            'tanggal_kejadian' => now(),
            'desa_bencana' => 'sumbersari',
            'latitude' => '-8.179412', 
            'longitude' => '113.725434',
            'foto_bencana' => 'Frame 1397.png',
            'status' => 'terkonfirmasi',
            'target_uang_donasi' => 1000000,
        ]);

        InformasiBencana::create([
            'id_laporan_bencana' => 1,
            'korban_terluka' => 10,
            'korban_meninggal' => 5,
            'korban_hilang' => 0,
            'korban_mengungsi' => 0,
            'dampak_kerusakan' => 'rendah',
            'tanggal' => now()
        ]);

        Donasi::create([
            'id_laporan_bencana' => 1,
            'id_users' => 1,
            'jenis_donasi' => 'uang',
            'nominal_donasi' => 1000000,
            'status' => 'diterima',
        ]);

        KebutuhanKorban::create([
            'id_laporan_bencana' => 1,
            'nama_kebutuhan' => 'Mie Goreng',
            'jumlah_kebutuhan' => 50
        ]);
        KebutuhanKorban::create([
            'id_laporan_bencana' => 1,
            'nama_kebutuhan' => 'Pakaian',
            'jumlah_kebutuhan' => 30
        ]);
        Posko::create([
            'id_laporan_bencana' => 1,
            'nama_posko' => 'Posko Sumbersari',
            'latitude' => '-8.179412',
            'longitude' => '113.725434',
        ]);
    }
}
