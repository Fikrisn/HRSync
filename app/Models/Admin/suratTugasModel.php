<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\suratTugasModel;
use Yajra\DataTables\Facades\DataTables;

class SuratTugasModel extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas'; // Sesuaikan dengan nama tabel
    protected $fillable = ['activity_name', 'user_name', 'email', 'status', 'surat_tugas', 'dokumentasi', 'activity_id'];


    public function kegiatan()
{
    return $this->belongsTo(kegiatanAgendaModel::class, 'activity_id', 'id_agenda');
}
}
