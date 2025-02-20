<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\ObservasiController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TerapisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTerapisController;
use App\Http\Controllers\UserAnakController;
use App\Models\Kunjungan;
use App\Models\Observasi;
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


Route::get('/', [FrontendController::class, 'index']);
Route::get('/mobile', [MobileController::class, 'index'])->name('mobile.login');

Route::get('/contact', function () {
    return view(('frontend.contact'));
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');



Auth::routes();

Route::group(['middleware' => ['role:super-admin|admin|terapis|keuangan']], function () {

    Route::resource('/roles', RoleController::class);
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/manajemen-menu', [RoleController::class, 'manajemen_menu']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('/permissions', App\Http\Controllers\PermissionController::class);
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::resource('/users', UserController::class);
    Route::post('/users/anak', [UserController::class, 'store_anak'])->name('usersanak.store');
    Route::post('/users/terapis', [UserController::class, 'store_terapis'])->name('usersterapis.store');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/terapis', TerapisController::class);
    Route::resource('/program', ProgramController::class);
    Route::resource('/pelatihan', PelatihanController::class);
    Route::resource('/anak', AnakController::class);
    Route::resource('/profile', ProfileController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::resource('/menu', JadwalController::class);
    Route::resource('/career', CareerController::class);
    Route::get('/observasi', [ObservasiController::class, 'index'])->name('observasi.index');
    Route::get('rekap-kas', [KeuanganController::class, 'rekap'])->name('keuangan.rekap');
    Route::get('pemasukkan/json', [KeuanganController::class, 'pemasukkan_json'])->name('pemasukkan.json');
    Route::get('pengeluaran/json', [KeuanganController::class, 'pengeluaran_json'])->name('pengeluaran.json');
    Route::get('kategori', [KeuanganController::class, 'kategori'])->name('keuangan.kategori');
    Route::post('/kategori/simpan', [KeuanganController::class, 'kategori_store'])->name('kategori.store');
    Route::delete('/kategori/{kategori}', [KeuanganController::class, 'kategori_destroy'])->name('kategori.destroy');
    Route::get('pemasukkan', [KeuanganController::class, 'pemasukkan'])->name('keuangan.pemasukkan');
    Route::post('/pemasukkan/simpan', [KeuanganController::class, 'pemasukkan_store'])->name('pemasukkan.store');
    Route::delete('/pemasukkan/{pemasukkan}', [KeuanganController::class, 'pemasukkan_destroy'])->name('pemasukkan.destroy');
    Route::get('pengeluaran', [KeuanganController::class, 'pengeluaran'])->name('keuangan.pengeluaran');
    Route::post('/pengeluaran/simpan', [KeuanganController::class, 'pengeluaran_store'])->name('pengeluaran.store');
    Route::delete('/pengeluaran/{pengeluaran}', [KeuanganController::class, 'pengeluaran_destroy'])->name('pengeluaran.destroy');
    Route::get('/laporan-keuangan', [KeuanganController::class, 'laporan_keuangan'])->name('keuangan.laporan');
    Route::get('/laporan/pdf/{start_date}/{end_date}', [KeuanganController::class, 'laporan_pdf'])->name('laporan.pdf');

    Route::get('/observasi/atec', [ObservasiController::class, 'observasi_atec'])->name('observasi.atec');
    Route::get('/kunjungan/{anak}', [KunjunganController::class, 'create'])->name('kunjungan.create');
    Route::get('/terapis/pelatihan/{terapi}', [TerapisController::class, 'terapis_pelatihan'])->name('terapis.pelatihan');
    Route::post('/terapis/pelatihan', [TerapisController::class, 'pelatihan_store'])->name('pelatihans.store');
    Route::get('/terapis/sertifikat/{sertifikat}', [TerapisController::class, 'sertifikat_show'])->name('sertifikat.show');
    Route::resource('/kunjungan', KunjunganController::class);
    Route::get('/pencarian/proses', [PencarianController::class, 'proses']);
    Route::get('/data/{kunjungan}', [KunjunganController::class, 'show'])->name('kunjungan.show');
    Route::get('/data', [KunjunganController::class, 'riwayatAnak'])->name('kunjungan.data');
    Route::post('/pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');

    Route::post('/ubah-status-anak', [AnakController::class, 'ubahStatus'])->name('anak.status');
    Route::post('/ubah-status-terapis', [TerapisController::class, 'ubahStatus'])->name('terapis.status');

    Route::post('/observasi/mulai', [ObservasiController::class, 'observasi_mulai'])->name('observasi.mulai');
    Route::post('/observasi/atec', [ObservasiController::class, 'observasi_atec'])->name('observasi.atec');

    Route::post('/upload-foto/{id}', [AnakController::class, 'uploadfoto'])->name('upload.foto');
    Route::get('/delete-foto/{id}', [AnakController::class, 'deletefoto'])->name('delete.foto');
});

Route::group(['middleware' => ['role:anak']], function () {

    Route::get('/app', [App\Http\Controllers\MobileController::class, 'app'])->name('app');
});
