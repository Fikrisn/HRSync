@extends('layouts.app') <!-- Adjust to your main layout -->

@section('content')
    <div class="container">
        <div class="card bg-light shadow-sm mt-5">
            <div class="card-header text-center">
                <h1 class="text-uppercase">Selamat Datang di Aplikasi Manajemen SDM</h1>
                <p class="lead mt-3">Mengelola sumber daya manusia kini lebih efisien dan efektif.</p>
            </div>
            <div class="card-body p-5 text-center">
                <h3 class="mb-4">Fitur Utama</h3>
                <div class="row">
                    <div class="col-md-3">
                        <h5>Data Karyawan</h5>
                        <p>Kelola informasi karyawan dengan mudah.</p>
                    </div>
                    <div class="col-md-3">
                        <h5>Absensi & Cuti</h5>
                        <p>Manajemen absensi dan permohonan cuti.</p>
                    </div>
                    <div class="col-md-3">
                        <h5>Penggajian</h5>
                        <p>Atur penggajian dengan cepat dan akurat.</p>
                    </div>
                    <div class="col-md-3">
                        <h5>Analisis Kinerja</h5>
                        <p>Evaluasi performa dengan laporan lengkap.</p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col text-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Mulai Menjelajahi</a>
                    </div>
                </div>

                <div class="d-flex justify-content-around mt-5">
                    <div class="text-center">
                        <h5>Kinerja Karyawan</h5>
                        <p class="display-6 text-primary">95%</p>
                    </div>
                    <div class="text-center">
                        <h5>Tingkat Kepuasan</h5>
                        <p class="display-6 text-warning">88%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
