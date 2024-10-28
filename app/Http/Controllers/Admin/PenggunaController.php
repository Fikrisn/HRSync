<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenggunaModel;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Jenis Pengguna',
            'list'=>['Home','pengguna']
        ];
        $page = (object)[
            'title'=>'Daftar Jenis Pengguna yang terdaftar dalam sistem '
        ];
        $activeMenu ='pengguna';
        return view('Admin.pengguna.index',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu]);
    }

    public function list(Request $request){
        $pengguna = PenggunaModel::select('id_jenis_pengguna', 'nama_jenis_pengguna');
        return DataTables::of($pengguna)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengguna) {
                $btn = '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->id_jenis_pengguna . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->id_jenis_pengguna . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->id_jenis_pengguna . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}