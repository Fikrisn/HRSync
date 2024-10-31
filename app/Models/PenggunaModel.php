<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PenggunaModel extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = ['username', 'nama', 'email', 'password', 'NIP', 'id_jenis_pengguna'];

    protected $hidden = ['password'];
    protected $cast = ['password' => 'hashed'];

    // Define the relationship with Jenis Pengguna
    public function jenisPengguna(): BelongsTo
    {
        return $this->belongsTo(JenisPenggunaModel::class, 'id_jenis_pengguna', 'id_jenis_pengguna');
    }

    public function geRoleName(): string
    {
        return $this->jenisPengguna->nama_jenis_pengguna;
    }

    public function hasRole($role): bool
    {
        return $this->jenisPengguna->jenis_kode == $role;
    }

    public function getRole() {
        return $this->jenisPengguna->jenis_kode;
    }
}
