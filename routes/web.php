<?php

use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\Pegawai\PegawaiAlamatController;
use App\Http\Controllers\Pegawai\PegawaiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanTukinController;
use App\Http\Controllers\JabatanUnitKerjaController;
use App\Http\Controllers\LdapController;
use App\Http\Controllers\Pegawai\AnakController;
use App\Http\Controllers\Pegawai\PegawaiDiklatController;
use App\Http\Controllers\Pegawai\PegawaiTmtGajiController;
use App\Http\Controllers\Pegawai\PenghargaanController;
use App\Http\Controllers\Pegawai\RiwayatPendidikanController;
use App\Http\Controllers\Pegawai\SuamiIstriController;
use App\Http\Controllers\PropinsiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/logout', [LdapController::class, 'logout'])->name('logout.ldap');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gaji Pegawai
    Route::get('/gaji/get-golongan', [GajiController::class, 'getGolongan'])->name('gaji.get-golongan');
    Route::post('/gaji/datatable', [GajiController::class, 'datatable'])->name('gaji.datatable');
    Route::post('/gaji/get-gaji', [GajiController::class, 'get_gaji'])->name('gaji.get-gaji');
    Route::resource('/gaji', GajiController::class);

    Route::post('/jabatan-tukin/datatable', [JabatanTukinController::class, 'datatable'])->name('jabatan-tukin.datatable');
    Route::post('/jabatan-tukin/getjabatan', [JabatanTukinController::class, 'getjabatan'])->name('jabatan-tukin.getjabatan');
    Route::post('/jabatan-tukin/gettukin', [JabatanTukinController::class, 'gettukin'])->name('jabatan-tukin.gettukin');
    Route::resource('/jabatan-tukin', JabatanTukinController::class);

    Route::post('/jabatan-unit-kerja/datatable', [JabatanUnitKerjaController::class, 'datatable'])->name('jabatan-unit-kerja.datatable');
    Route::resource('/jabatan-unit-kerja', JabatanUnitKerjaController::class);


    Route::prefix('pegawai')->group(function () {

        // Penghargaan

        Route::post('/penghargaan/sk-penghargaan', [PenghargaanController::class, 'sk_penghargaan'])->name('penghargaan.sk-penghargaan');
        Route::get('/penghargaan/create/{pegawai_id}', [PenghargaanController::class, 'create'])->name('penghargaan.create');
        Route::post('/penghargaan/datatable', [PenghargaanController::class, 'datatable'])->name('penghargaan.datatable');
        Route::resource('/penghargaan', PenghargaanController::class)->except(['create', 'index']);

        // Pasangan

        Route::post('/anak/anak-by-id', [AnakController::class, 'getanakById'])->name('anak.get-anak-by-id');
        Route::get('/anak/create/{pegawai_id}', [AnakController::class, 'create'])->name('anak.create');
        Route::post('/anak/datatable', [AnakController::class, 'datatable'])->name('anak.datatable');
        Route::resource('/anak', AnakController::class)->except(['create', 'index']);

        // pasangan

        Route::get('/pasangan/create/{pegawai_id}', [SuamiIstriController::class, 'create'])->name('pasangan.create');
        Route::post('/pasangan/datatable', [SuamiIstriController::class, 'datatable'])->name('pasangan.datatable');
        Route::resource('/pasangan', SuamiIstriController::class)->except(['create', 'index']);
        // Pendidikan

        Route::get('/pendidikan/create/{pegawai_id}', [RiwayatPendidikanController::class, 'create'])->name('pendidikan.create');
        Route::post('/pendidikan/datatable', [RiwayatPendidikanController::class, 'datatable'])->name('pendidikan.datatable');
        Route::resource('/pendidikan', RiwayatPendidikanController::class)->except(['create', 'index']);

        // Alamat

        Route::post('/alamat-by-pegawai', [PegawaiAlamatController::class, 'getAlamatByPegawaiId'])->name('alamat.get-data-by-pegawai-id');
        Route::resource('/alamat', PegawaiAlamatController::class)->only(['store']);

        // Diklat
        Route::post('/diklat/datatable', [PegawaiDiklatController::class, 'datatable'])->name('diklat.datatable');
        Route::get('/diklat/create/{pegawai_id}', [PegawaiDiklatController::class, 'create'])->name('diklat.create');
        Route::resource('/diklat', PegawaiDiklatController::class)->except(['create', 'index']);

        // TMT Gaji
        Route::post('/tmt-gaji/tmt-gaji-by-id', [PegawaiTmtGajiController::class, 'getTmtGajiById'])->name('tmt-gaji.get-tmt-gaji-by-id');
        Route::post('/tmt-gaji/datatable', [PegawaiTmtGajiController::class, 'datatable'])->name('tmt-gaji.datatable');
        Route::resource('/tmt-gaji', PegawaiTmtGajiController::class)->only(['store', 'destroy']);

        // Pegawai
        Route::post('/datatable', [PegawaiController::class, 'datatable'])->name('pegawai.datatable');
        Route::resource('/', PegawaiController::class, [
            'names' => [
                'index' => 'pegawai.index',
                'store' => 'pegawai.store',
                'edit' => 'pegawai.edit',
                'show' => 'pegawai.show',
                'update' => 'pegawai.update',
                'destroy' => 'pegawai.destroy',
            ]
        ])->parameters(['' => 'id'])->only(['index', 'show']);
    });
    Route::prefix('data')->group(function () {
        Route::post('/penghargaan/get-penghargaan', [PenghargaanController::class, 'get_penghargaan'])->name('gaji.get-penghargaan');
        Route::post('propinsi', [PropinsiController::class, 'getPropinsi'])->name('propinsi.data');
        Route::post('kota', [KotaController::class, 'getKota'])->name('kota.data');
        Route::post('kecamatan', [KecamatanController::class, 'getKecamatan'])->name('kecamatan.data');
        Route::post('desa', [DesaController::class, 'getDesa'])->name('desa.data');
    });

    Route::prefix('cuti')->group(function () {
        Route::get('/pengajuan_cuti', [CutiController::class, 'pengajuan_cuti'])->name('cuti.pengajuan-cuti');
        Route::get('/pengajuan_cuti/{id}/edit', [CutiController::class, 'pengajuan_cuti_edit'])->name('cuti.pengajuan-cuti-edit');
        Route::get('/pengajuan_cuti/{id}', [CutiController::class, 'show'])->name('cuti.show-cuti');
        Route::put('/pengajuan_cuti/{id}', [CutiController::class, 'update_cuti'])->name('cuti.update-cuti');
        Route::post('/pengajuan_cuti', [CutiController::class, 'store_cuti'])->name('cuti.store-cuti');
        Route::delete('/pengajuan_cuti/{id}', [CutiController::class, 'destroy'])->name('cuti.destroy-cuti');
        Route::get('/saldo_cuti', [CutiController::class, 'saldo_cuti'])->name('cuti.saldo-cuti');
        Route::post('/cek_hari_libur', [CutiController::class, 'cek_hari_libur'])->name('cuti.cek_hari_libur');
        Route::get('/riwayat_cuti', [CutiController::class, 'riwayat_cuti'])->name('cuti.riwayat-cuti');
        Route::post('/datatable_riwayat_cuti', [CutiController::class, 'datatable_riwayat_cuti'])->name('cuti.datatable-riwayat-cuti');

        Route::get('/pengajuan_masuk', [CutiController::class, 'pengajuan_masuk'])->name('cuti.pengajuan-masuk');
        Route::get('/pengajuan_masuk/{id}', [CutiController::class, 'detail_pengajuan_masuk'])->name('cuti.detail-pengajuan-masuk');
        Route::get('/pengajuan_masuk_sdmoh', [CutiController::class, 'pengajuan_masuk_sdmoh'])->name('cuti.pengajuan-masuk-sdmoh');
        Route::post('/datatable_pengajuan_masuk', [CutiController::class, 'datatable_pengajuan_masuk'])->name('cuti.datatable-pengajuan-masuk');
        Route::get('/pengajuan_masuk_sdmoh/{id}', [CutiController::class, 'detail_pengajuan_masuk_sdmoh'])->name('cuti.detail-pengajuan-masuk-sdmoh');
        Route::post('/datatable_pengajuan_masuk_sdmoh', [CutiController::class, 'datatable_pengajuan_masuk_sdmoh'])->name('cuti.datatable-pengajuan-masuk-sdmoh');
        Route::post('/acc_atasan_langsung', [CutiController::class, 'acc_atasan_langsung'])->name('cuti.acc-atasan-langsung');
        Route::post('/acc_kabiro_sdmoh', [CutiController::class, 'acc_kabiro_sdmoh'])->name('cuti.acc-kabiro-sdmoh');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LdapController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LdapController::class, 'login'])->name('login.check');
});
