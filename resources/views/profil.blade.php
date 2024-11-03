@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-gradient text-white text-center py-4">
                        <h4 class="mb-0">
                            <i class="fas fa-user-edit"></i> Edit Profil
                        </h4>
                    </div>
                    <div class="card-body p-5">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <div class="position-relative mb-3">
                                @if ($pengguna->profile_image)
                                    <img src="{{ asset('storage/photos/' . $pengguna->profile_image) }}"
                                        class="img-fluid rounded-circle shadow-lg"
                                        style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #f8f9fa;">
                                @else
                                    <img src="{{ asset('img/polinema.png') }}"
                                        class="img-fluid rounded-circle shadow-lg"
                                        style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #f8f9fa;">
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $pengguna->nama }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $pengguna->email }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="profile_image">Foto Profil</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control">
                            </div>

                            <div class="form-group mb-3 text-center">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection