@extends('Admin.layouts.template')

@section('title', 'Daftar Kegiatan Dosen')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Kegiatan Dosen</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <table class="table table-bordered table-striped" id="kegiatanTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Kegiatan</th>
                <th>Deskripsi Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jenis Kegiatan</th>
                <th>PIC</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatan as $key => $activity)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $activity->judul_kegiatan }}</td>
                <td>{{ $activity->deskripsi_kegiatan }}</td>
                <td>{{ $activity->tanggal_mulai }}</td>
                <td>{{ $activity->tanggal_selesai }}</td>
                <td>{{ $activity->jenis_kegiatan->nama_jenis ?? '-' }}</td>
                <td>{{ $activity->pic->nama_dosen ?? '-' }}</td>
                <td>
                    <a href="{{ route('kegiatan.edit', $activity->id_kegiatan) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kegiatan.destroy', $activity->id_kegiatan) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- DataTables Script -->
<script>
    $(document).ready(function() {
        $('#kegiatanTable').DataTable();
    });
</script>
@endsection
