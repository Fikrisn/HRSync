@extends('DosenA.layouts.template')

@section('content')
    <div class="card bg-light shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-uppercase">Selamat Datang di Aplikasi Manajemen SDM</h3>
        </div>
        <div class="card-body p-4">
            <p class="lead">Aplikasi ini dirancang untuk membantu dosen dalam mengelola tugas dan kegiatan tim dengan lebih efisien.</p>
            <p>Fitur utama yang dapat diakses meliputi:</p>
            <ul>
                <li>Pengelolaan informasi kehadiran dan izin</li>
                <li>Akses data kinerja dan laporan tim</li>
                <li>Pelacakan perkembangan tugas yang dikoordinasikan oleh dosen PIC</li>
                <li>Laporan kegiatan dan dokumentasi</li>
            </ul>
            <p class="lead">Gunakan fitur-fitur ini untuk mempermudah pemantauan tugas dan pencapaian tim Anda!</p>

            <div class="d-flex justify-content-around mt-4">
                <div class="text-center">
                    <h5>Kehadiran Bulan Ini</h5>
                    <p class="display-6 text-primary">95%</p>
                </div>
                <div class="text-center">
                    <h5>Indeks Kepuasan Anggota</h5>
                    <p class="display-6 text-warning">88%</p>
                </div>
            </div>
        </div>
    </div>
@endsection
