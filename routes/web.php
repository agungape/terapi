<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\AnalisiskinerjaController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AlatUkurController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\FisioterapiController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\MobileNewController;
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
use App\Http\Controllers\ShopeeAffiliateController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TerapisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTerapisController;
use App\Http\Controllers\UserAnakController;
use App\Models\Kunjungan;
use App\Models\Observasi;
use Database\Factories\ObservasiFactory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// route website
Route::get('/', [FrontendController::class, 'index']);
Route::get('/services', [FrontendController::class, 'services']);
Route::get('/about', [FrontendController::class, 'about']);
Route::get('/blog', [FrontendController::class, 'blog']);
Route::get('/contact', [FrontendController::class, 'contact']);
Route::get('/therapists', [FrontendController::class, 'therapists']);

Route::get('/barcode/scan', [ObservasiController::class, 'scanBarcode'])->name('barcode.scan');
Route::get('/barcode/assessment/scan', [AssessmentController::class, 'scanBarcode'])->name('barcode.assessment.scan');

// Short Verification Routes
Route::get('/v/o/{id}/{date}/{sig}', [ObservasiController::class, 'verifyBarcode'])->name('barcode.verify.observasi');
Route::get('/v/a/{id}/{sig}', [AssessmentController::class, 'verifyBarcode'])->name('barcode.verify.assessment');

