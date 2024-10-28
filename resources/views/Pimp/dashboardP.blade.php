@extends('Pimp.layouts.template')

@section('content')
    <div class="card bg-light shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-uppercase">Selamat Datang di Aplikasi Manajemen SDM</h3>
        </div>
        <div class="card-body p-4">
            <p class="lead">Aplikasi ini dirancang untuk mendukung pimpinan dalam pengelolaan sumber daya manusia secara efisien dan strategis.</p>
            <p>Fitur utama aplikasi ini meliputi:</p>
            <ul>
                <li>Pengelolaan data pegawai secara terpusat</li>
                <li>Manajemen absensi dan cuti pegawai</li>
                <li>Pengaturan penggajian dan tunjangan</li>
                <li>Analisis kinerja pegawai dan laporan strategis</li>
            </ul>
            <p class="lead">Silakan jelajahi fitur-fitur ini untuk mendukung keputusan strategis yang optimal bagi tim Anda!</p>

            <div class="d-flex justify-content-around mt-4">
                <div class="text-center">
                    <h5>Persentase Kinerja Pegawai</h5>
                    <p class="display-6 text-primary">95%</p>
                </div>
                <div class="text-center">
                    <h5>Indeks Kepuasan Pegawai</h5>
                    <p class="display-6 text-warning">88%</p>
                </div>
            </div>
        </div>
    </div>
@endsection
