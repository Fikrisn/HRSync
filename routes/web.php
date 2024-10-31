<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\stokcontroller;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::pattern('id', '[0-9]+'); //artinya ketika ada parameter {id}, maka harus berupa angka


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');// New routes for registration

Route::get('/register', [AuthController::class, 'postregister']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);

    Route::group(['prefix'=>'jenis_pengguna','middleware'=>['authorize:Admin']], function () {
        Route::get('/', [PenggunaController::class, 'index']);          // menampilkan halaman awal jenis pengguna
        Route::post('/list', [PenggunaController::class, 'list']);      // menampilkan data jenis pengguna dalam json untuk datatables
        Route::get('/create', [PenggunaController::class, 'create']);   // menampilkan halaman form tambah jenis pengguna
        Route::post('/', [PenggunaController::class, 'store']);         // menyimpan data jenis pengguna baru
        Route::get('/create_ajax', [PenggunaController::class, 'create_ajax']); // Menampilkan halaman form tambah jenis pengguna Ajax
        Route::post('/ajax', [PenggunaController::class, 'store_ajax']); // Menyimpan data jenis pengguna baru Ajax
        Route::get('/{id}', [PenggunaController::class, 'show']);       // menampilkan detail jenis pengguna
        Route::get('/{id}/show_ajax', [PenggunaController::class, 'show_ajax']);
        Route::get('/{id}/edit', [PenggunaController::class, 'edit']);  // menampilkan halaman form edit jenis pengguna
        Route::put('/{id}', [PenggunaController::class, 'update']);     // menyimpan perubahan data jenis pengguna
        Route::get('/{id}/edit_ajax', [PenggunaController::class, 'edit_ajax']); // Menampilkan halaman form edit jenis pengguna Ajax
        Route::put('/{id}/update_ajax', [PenggunaController::class, 'update_ajax']); // Menyimpan perubahan data jenis pengguna Ajax
        Route::get('/{id}/delete_ajax', [PenggunaController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete jenis pengguna Ajax
        Route::delete('/{id}/delete_ajax', [PenggunaController::class, 'delete_ajax']); // Untuk hapus data jenis pengguna Ajax
        Route::delete('/{id}', [PenggunaController::class, 'destroy']); // menghapus data jenis pengguna
        Route::get('/import', [PenggunaController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [PenggunaController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [PenggunaController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [PenggunaController::class, 'export_pdf']); // export pdf
    });
    

    Route::group(['prefix' => 'pengguna', 'middleware' => ['authorize:Admin']], function () {
        Route::get('/', [PenggunaController::class, 'index']);           // menampilkan halaman awal pengguna
        Route::post('/list', [PenggunaController::class, 'list']);       // menampilkan data pengguna dalam json untuk datatables
        Route::get('/create', [PenggunaController::class, 'create']);    // menampilkan halaman form tambah pengguna
        Route::post('/', [PenggunaController::class, 'store']);          // menyimpan data pengguna baru
        Route::get('/create_ajax', [PenggunaController::class, 'create_ajax']); // menampilkan halaman form tambah pengguna Ajax
        Route::post('/ajax', [PenggunaController::class, 'store_ajax']); // menyimpan data pengguna baru Ajax
        Route::get('/{id}', [PenggunaController::class, 'show']);        // menampilkan detail pengguna
        Route::get('/{id}/show_ajax', [PenggunaController::class, 'show_ajax']); // menampilkan detail pengguna Ajax
        Route::get('/{id}/edit', [PenggunaController::class, 'edit']);   // menampilkan halaman form edit pengguna
        Route::put('/{id}', [PenggunaController::class, 'update']);      // menyimpan perubahan data pengguna
        Route::get('/{id}/edit_ajax', [PenggunaController::class, 'edit_ajax']); // menampilkan halaman form edit pengguna Ajax
        Route::put('/{id}/update_ajax', [PenggunaController::class, 'update_ajax']); // menyimpan perubahan data pengguna Ajax
        Route::get('/{id}/delete_ajax', [PenggunaController::class, 'confirm_ajax']); // menampilkan form konfirmasi hapus pengguna Ajax
        Route::delete('/{id}/delete_ajax', [PenggunaController::class, 'delete_ajax']); // menghapus data pengguna Ajax
        Route::delete('/{id}', [PenggunaController::class, 'destroy']); // menghapus data pengguna
        Route::get('/import', [PenggunaController::class, 'import']);   // menampilkan form upload excel
        Route::post('/import_ajax', [PenggunaController::class, 'import_ajax']); // import excel pengguna Ajax
        Route::get('/export_excel', [PenggunaController::class, 'export_excel']); // export data pengguna ke excel
        Route::get('/export_pdf', [PenggunaController::class, 'export_pdf']);     // export data pengguna ke pdf
    });
    

    Route::group(['prefix' => 'kegiatan', 'middleware' => ['authorize:Admin,MNG,STF']], function () {
        Route::get('/', [KegiatanController::class, 'index']);               // Display main page for kegiatan
        Route::post('/list', [KegiatanController::class, 'list']);           // Display kegiatan data as JSON for DataTables
        Route::get('/create', [KegiatanController::class, 'create']);        // Display form for adding kegiatan
        Route::post('/', [KegiatanController::class, 'store']);              // Store new kegiatan data
        Route::get('/create_ajax', [KegiatanController::class, 'create_ajax']); // Display form for adding kegiatan via AJAX
        Route::post('/ajax', [KegiatanController::class, 'store_ajax']);     // Store new kegiatan data via AJAX
        Route::get('/{id}', [KegiatanController::class, 'show']);            // Display kegiatan details
        Route::get('/{id}/show_ajax', [KegiatanController::class, 'show_ajax']); // Display kegiatan details via AJAX
        Route::get('/{id}/edit', [KegiatanController::class, 'edit']);       // Display form for editing kegiatan
        Route::put('/{id}', [KegiatanController::class, 'update']);          // Save updates to kegiatan data
        Route::get('/{id}/edit_ajax', [KegiatanController::class, 'edit_ajax']); // Display form for editing kegiatan via AJAX
        Route::put('/{id}/update_ajax', [KegiatanController::class, 'update_ajax']); // Save updates to kegiatan data via AJAX
        Route::get('/{id}/delete_ajax', [KegiatanController::class, 'confirm_ajax']); // Display confirmation form for deleting kegiatan via AJAX
        Route::delete('/{id}/delete_ajax', [KegiatanController::class, 'delete_ajax']); // Delete kegiatan data via AJAX
        Route::delete('/{id}', [KegiatanController::class, 'destroy']);      // Delete kegiatan data
        Route::get('/import', [KegiatanController::class, 'import']);        // Display form for uploading Excel file
        Route::post('/import_ajax', [KegiatanController::class, 'import_ajax']); // Import Excel data via AJAX
        Route::get('/export_excel', [KegiatanController::class, 'export_excel']); // Export kegiatan data to Excel
        Route::get('/export_pdf', [KegiatanController::class, 'export_pdf']); // Export kegiatan data to PDF
    });
    

    Route::group(['prefix' => 'supplier','middleware'=>['authorize:Admin,MNG,STF']], function () {
        Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
        Route::post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam json untuk datables
        Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
        Route::post('/', [SupplierController::class, 'store']);          // menyimpan data supplier baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supplier Ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Menampilkan data supplier baru Ajax
        Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
        Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
        Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Menampilkan halaman form edit supplier Ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Menyimpan perubahan data supplier Ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete supplier Ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk hapus data supplier Ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
        Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [SupplierController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [SupplierController::class, 'export_pdf']); // export pdf
    });

    Route::group(['prefix' => 'barang','middleware'=>['authorize:Admin,MNG,STF']], function () {
        Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal barang
        Route::post('/list', [BarangController::class, 'list']);      // menampilkan data barang dalam json untuk datables
        Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
        Route::post('/', [BarangController::class, 'store']);          // menyimpan data barang baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah barang Ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']); // Menampilkan data barang baru Ajax
        Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
        Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);
        Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
        Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan halaman form edit barang Ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Menyimpan perubahan data barang Ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete barang Ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk hapus data barang Ajax
        Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
        Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [BarangController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
    });

    Route::group(['prefix' =>'profil'],function(){
        Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
        Route::patch('/{id}', [ProfilController::class, 'update'])->name('profil.update');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::patch('/profil/{id}', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('/profil/upload', [ProfilController::class, 'uploadProfileImage'])->name('profil.upload');
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index')->middleware('auth');
    });

    //route stok
    Route::group(['prefix' =>'stok', 'middleware'=>'authorize:Admin,MNG'],function(){
        Route::get('/', [StokController::class, 'index']);          // menampilkan halaman awal stok
        Route::post('/list', [StokController::class, 'list']);      // menampilkan data stok dalam json untuk datatables
        Route::get('/create', [StokController::class, 'create']);   // menampilkan halaman form tambah stok
        Route::post('/', [StokController::class, 'store']);         // menyimpan data stok baru
        Route::get('/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
        Route::post('/ajax', [StokController::class, 'store_ajax']); // Menyimpan data stok baru Ajax
        Route::get('/{id}', [StokController::class, 'show']);       // menampilkan detail stok
        Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']); // Menampilkan detail stok Ajax
        Route::get('/{id}/edit', [StokController::class, 'edit']);  // menampilkan halaman form edit stok
        Route::put('/{id}', [StokController::class, 'update']);     // menyimpan perubahan data stok
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // Menampilkan halaman form edit stok Ajax
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // Menyimpan perubahan data stok Ajax
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete stok Ajax
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // Untuk hapus data stok Ajax
        Route::delete('/{id}', [StokController::class, 'destroy']); // menghapus data stok
        Route::get('/import', [StokController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [StokController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [StokController::class, 'export_excel']); // ajax export excel
        Route::get('/export_pdf', [StokController::class, 'export_pdf']); // ajax export pdf
    });
    
    // Route::group(['prefix' => 'penjualan', 'middleware' => 'authorize:ADM,MNG'], function () {
    //     Route::get('/', [PenjualanController::class, 'index']);
    //     Route::post('/list', [PenjualanController::class, 'list']);
    //     Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);
    //     Route::post('/ajax', [PenjualanController::class, 'store_ajax']);
    //     Route::get('/{id}/show_ajax', [PenjualanController::class, 'show_ajax']);
    //     Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);
    //     Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']);
    //     Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);
    //     Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']);
    //     Route::delete('/{id}', [PenjualanController::class, 'destroy']);
    //     Route::get('/import', [PenjualanController::class, 'import']); // ajax form upload excel
    //     Route::post('/import_ajax', [PenjualanController::class, 'import_ajax']); // ajax import excel
    //     Route::get('/export_excel', [PenjualanController::class, 'export_excel']); // ajax import excel
    //     Route::get('/export_pdf', [PenjualanController::class, 'export_pdf']); // ajax export pdf        
    // });
});