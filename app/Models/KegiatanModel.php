<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = ['id_kegiatan','judul_kegiatan','deskripsi_kegiatan',	'tanggal_mulai','tanggal_selesai','	id_jenis_kegiatan',	'id_dokumen','jenis_pengguna','nama','id_pengguna'];

    public function jenisPengguna(): HasMany
    {
        return $this->hasMany(JenisPenggunaModel::class, 'id_kegiatan', 'id_kegiatan');
    }
}
