@extends('Admin.layouts.template')

@section('content')
    <div class="card bg-light shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Kategori</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kegiatanAg/import') }}')" class="btn btn-sm btn-info mt-1">Import Kegiatan</button>
                <a href="{{url('/kegiatanAg/export_excel')}}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Kategori(Excel)</a>
                <button onclick="modalAction('{{ url('kegiatanAg/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Kegiatan</button>
            </div>
        </div>
        <div class="card-body">
            <!-- Tabel daftar kegiatan akan muncul di sini -->
            <table id="kegiatanTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Agenda</th>
                        <th>Bobot Agenda</th>
                        <th>Status</th>
                        <th>Dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Script DataTables untuk mengisi tabel -->
    <script>
        $(document).ready(function() {
            $('#kegiatanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("admin/kegiatanAg/list") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama_agenda', name: 'nama_agenda' },
                    { data: 'bobot_agenda', name: 'bobot_agenda' },
                    { data: 'status_agenda', name: 'status_agenda' },
                    { data: 'dokumen', name: 'dokumen' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endsection
