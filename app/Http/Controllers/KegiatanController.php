<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

class KegiatanController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Kegiatan',
            'list'=>['Home','Kegiatan']
        ];
        $page = (object)[
            'title'=>'Daftar kegiatan yang terdaftar dalam sistem '
        ];
        $activeMenu ='kegiatan';
        $kegiatan = KegiatanModel::all();
        return view('kegiatan.index', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'activeMenu'=>$activeMenu, 'kegiatan'=>$kegiatan]);
    }

    public function list(Request $request){
        $kegiatan = KegiatanModel::select('id_kegiatan', 'judul_kegiatan', 'deskripsi_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'id_jenis_kegiatan', 'id_dokumen', 'jenis_pengguna', 'nama', 'id_pengguna');
        if($request->id_kegiatan){
            $kegiatan->where('id_kegiatan', $request->id_kegiatan);
        }
        return DataTables::of($kegiatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kegiatan) {
                $btn = '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create(){
        $breadcrumb = (object)[
            'title'=>'Tambah Kegiatan',
            'list'=>['Home','Kegiatan','Tambah']
        ];
        $page = (object)[
            'title'=>'Tambah kegiatan baru'
        ];
        $activeMenu = 'kegiatan';
        $kegiatan = KegiatanModel::all();
        return view('kegiatan.create', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'activeMenu'=>$activeMenu, 'kegiatan'=>$kegiatan]);
    }

    public function store(Request $request){
        $request->validate([
            'judul_kegiatan' => 'required|string|max:100',
            'deskripsi_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'id_jenis_kegiatan' => 'required|integer',
            'id_dokumen' => 'required|integer',
            'jenis_pengguna' => 'required|string',
            'nama' => 'required|string|max:100',
            'id_pengguna' => 'required|integer'
        ]);
        KegiatanModel::create([
            'judul_kegiatan' => $request->judul_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'id_jenis_kegiatan' => $request->id_jenis_kegiatan,
            'id_dokumen' => $request->id_dokumen,
            'jenis_pengguna' => $request->jenis_pengguna,
            'nama' => $request->nama,
            'id_pengguna' => $request->id_pengguna
        ]);
        return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil disimpan');
    }

    public function create_ajax()
    {
        $kegiatan = KegiatanModel::select('id_kegiatan', 'judul_kegiatan')->get();
        return view('kegiatan.create_ajax')->with('kegiatan', $kegiatan);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'judul_kegiatan' => 'required|string|max:100',
                'deskripsi_kegiatan' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'id_jenis_kegiatan' => 'required|integer',
                'id_dokumen' => 'required|integer',
                'jenis_pengguna' => 'required|string',
                'nama' => 'required|string|max:100',
                'id_pengguna' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            KegiatanModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data kegiatan berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function show(string $id_kegiatan){
        $kegiatan = KegiatanModel::find($id_kegiatan);
        $breadcrumb = (object)[
            'title'=>'Detail Kegiatan',
            'list'=>['Home','Kegiatan','Detail']
        ];
        $page = (object)[
            'title'=>'Detail kegiatan'
        ];
        $activeMenu = 'kegiatan';
        return view('kegiatan.show', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'activeMenu'=>$activeMenu, 'kegiatan'=>$kegiatan]);
    }

    public function show_ajax(string $id) {
        $kegiatan = KegiatanModel::find($id);
        return view('kegiatan.show_ajax', ['kegiatan' => $kegiatan]);
    }

    public function edit(string $id_kegiatan){
        $kegiatan = KegiatanModel::find($id_kegiatan);

        $breadcrumb = (object)[
            'title'=>'Edit Kegiatan',
            'list'=>['Home','Kegiatan','Edit']
        ];
        $page = (object)[
            'title'=>'Edit kegiatan'
        ];
        $activeMenu = 'kegiatan';
        return view('kegiatan.edit', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'activeMenu'=>$activeMenu, 'kegiatan'=>$kegiatan]);
    }

    public function update(Request $request, string $id_kegiatan){
        $request->validate([
            'judul_kegiatan' => 'required|string|max:100',
            'deskripsi_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'id_jenis_kegiatan' => 'required|integer',
            'id_dokumen' => 'required|integer',
            'jenis_pengguna' => 'required|string',
            'nama' => 'required|string|max:100',
            'id_pengguna' => 'required|integer'
        ]);
        $kegiatan = KegiatanModel::find($id_kegiatan);
        $kegiatan->update([
            'judul_kegiatan' => $request->judul_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'id_jenis_kegiatan' => $request->id_jenis_kegiatan,
            'id_dokumen' => $request->id_dokumen,
            'jenis_pengguna' => $request->jenis_pengguna,
            'nama' => $request->nama,
            'id_pengguna' => $request->id_pengguna
        ]);
        return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil diperbarui');
    }

    public function edit_ajax(string $id)
    {
        $kegiatan = KegiatanModel::find($id);
        return view('kegiatan.edit_ajax', ['kegiatan' => $kegiatan]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'judul_kegiatan' => 'required|string|max:100',
                'deskripsi_kegiatan' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'id_jenis_kegiatan' => 'required|integer',
                'id_dokumen' => 'required|integer',
                'jenis_pengguna' => 'required|string',
                'nama' => 'required|string|max:100',
                'id_pengguna' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $check = KegiatanModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
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

    public function destroy(string $id_kegiatan){
        $check = KegiatanModel::find($id_kegiatan);
        if (!$check) {
            return redirect('/kegiatan')->with('error', 'Data kegiatan tidak ditemukan');
        }
        try {
            KegiatanModel::destroy($id_kegiatan);
            return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kegiatan')->with('error', 'Data kegiatan gagal dihapus karena masih terkait dengan data lain');
        }
    }

    public function confirm_ajax(string $id) {
        $kegiatan = KegiatanModel::find($id);
        return view('kegiatan.confirm_ajax', ['kegiatan' => $kegiatan]);
    }

    public function delete_ajax(Request $request, string $id) {
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $check = KegiatanModel::find($id);
                if ($check) {
                    KegiatanModel::destroy($id);
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
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data kegiatan gagal dihapus karena masih terkait dengan data lain'
                ]);
            }
        }
        return redirect('/');
    }
}