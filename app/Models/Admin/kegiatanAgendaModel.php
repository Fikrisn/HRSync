<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatanAgendaModel extends Model
{
    use HasFactory;

    protected $table = 'agenda_kegiatan';
    protected $primaryKey = 'id_agenda';


    protected $fillable =['id_agenda',	'nama_agenda',	'bobot_agenda',	'id_kegiatan',	'status_agenda',	'dokumen','tanggal_mulai','tanggal_selesai'];

}
