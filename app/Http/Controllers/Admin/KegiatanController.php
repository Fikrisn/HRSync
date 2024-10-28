<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kegiatanAgendaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Kegiatan',
            'list'=>['Home','kegiatanAg']
        ];
        $page = (object)[
            'title'=>'Daftar kegiatan yang terdaftar dalam sistem '
        ];
        $activeMenu ='kegiatanAg';
        return view('Admin.kegiatanAg.index',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu]);
    }

    public function list(Request $request){
        $kegiatanAg = kegiatanAgendaModel::select('id_agenda','nama_agenda','bobot_agenda','status_agenda','dokumen');
        if($request->id_agenda){
            $kegiatanAg->where('id_agenda',$request->id_agenda);
        }
        return DataTables::of($kegiatanAg)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kegiatanAg) { // menambahkan kolom aksi
            $btn = '<button onclick="modalAction(\'' . url('/kegiatanAg/' . $kegiatanAg->id_agenda .
                '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanAg/' . $kegiatanAg->id_agenda .
                '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanAg/' . $kegiatanAg->id_agenda .
                '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }
}