Route::get('/mobile', [MobileController::class, 'index'])->name('mobile.login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

Route::get('/generate-permissions', function () {
    $permissions = [
        // View permissions (Menu / Sidebar)
        'view anak', 'view terapis', 'view psikolog', 'view alat ukur', 'view program anak', 'view tarif', 'view pelatihan', 
        'view master umur', 'view pendengaran', 'view penglihatan', 'view perilaku', 'view autis', 'view gpph', 'view wawancara',
        'view role', 'view permission', 'view user', 'view manajemen menu',
        'view rekapan kas', 'view pemasukkan', 'view pengeluaran', 'view kategori', 'view laporan keuangan',
        'view observasi', 'view assessment', 'view rekammedis', 'view jadwal anak',
        'view informasi', 'view profile', 'view profile user',
        'view kategori produk', 'view layanan produk',
        'view laporan kunjungan', 'view analisis kinerja',
        'view career', 'view pembayaran', 'view kontrak', 'view pengaturan website',
        'view kunjungan', 'view riwayat terapi', 'view portal absensi',

        // CRUD permissions (Controllers)
        'create anak', 'show anak', 'update anak', 'delete anak',
        'create terapis', 'show terapis', 'update terapis', 'delete terapis', 'delete foto terapis',
        'create psikolog', 'show psikolog', 'update psikolog', 'delete psikolog',
        'create alat ukur', 'update alat ukur', 'delete alat ukur',
        'create program anak', 'update program anak', 'delete program anak',
        'create tarif', 'update tarif', 'delete tarif',
        'create pelatihan', 'update pelatihan', 'delete pelatihan',
        'create master umur', 'update master umur', 'delete master umur',
        'create pendengaran', 'update pendengaran', 'delete pendengaran',
        'create penglihatan', 'update penglihatan', 'delete penglihatan',
        'create perilaku', 'update perilaku', 'delete perilaku',
        'create autis', 'update autis', 'delete autis',
        'create gpph', 'update gpph', 'delete gpph',
        'create wawancara', 'update wawancara', 'delete wawancara',
        'create role', 'update role', 'delete role',
        'create permission', 'update permission', 'delete permission',
        'create user', 'update user', 'delete user', 'update status user',
        'create kategori', 'update kategori', 'delete kategori',
        'create pemasukkan', 'update pemasukkan', 'delete pemasukkan',
        'create pengeluaran', 'update pengeluaran', 'delete pengeluaran',
        'create jadwal anak', 'update jadwal anak', 'delete jadwal anak',
        'update informasi',
        'show rekammedis',
        'create profile', 'update profile',
        'create observasi', 'update observasi', 'delete observasi',
        'create assessment', 'update assessment', 'delete assessment',
        'create kunjungan', 'update kunjungan', 'delete kunjungan',
    ];

    $count = 0;
    foreach ($permissions as $p) {
        if (!\Spatie\Permission\Models\Permission::where('name', $p)->exists()) {
            \Spatie\Permission\Models\Permission::create(['name' => $p, 'guard_name' => 'web']);
            $count++;
        }
    }

    $superAdmin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
    $superAdmin->givePermissionTo(\Spatie\Permission\Models\Permission::all());

    return "Berhasil menambahkan {$count} permissions baru dan melakukan sinkronisasi ke role super-admin. Silakan atur permission untuk role lain melalui menu Manajemen User -> Roles.";
});


Route::group(['middleware' => ['role:super-admin|admin|terapis|keuangan|psikolog']], function () {

    Route::resource('/roles', RoleController::class);
    Route::get('/manajemen-menu', [RoleController::class, 'manajemen_menu']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('/permissions', PermissionController::class);

    Route::resource('/users', UserController::class);
    Route::post('/users/anak', [UserController::class, 'store_anak'])->name('users.store-anak');
    Route::post('/users/terapis', [UserController::class, 'store_terapis'])->name('users.store-terapis');
    Route::post('/users/psikolog', [UserController::class, 'store_psikolog'])->name('users.store-psikolog');
    Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.update-status');

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
    Route::put('/q-pendengaran/update/{id}', [QuestionController::class, 'qpendengaran_update'])->name('qpendengaran.update');
    Route::delete('/q-pendengaran/{id}', [QuestionController::class, 'hapus_pendengaran'])->name('qpendengaran.destroy');
    Route::get('/q-umur', [QuestionController::class, 'umur'])->name('question.umur');
    Route::post('/q-umur/simpan', [QuestionController::class, 'umur_store'])->name('age.store');
    Route::put('/q-umur/update/{id}', [QuestionController::class, 'age_update'])->name('age.update');
    Route::delete('/q-umur/{id}', [QuestionController::class, 'hapus_umur'])->name('age.destroy');
    Route::get('/q-penglihatan', [QuestionController::class, 'q_penglihatan'])->name('question.penglihatan');
    Route::post('/q-penglihatan/simpan', [QuestionController::class, 'penglihatan_store'])->name('qpenglihatan.store');
    Route::put('/q-penglihatan/update/{id}', [QuestionController::class, 'qpenglihatan_update'])->name('qpenglihatan.update');
    Route::delete('/q-penglihatan/{id}', [QuestionController::class, 'penglihatan_destroy'])->name('qpenglihatan.destroy');
    Route::get('/q-perilaku', [QuestionController::class, 'q_perilaku'])->name('question.perilaku');
    Route::post('/q-perilaku/simpan', [QuestionController::class, 'perilaku_store'])->name('qperilaku.store');
    Route::put('/q-perilaku/update/{id}', [QuestionController::class, 'qperilaku_update'])->name('qperilaku.update');
    Route::delete('/q-perilaku/{id}', [QuestionController::class, 'perilaku_destroy'])->name('qperilaku.destroy');
    Route::get('/q-autis', [QuestionController::class, 'q_autis'])->name('question.autis');
    Route::post('/q-autis/simpan', [QuestionController::class, 'autis_store'])->name('qautis.store');
    Route::put('/q-autis/update/{id}', [QuestionController::class, 'qautis_update'])->name('qautis.update');
    Route::delete('/q-autis/{id}', [QuestionController::class, 'autis_destroy'])->name('qautis.destroy');
    Route::get('/q-gpph', [QuestionController::class, 'q_gpph'])->name('question.gpph');
    Route::post('/q-gpph/simpan', [QuestionController::class, 'gpph_store'])->name('qgpph.store');
    Route::put('/q-gpph/update/{id}', [QuestionController::class, 'qgpph_update'])->name('qgpph.update');
    Route::delete('/q-gpph/{id}', [QuestionController::class, 'gpph_destroy'])->name('qgpph.destroy');
    Route::get('/q-wawancara', [QuestionController::class, 'q_wawancara'])->name('question.wawancara');
    Route::post('/q-wawancara/simpan', [QuestionController::class, 'wawancara_store'])->name('qwawancara.store');
    Route::put('/q-wawancara/update/{id}', [QuestionController::class, 'qwawancara_update'])->name('qwawancara.update');
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
    Route::get('/pemasukkan/kwitansi/{id}', [KeuanganController::class, 'kwitansi_pdf'])->name('pemasukkan.kwitansi');
    Route::get('/pemasukkan/layanan', [KeuanganController::class, 'getLayananByAnak'])->name('pemasukkan.layanan');
    Route::get('/pemasukkan/log/{id}', [KeuanganController::class, 'getLogPemakaian'])->name('pemasukkan.log');

    Route::resource('/alat-ukur', AlatUkurController::class);

    Route::get('/kunjungan/{anak}/create', [KunjunganController::class, 'create'])->name('kunjungan.create.anak');
    Route::get('/terapis/pelatihan/{terapi}', [TerapisController::class, 'terapis_pelatihan'])->name('terapis.pelatihan');
    Route::post('/terapis/pelatihan', [TerapisController::class, 'pelatihan_store'])->name('pelatihans.store');
    Route::get('/terapis/sertifikat/{sertifikat}', [TerapisController::class, 'sertifikat_show'])->name('sertifikat.show');
    Route::resource('/kunjungan', KunjunganController::class);
    Route::get('/pencarian/proses', [PencarianController::class, 'proses']);
    Route::get('/get-terapis-by-jenis', [KunjunganController::class, 'getTerapisByJenis'])->name('get.terapis.by.jenis');
    Route::get('/data/{kunjungan}', [KunjunganController::class, 'show'])->name('kunjungan.detail');
    Route::get('/search-kunjungan', [KunjunganController::class, 'search_kunjungan'])->name('kunjungan.pencarian');
    Route::get('/data', [KunjunganController::class, 'riwayatAnak'])->name('kunjungan.data');
    Route::post('/pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
    Route::post('/fisioterapi', [FisioterapiController::class, 'store'])->name('fisioterapi.store');
    Route::put('/data/{kunjungan}/tambah-terapis', [KunjunganController::class, 'tambahTerapis'])->name('kunjungan.tambah-terapis');
    Route::put('/data/{kunjungan}/edit-status', [KunjunganController::class, 'updateStatus'])->name('kunjungan.update-status');
    Route::put('/data/{kunjungan}/edit-terapis', [KunjunganController::class, 'updateTerapis'])->name('kunjungan.update-terapis');

    Route::post('/ubah-status-anak', [AnakController::class, 'ubahStatus'])->name('anak.status');
    Route::post('/ubah-status-terapis', [TerapisController::class, 'ubahStatus'])->name('terapis.status');

    Route::get('/observasi/{anak}', [ObservasiController::class, 'show'])->name('observasi.show');
    Route::post('/observasi/mulai', [ObservasiController::class, 'observasi_mulai'])->name('observasi.mulai');
    Route::post('/observasi/atec', [ObservasiController::class, 'observasi_atec'])->name('observasi.atec');
    Route::post('/observasi/atec-digital', [ObservasiController::class, 'observasi_atec_digital'])->name('observasi.atec_digital');
    Route::post('/observasi/hpperilaku', [ObservasiController::class, 'observasi_hpperilaku'])->name('observasi.hpperilaku');
    Route::post('/observasi/hpsensorik', [ObservasiController::class, 'observasi_hpsensorik'])->name('observasi.hpsensorik');
    Route::post('/observasi-pendengaran/simpan', [ObservasiController::class, 'observasi_pendengaran'])->name('obpendengaran.store');
    Route::post('/observasi-penglihatan/simpan', [ObservasiController::class, 'observasi_penglihatan'])->name('observasi.penglihatan');
    Route::post('/observasi-perilaku/simpan', [ObservasiController::class, 'observasi_perilaku'])->name('observasi.perilaku');
    Route::post('/observasi-autis/simpan', [ObservasiController::class, 'observasi_autis'])->name('observasi.autis');
    Route::post('/observasi-gpph/simpan', [ObservasiController::class, 'observasi_gpph'])->name('observasi.gpph');
    Route::post('/observasi-kpsp/simpan', [ObservasiController::class, 'observasi_kpsp'])->name('observasi.kpsp');
    Route::post('/observasi-anthropometri/simpan', [ObservasiController::class, 'observasi_anthropometri'])->name('observasi.anthropometri');
    Route::post('/observasi-anthropometri/update/{id}', [ObservasiController::class, 'update_anthropometri'])->name('observasi.anthropometri.update');
    Route::delete('/observasi-anthropometri/{id}', [ObservasiController::class, 'hapus_anthropometri'])->name('observasi.anthropometri.destroy');
    Route::post('/observasi-wawancara/simpan', [ObservasiController::class, 'observasi_wawancara'])->name('observasi.wawancara');
    Route::post('/observasi/cetak', [ObservasiController::class, 'cetakObservasi'])->name('observasi.cetak');
    Route::patch('/observasi/hpperilaku/{id}', [ObservasiController::class, 'hpperilaku_update'])->name('hpperilaku.update');
    Route::patch('/observasi/hpsensorik/{id}', [ObservasiController::class, 'hpsensorik_update'])->name('hpsensorik.update');
    Route::get('/observasi/detail/{hasil}', [ObservasiController::class, 'detail'])->name('observasi.detail');
    Route::delete('/observasi/destroy_hasil/{id}', [ObservasiController::class, 'destroy_hasil'])->name('observasi.destroy_hasil');

    Route::post('/upload-foto/{id}', [AnakController::class, 'uploadfoto'])->name('upload.foto');
    Route::get('/delete-foto/{id}', [AnakController::class, 'deletefoto'])->name('delete.foto');
    Route::get('/delete-fototerapis/{id}', [TerapisController::class, 'deletefoto'])->name('delete.fototerapis');

    Route::get('/analisis-kinerja', [AnalisiskinerjaController::class, 'analisis_kinerja'])->name('analisis.kinerja');

    Route::get('/history-wawancara/{anak}', [AssessmentController::class, 'getWawancara'])->name('assessment.get_wawancara');
    Route::resource('/assessment', AssessmentController::class);
    Route::resource('/psikolog', PsikologController::class);

    Route::get('/products-services', [ShopeeAffiliateController::class, 'index'])->name('products.index');
});

Route::group(['middleware' => ['role:super-admin|admin|psikolog|anak|terapis']], function () {
    Route::get('/assessment/cetak/{assessment}', [AssessmentController::class, 'cetak'])->name('assessment.cetak');
});

Route::group(['middleware' => ['role:anak']], function () {
    Route::get('/app', [MobileNewController::class, 'index'])->name('app');
    Route::get('/app/profile', [MobileController::class, 'profile'])->name('mobile.profile');
    Route::get('/app/profile/edit', [MobileController::class, 'profile_edit'])->name('mobile.editprofile');
    Route::patch('/app/profile/{anak}', [MobileController::class, 'profile_update'])->name('mobile.updateprofile');
    Route::get('/app/change-password', [MobileController::class, 'ubah_password'])->name('mobile.ubahpassword');
    Route::patch('/app/change-password/{user}', [MobileController::class, 'update_password'])->name('mobile.updatepassword');
    Route::get('/app/kunjungan', [MobileController::class, 'kunjungan'])->name('mobile.kunjungan');
    Route::get('/app/kunjungan/{id}', [MobileController::class, 'kunjungan_detail'])->name('kunjunganmobile.detail');
    Route::get('/app/paket/{id}', [MobileController::class, 'tarif_detail'])->name('tarifmobile.detail');
    Route::get('/app/payment', [MobileController::class, 'payment'])->name('mobile.payment');
    Route::get('/app/result', [MobileController::class, 'result'])->name('mobile.result');
    Route::get('/invoice/{id}/download', [MobileController::class, 'download_invoice'])->name('invoice.download');
    Route::get('/app/laporan-psikolog/{id}', [MobileNewController::class, 'cetakAssessment'])->name('mobile.assessment.cetak');
    Route::get('/app/laporan-observasi/{tanggal}', [MobileNewController::class, 'cetakObservasi'])->name('mobile.observasi.cetak');
});
