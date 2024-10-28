@extends('DosenP.layouts.template')

@section('content')
    <div class="card bg-light shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-uppercase">Selamat Datang di Aplikasi Manajemen SDM</h3>
        </div>
        <div class="card-body p-4">
            <p class="lead">Aplikasi ini dirancang untuk membantu dosen PIC dalam mengelola dan memantau sumber daya manusia pada proyek atau kegiatan yang dikoordinasikan.</p>
            <p>Fitur utama yang tersedia meliputi:</p>
            <ul>
                <li>Pengelolaan data anggota tim proyek</li>
                <li>Manajemen absensi dan jadwal kerja anggota tim</li>
                <li>Pelacakan pengajuan cuti dan izin</li>
                <li>Analisis kinerja dan laporan perkembangan kegiatan</li>
            </ul>
            <p class="lead">Gunakan fitur-fitur ini untuk memantau dan mendukung pelaksanaan tugas tim dengan lebih efektif!</p>

            <div class="d-flex justify-content-around mt-4">
                <div class="text-center">
                    <h5>Progress Kinerja Tim</h5>
                    <p class="display-6 text-primary">95%</p>
                </div>
                <div class="text-center">
                    <h5>Tingkat Kepuasan Tim</h5>
                    <p class="display-6 text-warning">88%</p>
                </div>
            </div>
        </div>
    </div>
@endsection
