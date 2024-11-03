<?php

namespace App\Http\Controllers;

use App\Models\JenisPenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

class JenisPenggunaController extends Controller
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
        $jenis_pengguna = JenisPenggunaModel::select('id_jenis_pengguna', 'nama_jenis_pengguna', 'bobot', 'jenis_kode', 'created_at', 'updated_at');

        if ($request->id_jenis_pengguna) {
            $jenis_pengguna->where('id_jenis_pengguna', $request->id_jenis_pengguna);
        }

        return DataTables::of($jenis_pengguna)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jenis_pengguna) {
                $btn = '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax($id)
    {
        $jenis_pengguna = JenisPenggunaModel::find($id);
        return view('jenispengguna.show_ajax', ['jenis_pengguna' => $jenis_pengguna]);
    }

    public function create_ajax()
    {
        return view('jenispengguna.create_ajax');
    }

    public function edit_ajax($id)
    {
        $jenis_pengguna = JenisPenggunaModel::find($id);
        return view('jenispengguna.edit_ajax', ['jenis_pengguna' => $jenis_pengguna]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $jenis_pengguna = JenisPenggunaModel::find($id);
            if ($jenis_pengguna) {
                $jenis_pengguna->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}