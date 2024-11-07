<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPenggunaModel;

class JenisPenggunaSeeder extends Seeder
{
    public function run()
    {
        JenisPenggunaModel::create(['nama_jenis_pengguna' => 'Admin', 'jenis_kode' => 'ADM']);
        JenisPenggunaModel::create(['nama_jenis_pengguna' => 'Pengguna', 'jenis_kode' => 'PNG']);
    }
}