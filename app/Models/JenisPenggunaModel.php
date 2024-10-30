<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPenggunaModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_pengguna';
    protected $primaryKey = 'id_jenis_pengguna';

    protected $fillable = [
        'nama_jenis_pengguna', 
        'bobot',
    ];

    // Define the relationship with Pengguna
    public function pengguna()
    {
        return $this->hasMany(PenggunaModel::class, 'id_jenis_pengguna');
    }
}
