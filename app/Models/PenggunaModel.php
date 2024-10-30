<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaModel extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'username', 
        'id_pengguna',
        'nama', 
        'email', 
        'password', 
        'NIP', 
        'id_jenis_pengguna', 
    ];

    // Define the relationship with Jenis Pengguna
    public function jenisPengguna()
    {
        return $this->belongsTo(JenisPenggunaModel::class, 'id_jenis_pengguna');
    }
}
