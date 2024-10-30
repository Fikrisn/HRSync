<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'm_kegiatan';
    protected $primaryKey = 'kegiatan_id';

    protected $fillable = ['kegiatan_id', 'kegiatan_kode', 'kegiatan_nama'];

    public function barang(): HasMany
    {
        return $this->hasMany(BarangModel::class, 'kegiatan_id', 'kegiatan_id');
    }
}
