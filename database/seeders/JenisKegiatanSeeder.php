<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisKegiatanModel;

class JenisKegiatanSeeder extends Seeder
{
    public function run()
    {
        JenisKegiatanModel::create(['nama_jenis_kegiatan' => 'Seminar']);
        JenisKegiatanModel::create(['nama_jenis_kegiatan' => 'Workshop']);
        JenisKegiatanModel::create(['nama_jenis_kegiatan' => 'Pelatihan']);
    }
}