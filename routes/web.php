<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TerapisController;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

// Route::middleware(['admin'])->group(function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::resource('/upload', UploadController::class);
//     Route::get('/upload/search', [UploadController::class, 'search'])->name('upload.search');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/anak', AnakController::class);
    Route::resource('/terapis', TerapisController::class);
    Route::get('/kunjungan/{anak}', [KunjunganController::class, 'create'])->name('kunjungan.create');
    Route::resource('/kunjungan', KunjunganController::class);
    Route::get('/pencarian/proses', [PencarianController::class, 'proses']);
    Route::get('/data/{kunjungan}', [KunjunganController::class, 'show'])->name('kunjungan.show');
    Route::get('/data', [KunjunganController::class, 'riwayatAnak'])->name('kunjungan.data');
    Route::post('/pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
});
