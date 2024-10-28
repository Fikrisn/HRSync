<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Pimp\DashboardControllerP;
use App\Http\Controllers\Admin\DashboardControllerA;
use App\Http\Controllers\DosenA\DashboardControllerDA;
use App\Http\Controllers\DosenP\DashboardControllerDP;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Route::get('/', [DashboardControllerP::class, 'index']);

Route::get('/', [DashboardControllerA::class, 'index']);
Route::prefix('kegiatanAg')->group(function () {
    Route::get('/', [KegiatanController::class, 'index'])->name('kegiatanAg.index');
    Route::get('/list', [KegiatanController::class, 'list'])->name('kegiatanAg.list');
});
Route::prefix('pengguna')->group(function () {
    Route::get('/', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::post('/list', [PenggunaController::class, 'list'])->name('pengguna.list');
});
// Route::get('/', [DashboardControllerDA::class, 'index']);

// Route::get('/',[DashboardControllerDP::class, 'index']);