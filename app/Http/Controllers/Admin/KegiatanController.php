<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan; // Assuming Kegiatan is your model
use App\Models\kegiatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Kegiatan',
            'list'=>['Home','kegiatan']
        ];
        $page = (object)[
            'title'=>'Daftar kegiatan yang terdaftar dalam sistem '
        ];
        $activeMenu = 'kegiatan';
        
        return view('Admin.kegiatan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
        // Fetch data from the Kegiatan model (adjust according to the fields from your DB)
        $kegiatan = kegiatanModel::select('id_kegiatan', 'judul_kegiatan', 'deskripsi_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'id_jenis_kegiatan', 'id_dokumen','jenis_pengguna','nama', 'id_pengguna');
        
        // Filter based on id_kegiatan if provided
        if ($request->id_kegiatan) {
            $kegiatan->where('id_kegiatan', $request->id_kegiatan);
        }

        return DataTables::of($kegiatan)
            // Adding an index column (auto increment for the datatable)
            ->addIndexColumn()
            // Adding the 'aksi' column for action buttons
            ->addColumn('aksi', function ($kegiatan) {
                // Create buttons for Show, Edit, and Delete actions
                $btn = '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            // Mark the 'aksi' column as containing raw HTML
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
