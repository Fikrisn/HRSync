<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KegiatanModel;

class KegiatanSeeder extends Seeder
{
    public function run()
    {
        KegiatanModel::create([
            'judul_kegiatan' => 'Seminar Nasional',
            'deskripsi_kegiatan' => 'Seminar Nasional tentang Teknologi',
            'tanggal_mulai' => '2023-01-01 09:00:00',
            'tanggal_selesai' => '2023-01-01 17:00:00',
            'id_jenis_kegiatan' => 1,
            'pic_id' => 1
        ]);

        KegiatanModel::create([
            'judul_kegiatan' => 'Workshop Pemrograman',
            'deskripsi_kegiatan' => 'Workshop tentang Pemrograman Web',
            'tanggal_mulai' => '2023-02-01 09:00:00',
            'tanggal_selesai' => '2023-02-01 17:00:00',
            'id_jenis_kegiatan' => 2,
            'pic_id' => 2
        ]);
    }
}