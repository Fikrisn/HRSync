@extends('Admin.layouts.template')

@section('content')
    <div class="card bg-light shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Kegiatan</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kegiatanAg/import') }}')" class="btn btn-sm btn-info mt-1">Import Kegiatan</button>
                <a href="{{url('/kegiatanAg/export_excel')}}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Kegiatan (Excel)</a>
                <button onclick="modalAction('{{ url('kegiatanAg/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Kegiatan</button>
            </div>
        </div>
        <div class="card-body">
            <table id="kegiatanTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Script DataTables -->
    <script>
        $(document).ready(function() {
            $('#kegiatanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url("admin/kegiatanAg/list") }}',
                    type: 'POST',
                    data: function (d) {
                        d._token = '{{ csrf_token() }}';
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nama', name: 'nama'},
                    {data: 'judul_kegiatan', name: 'judul_kegiatan'},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
                ]
            });
        });

        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    </script>
@endsection