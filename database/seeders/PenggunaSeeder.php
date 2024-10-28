<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['id_jenis_pengguna' => 1, 'nama_jenis_pengguna' => 'Admin'],
            ['id_jenis_pengguna' => 2, 'nama_jenis_pengguna' => 'Pimpinan'],
            ['id_jenis_pengguna' => 3, 'nama_jenis_pengguna' => 'DosenAnggota'],
            ['id_jenis_pengguna' => 4, 'nama_jenis_pengguna' => 'DosenPIC'],
        ];
        DB::table('jenis_pengguna')->insert($data);
    }
}
