<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratTugasModel;
use App\Models\kegiatanAgendaModel;
use Yajra\DataTables\Facades\DataTables;

class SuratTugasController extends Controller
{
    // Show the list of "Surat Tugas"
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Surat Tugas',
            'list' => ['Home', 'Surat Tugas']
        ];
        $page = (object)[
            'title' => 'Daftar Surat Tugas Dosen Kegiatan'
        ];
        $activeMenu = 'suratTugas';
        return view('Admin.suratTugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Show the form for creating a new "Surat Tugas"
    public function create()
    {
        $kegiatan = kegiatanAgendaModel::all(); // Fetch all activities for dropdown
        return view('Admin.suratTugas.create', compact('kegiatan'));
    }

    // Store a new "Surat Tugas" in the database
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:agenda_kegiatan,id_agenda',
            'user_name' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'surat_tugas' => 'required',
            'dokumentasi' => 'required',
        ]);

        // Get the activity details
        $kegiatan = kegiatanAgendaModel::findOrFail($request->activity_id);

        // Create a new record
        SuratTugasModel::create([
            'activity_name' => $kegiatan->nama_agenda,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'status' => $request->status,
            'surat_tugas' => $request->surat_tugas,
            'dokumentasi' => $request->dokumentasi,
            'activity_id' => $kegiatan->id_agenda
        ]);

        return redirect()->route('suratTugas.index')->with('success', 'Surat Tugas berhasil ditambahkan');
    }

    // Show the form for editing an existing "Surat Tugas"
    public function edit($id)
    {
        $suratTugas = SuratTugasModel::findOrFail($id);
        $kegiatan = kegiatanAgendaModel::all();
        return view('Admin.suratTugas.edit', compact('suratTugas', 'kegiatan'));
    }

    // Update an existing "Surat Tugas" in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'activity_id' => 'required|exists:agenda_kegiatan,id_agenda',
            'user_name' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'surat_tugas' => 'required',
            'dokumentasi' => 'required',
        ]);

        $kegiatan = kegiatanAgendaModel::findOrFail($request->activity_id);
        $suratTugas = SuratTugasModel::findOrFail($id);

        $suratTugas->update([
            'activity_name' => $kegiatan->nama_agenda,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'status' => $request->status,
            'surat_tugas' => $request->surat_tugas,
            'dokumentasi' => $request->dokumentasi,
        ]);

        return redirect()->route('suratTugas.index')->with('success', 'Surat Tugas berhasil diperbarui');
    }

    // Fetch data for DataTable
    public function list(Request $request)
    {
        $suratTugas = SuratTugasModel::with('kegiatan')->select('id', 'user_name', 'email', 'status', 'surat_tugas', 'dokumentasi', 'activity_id');

        return DataTables::of($suratTugas)
            ->addIndexColumn()
            ->addColumn('activity_name', function ($row) {
                return $row->kegiatan->nama_agenda ?? '-';
            })
            ->addColumn('pic', function ($row) {
                return $row->kegiatan->pic ?? '-';
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<button onclick="modalAction(\'' . url('/suratTugas/' . $row->id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/suratTugas/' . $row->id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
