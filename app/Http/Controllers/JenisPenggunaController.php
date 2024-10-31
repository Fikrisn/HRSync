<?php

namespace App\Http\Controllers;

use App\Models\JenisPenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

class JenisPenggunaModelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Jenis Pengguna',
            'list' => ['Home', 'jenis pengguna']
        ];
        $page = (object) [
            'title' => 'Daftar jenis pengguna yang terdaftar dalam sistem'
        ];

        $activeMenu = 'jenis_pengguna';
        $jenis_pengguna = JenisPenggunaModel::all();
        return view('jenis_pengguna.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'jenis_pengguna' => $jenis_pengguna,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $jenis_pengguna = JenisPenggunaModel::select('id_jenis_pengguna', 'jenis_kode', 'nama_jenis_pengguna');

        if ($request->id_jenis_pengguna) {
            $jenis_pengguna->where('id_jenis_pengguna', $request->id_jenis_pengguna);
        }
        
        return DataTables::of($jenis_pengguna)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jenis_pengguna) {
                $btn = '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kode' => 'required|string|min:3|unique:jenis_pengguna,jenis_kode',
            'nama_jenis_pengguna' => 'required|string|max:100'
        ]);
        
        JenisPenggunaModel::create([
            'jenis_kode' => $request->jenis_kode,
            'nama_jenis_pengguna' => $request->nama_jenis_pengguna,
            'bobot' => $request->bobot ?? null
        ]);
        
        return redirect('/jenis_pengguna')->with('success', 'Data jenis pengguna berhasil disimpan');
    }

    // Contoh untuk export ke Excel dan PDF juga perlu disesuaikan kolomnya
}