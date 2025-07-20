<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Farhan',
                'no_hp' => '081234567890',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
        ]);
        DB::table('users')->insert([
            [
                'nama' => 'Zarif',
                'no_hp' => '081234567890',
                'email' => 'bpbd@gmail.com',
                'password' => Hash::make('bpbd123'),
                'role' => 'bpbd',
            ],
        ]);
        DB::table('users')->insert([
            [
                'nama' => 'Nico Flassy',
                'no_hp' => '081234567890',
                'email' => 'masyarakat@gmail.com',
                'password' => Hash::make('masyarakat123'),
                'role' => 'masyarakat',
            ],
        ]);
    }
}
