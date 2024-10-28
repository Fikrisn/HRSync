@extends('Admin.layouts.template')

@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Nama Kegiatan</th>
                    <th>Draft Surat Tugas</th>
                    <th>Upload Surat Tugas</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#kegiatanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("admin/kegiatanAg/list") }}', // Server-side URL for fetching data
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    render: function() {
                        return '<input type="checkbox">';
                    },
                    orderable: false,
                    searchable: false
                },
                { 
                    data: 'nama_kegiatan',
                    name: 'nama_kegiatan',
                    render: function(data, type, row) {
                        return '<strong>' + row.nama_kegiatan + '</strong><br><small>' + row.pic_dosen + '</small>';
                    }
                },
                { 
                    data: 'draft_surat',
                    name: 'draft_surat',
                    render: function(data, type, row) {
                        return '<a href="{{ asset("storage/") }}/' + row.draft_surat + '" class="btn btn-success btn-sm">Unduh</a>';
                    }
                },
                { 
                    data: 'upload_surat',
                    name: 'upload_surat',
                    render: function(data, type, row) {
                        return '<a href="{{ asset("storage/") }}/' + row.upload_surat + '" class="btn btn-primary btn-sm">Unduh</a>';
                    }
                }
            ]
        });
    });
</script>

@endsection
