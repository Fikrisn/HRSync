<?php

namespace App\Http\Controllers;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;
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
        $kegiatan = KegiatanModel::select('kegiatan_id', 'kegiatan_kode', 'kegiatan_nama', 'tanggal_mulai', 'tanggal_selesai');
        if($request->kegiatan_id){
            $kegiatan->where('kegiatan_id', $request->kegiatan_id);
        }
        return DataTables::of($kegiatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kegiatan) {
                $btn = '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->kegiatan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->kegiatan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->kegiatan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
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
            'kegiatan_kode' => 'required|string|min:3|unique:m_kegiatan,kegiatan_kode',
            'kegiatan_nama' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);
        KegiatanModel::create([
            'kegiatan_kode' => $request->kegiatan_kode,
            'kegiatan_nama' => $request->kegiatan_nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);
        return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil disimpan');
    }

    public function create_ajax()
    {
        $kegiatan = KegiatanModel::select('kegiatan_id', 'kegiatan_nama')->get();
        return view('kegiatan.create_ajax')->with('kegiatan', $kegiatan);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kegiatan_kode' => 'required|string|min:3|unique:m_kegiatan,kegiatan_kode',
                'kegiatan_nama' => 'required|string|max:100',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
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

    public function show(string $kegiatan_id){
        $kegiatan = KegiatanModel::find($kegiatan_id);
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

    public function edit(string $kegiatan_id){
        $kegiatan = KegiatanModel::find($kegiatan_id);

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

    public function update(Request $request, string $kegiatan_id){
        $request->validate([
            'kegiatan_kode' => 'required|string|min:3|unique:m_kegiatan,kegiatan_kode,' . $kegiatan_id . ',kegiatan_id',
            'kegiatan_nama' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);
        $kegiatan = KegiatanModel::find($kegiatan_id);
        $kegiatan->update([
            'kegiatan_kode' => $request->kegiatan_kode,
            'kegiatan_nama' => $request->kegiatan_nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
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
                'kegiatan_kode' => 'required|string|min:3|unique:m_kegiatan,kegiatan_kode,' . $id . ',kegiatan_id',
                'kegiatan_nama' => 'required|string|max:100',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
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

    public function destroy(string $kegiatan_id){
        $check = KegiatanModel::find($kegiatan_id);
        if (!$check) {
            return redirect('/kegiatan')->with('error', 'Data kegiatan tidak ditemukan');
        }
        try {
            KegiatanModel::destroy($kegiatan_id);
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
