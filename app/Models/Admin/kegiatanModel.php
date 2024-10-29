<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';


    protected $fillable = ['judul_kegiatan', 'deskripsi_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'id_jenis_kegiatan', 'id_pic'];
}
