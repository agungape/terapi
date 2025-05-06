<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InformasiController;
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
use App\Http\Controllers\PsikologController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TarifController;
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

Route::group(['middleware' => ['role:super-admin|admin|terapis|keuangan|psikolog']], function () {

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
    Route::post('/users/psikolog', [UserController::class, 'store_psikolog'])->name('userspsikolog.store');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/terapis', TerapisController::class);
    Route::resource('/program', ProgramController::class);
    Route::resource('/pelatihan', PelatihanController::class);
    Route::resource('/anak', AnakController::class);
    Route::get('/profile-user', [ProfileController::class, 'profile_user'])->name('profile.user');
    Route::resource('/profile', ProfileController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::resource('/menu', JadwalController::class);
    Route::resource('/career', CareerController::class);
    Route::resource('/tarif', TarifController::class);
    Route::resource('/informasi', InformasiController::class);

    Route::get('/q-pendengaran', [QuestionController::class, 'index'])->name('question.pendengaran');
    Route::post('/q-pendengaran/simpan', [QuestionController::class, 'pendengaran_store'])->name('qpendengaran.store');
    Route::delete('/q-pendengaran/{id}', [QuestionController::class, 'hapus_pendengaran'])->name('qpendengaran.destroy');
    Route::get('/q-umur', [QuestionController::class, 'umur'])->name('question.umur');
    Route::delete('/q-umur/{id}', [QuestionController::class, 'hapus_umur'])->name('age.destroy');
    Route::post('/q-umur/simpan', [QuestionController::class, 'umur_store'])->name('age.store');
    Route::get('/q-penglihatan', [QuestionController::class, 'q_penglihatan'])->name('question.penglihatan');
    Route::post('/q-penglihatan/simpan', [QuestionController::class, 'penglihatan_store'])->name('qpenglihatan.store');
    Route::delete('/q-penglihatan/{id}', [QuestionController::class, 'penglihatan_destroy'])->name('qpenglihatan.destroy');
    Route::get('/q-perilaku', [QuestionController::class, 'q_perilaku'])->name('question.perilaku');
    Route::post('/q-perilaku/simpan', [QuestionController::class, 'perilaku_store'])->name('qperilaku.store');
    Route::delete('/q-perilaku/{id}', [QuestionController::class, 'perilaku_destroy'])->name('qperilaku.destroy');
    Route::get('/q-autis', [QuestionController::class, 'q_autis'])->name('question.autis');
    Route::post('/q-autis/simpan', [QuestionController::class, 'autis_store'])->name('qautis.store');
    Route::delete('/q-autis/{id}', [QuestionController::class, 'autis_destroy'])->name('qautis.destroy');
    Route::get('/q-gpph', [QuestionController::class, 'q_gpph'])->name('question.gpph');
    Route::post('/q-gpph/simpan', [QuestionController::class, 'gpph_store'])->name('qgpph.store');
    Route::delete('/q-gpph/{id}', [QuestionController::class, 'gpph_destroy'])->name('qgpph.destroy');
    Route::get('/q-wawancara', [QuestionController::class, 'q_wawancara'])->name('question.wawancara');
    Route::post('/q-wawancara/simpan', [QuestionController::class, 'wawancara_store'])->name('qwawancara.store');
    Route::delete('/q-wawancara/{id}', [QuestionController::class, 'wawancara_destroy'])->name('qwawancara.destroy');


    Route::post('/tarif/upload-gambar', [TarifController::class, 'uploadGambar'])->name('tarif.uploadGambar');
    Route::delete('/tarif/hapus-gambar/{id}', [TarifController::class, 'hapusGambar'])->name('tarif.hapusGambar');
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
    Route::get('/keuangan/laporan/pdf/{startDate}/{endDate}', [KeuanganController::class, 'laporan_pdf'])->name('keuangan.laporan.pdf');



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

    Route::get('/observasi/{anak}', [ObservasiController::class, 'show'])->name('observasi.show');
    Route::post('/observasi/mulai', [ObservasiController::class, 'observasi_mulai'])->name('observasi.mulai');
    Route::post('/observasi/atec', [ObservasiController::class, 'observasi_atec'])->name('observasi.atec');
    Route::post('/observasi/hpperilaku', [ObservasiController::class, 'observasi_hpperilaku'])->name('observasi.hpperilaku');
    Route::post('/observasi/hpsensorik', [ObservasiController::class, 'observasi_hpsensorik'])->name('observasi.hpsensorik');
    Route::post('/observasi-pendengaran/simpan', [ObservasiController::class, 'observasi_pendengaran'])->name('obpendengaran.store');
    Route::post('/observasi-penglihatan/simpan', [ObservasiController::class, 'observasi_penglihatan'])->name('observasi.penglihatan');
    Route::post('/observasi-perilaku/simpan', [ObservasiController::class, 'observasi_perilaku'])->name('observasi.perilaku');
    Route::post('/observasi-autis/simpan', [ObservasiController::class, 'observasi_autis'])->name('observasi.autis');
    Route::post('/observasi-gpph/simpan', [ObservasiController::class, 'observasi_gpph'])->name('observasi.gpph');
    Route::post('/observasi/cetak', [ObservasiController::class, 'cetakObservasi'])->name('observasi.cetak');
    Route::patch('/observasi/hpperilaku/{id}', [ObservasiController::class, 'hpperilaku_update'])->name('hpperilaku.update');
    Route::patch('/observasi/hpsensorik/{id}', [ObservasiController::class, 'hpsensorik_update'])->name('hpsensorik.update');



    Route::post('/upload-foto/{id}', [AnakController::class, 'uploadfoto'])->name('upload.foto');
    Route::get('/delete-foto/{id}', [AnakController::class, 'deletefoto'])->name('delete.foto');
    Route::get('/delete-fototerapis/{id}', [TerapisController::class, 'deletefoto'])->name('delete.fototerapis');

    // route assessment
    Route::resource('/assessment', AssessmentController::class);

    // route psikolog
    Route::resource('/psikolog', PsikologController::class);
});


Route::group(['middleware' => ['role:anak']], function () {

    Route::get('/app', [App\Http\Controllers\MobileController::class, 'app'])->name('app');
    Route::get('/app/profile', [MobileController::class, 'profile'])->name('mobile.profile');
    Route::get('/app/profile/edit', [MobileController::class, 'profile_edit'])->name('mobile.editprofile');
    Route::patch('/app/profile/{anak}', [MobileController::class, 'profile_update'])->name('mobile.updateprofile');
    Route::get('/app/change-password', [MobileController::class, 'ubah_password'])->name('mobile.ubahpassword');
    Route::patch('/app/change-password/{user}', [MobileController::class, 'update_password'])->name('mobile.updatepassword');
    Route::get('/app/kunjungan', [MobileController::class, 'kunjungan'])->name('mobile.kunjungan');
    Route::get('/app/kunjungan/{id}', [MobileController::class, 'kunjungan_detail'])->name('kunjunganmobile.detail');
    Route::get('/app/paket/{id}', [MobileController::class, 'tarif_detail'])->name('tarifmobile.detail');
    Route::get('/app/payment', [MobileController::class, 'payment'])->name('mobile.payment');
    Route::get('/invoice/{id}/download', [MobileController::class, 'download_invoice'])->name('invoice.download');
});
