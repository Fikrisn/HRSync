<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenggunaModel;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        PenggunaModel::create([
            'username' => 'admin',
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
            'NIP' => '123456',
            'id_jenis_pengguna' => 1
        ]);

        PenggunaModel::create([
            'username' => 'user',
            'nama' => 'Regular',
            'email' => 'user@example.com',
            'password' => bcrypt('123456'),
            'NIP' => '654321',
            'id_jenis_pengguna' => 2
        ]);
    }
}