<?php

use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\Pegawai\PegawaiAlamatController;
use App\Http\Controllers\Pegawai\PegawaiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\HariLiburController;
use App\Http\Controllers\JabatanTukinController;
use App\Http\Controllers\JabatanUnitKerjaController;
use App\Http\Controllers\LdapController;
use App\Http\Controllers\Pegawai\AnakController;
use App\Http\Controllers\Pegawai\PegawaiDiklatController;
use App\Http\Controllers\Pegawai\pegawaiJabatanController;
use App\Http\Controllers\Pegawai\PegawaiRiwayatThpController;
use App\Http\Controllers\Pegawai\PegawaiTmtGajiController;
use App\Http\Controllers\Pegawai\PenghargaanController;
use App\Http\Controllers\Pegawai\RiwayatJabatanController;
use App\Http\Controllers\Pegawai\RiwayatPendidikanController;
use App\Http\Controllers\Pegawai\SuamiIstriController;
use App\Http\Controllers\Presensi\PreDinasLuarController;
use App\Http\Controllers\Presensi\PreIjinController;
use App\Http\Controllers\Presensi\PresensiPegawaiController;
use App\Http\Controllers\Presensi\PreJamKerjaController;
use App\Http\Controllers\Presensi\PreTakTercatatController;
use App\Http\Controllers\Presensi\PreTubelController;
use App\Http\Controllers\PropinsiController;
use Illuminate\Support\Facades\Route;

//indrawan
use App\Http\Controllers\UangMakanController;
use App\Http\Controllers\StatusPegawaiController;
use App\Http\Controllers\ThpController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\TukinController;
use App\Http\Controllers\GradeTukinController;
use App\Http\Controllers\TunjanganBerasController;
use App\Http\Controllers\AturanThrGajiplusController;
use App\Http\Controllers\PegawaiRiwayatGolonganController;
use App\Http\Controllers\PegawaiBpjsLainnyaController;
use App\Http\Controllers\PengajuanPMKController;
use App\Http\Controllers\PegawaiTambahanMkController;
use App\Http\Controllers\PengajuanTambahanBpjsController;
use App\Http\Controllers\PegawaiTambahanBpjsController;
use App\Http\Controllers\PegawaiRiwayatUmakController;
use App\Http\Controllers\PegawaiRekeningController;
use App\Http\Controllers\PegawaiHirarkiController;

use App\Http\Controllers\PegawaiRiwayatThrController;
use App\Http\Controllers\PegawaiRiwayatGajiplusController;
use App\Http\Controllers\PegawaiRiwayatJabatanController;
use App\Http\Controllers\RiwayatGajiplusController;
use App\Http\Controllers\RiwayatThrController;
use App\Http\Controllers\RuangRapatController;
use App\Http\Controllers\PesanRuangRapatController;


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
    $xx = \Illuminate\Support\Facades\DB::connection()->getPdo();
    dd($xx);
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

    Route::post('/presensi/pre-ijin/konfirmasi', [PreIjinController::class, 'konfirmasi'])->name('pre-ijin.konfirmasi');
    Route::get('/presensi/pre-ijin/persetujuan', [PreIjinController::class, 'persetujuan'])->name('pre-ijin.persetujuan');

    Route::post('/presensi/pre-tak-tercatat/konfirmasi', [PreTakTercatatController::class, 'konfirmasi'])->name('pre-tak-tercatat.konfirmasi');
    Route::get('/presensi/pre-tak-tercatat/persetujuan', [PreTakTercatatController::class, 'persetujuan'])->name('pre-tak-tercatat.persetujuan');

    Route::post('/presensi/pre-dinas-luar/konfirmasi', [PreDinasLuarController::class, 'konfirmasi'])->name('pre-dinas-luar.konfirmasi');
    Route::get('/presensi/pre-dinas-luar/persetujuan', [PreDinasLuarController::class, 'persetujuan'])->name('pre-dinas-luar.persetujuan');

    //indrawan
    Route::post('/pegawai-riwayat-golongan/datatable', [PegawaiRiwayatGolonganController::class, 'datatable'])->name('pegawai-riwayat-golongan.datatable');
    Route::resource('/pegawai-riwayat-golongan', PegawaiRiwayatGolonganController::class);

    Route::post('/grade-tukin', [GradeTukinController::class, 'datatable'])->name('grade-tukin.datatable');
    Route::resource('/grade-tukin', GradeTukinController::class)->only('index');

    Route::post('/riwayat-thr', [RiwayatThrController::class, 'datatable'])->name('riwayat-thr.datatable');
    Route::resource('/riwayat-thr', RiwayatThrController::class)->only('index');

    Route::post('/riwayat-gajiplus', [RiwayatGajiplusController::class, 'datatable'])->name('riwayat-gajiplus.datatable');
    Route::resource('/riwayat-gajiplus', RiwayatGajiplusController::class)->only('index');

    //indrawan
    // Route::post('/pegawai-bpjs-lainnya/datatable', [PegawaiBpjsLainnyaController::class, 'datatable'])->name('pegawai-bpjs-lainnya.datatable');
    // Route::resource('/pegawai-bpjs-lainnya', PegawaiBpjsLainnyaController::class);

    Route::post('/pesan-ruang-rapat/datatable', [PesanRuangRapatController::class, 'datatable'])->name('pesan-ruang-rapat.datatable');
    Route::resource('/pesan-ruang-rapat', PesanRuangRapatController::class)->except('edit', 'update');

    Route::post('/pengajuan-pmk/datatable', [PengajuanPMKController::class, 'datatable'])->name('pengajuan-pmk.datatable');
    Route::resource('/pengajuan-pmk', PengajuanPMKController::class)->except('edit', 'update');

    Route::post('/pegawai-tambahan-mk/datatable', [PegawaiTambahanMkController::class, 'datatable'])->name('pegawai-tambahan-mk.datatable');
    Route::resource('/pegawai-tambahan-mk', PegawaiTambahanMkController::class)->except('create', 'store');

    Route::post('/pengajuan-tambahan-bpjs/datatable', [PengajuanTambahanBpjsController::class, 'datatable'])->name('pengajuan-tambahan-bpjs.datatable');
    Route::resource('/pengajuan-tambahan-bpjs', PengajuanTambahanBpjsController::class)->except('edit', 'update');

    Route::post('/pegawai-tambahan-bpjs/datatable', [PegawaiTambahanBpjsController::class, 'datatable'])->name('pegawai-tambahan-bpjs.datatable');
    Route::resource('/pegawai-tambahan-bpjs', PegawaiTambahanBpjsController::class)->except('create', 'store');
    //

    Route::prefix('presensi')->group(function () {

        Route::resource('/pre-tubel', PreTubelController::class);
        Route::post('/pre-tubel/datatable', [PreTubelController::class, 'datatable'])->name('pre-tubel.datatable');

        Route::resource('/pre-dinas-luar', PreDinasLuarController::class);
        Route::post('/pre-dinas-luar/datatable', [PreDinasLuarController::class, 'datatable'])->name('pre-dinas-luar.datatable');
        Route::post('/pre-dinas-luar/datatablepersetujuan', [PreDinasLuarController::class, 'datatablepersetujuan'])->name('pre-dinas-luar.datatablepersetujuan');

        Route::resource('/pre-tak-tercatat', PreTakTercatatController::class);
        Route::post('/pre-tak-tercatat/datatable', [PreTakTercatatController::class, 'datatable'])->name('pre-tak-tercatat.datatable');
        Route::post('/pre-tak-tercatat/datatablepersetujuan', [PreTakTercatatController::class, 'datatablepersetujuan'])->name('pre-tak-tercatat.datatablepersetujuan');

        Route::resource('/pre-tubel', PreTubelController::class);
        Route::post('/pre-tubel/datatable', [PreTubelController::class, 'datatable'])->name('pre-tubel.datatable');

        Route::resource('/pre-ijin', PreIjinController::class);
        Route::post('/pre-ijin/datatable', [PreIjinController::class, 'datatable'])->name('pre-ijin.datatable');
        Route::post('/pre-ijin/datatablepersetujuan', [PreIjinController::class, 'datatablepersetujuan'])->name('pre-ijin.datatablepersetujuan');

        //Pengaturan jam kerja
        Route::resource('/pre-jam-kerja', PreJamKerjaController::class);
        Route::post('/pre-jam-kerja/datatable', [PreJamKerjaController::class, 'datatable'])->name('pre-jam-kerja.datatable');

        Route::resource('/hari-besar', HariLiburController::class);
        Route::post('/hari-besar/datatable', [HariLiburController::class, 'datatable'])->name('hari-besar.datatable');

        //Presensi
        Route::resource('/presensiku', PresensiPegawaiController::class);
        Route::post('/presensiku/datatable', [PresensiPegawaiController::class, 'datatable'])->name('presensiku.datatable');
        Route::post('/presensiku/getdatapresensi', [PresensiPegawaiController::class, 'getdatapresensi'])->name('presensiku.getdatapresensi');
        Route::get('/exportdatapresensi', [PresensiPegawaiController::class, 'exportPresensi'])->name('exportdatapresensi');

    });

    Route::post('/presensi-pegawai/getanggotatim', [PresensiPegawaiController::class, 'getAnggotaTim'])->name('presensi-pegawai.getanggotatim');

    Route::get('/presensi-pegawai/',  [PresensiPegawaiController::class, 'dataPresensiPegawai'])->name('presensi-pegawai');
    Route::get('/exportpresensipegawai', [PresensiPegawaiController::class, 'ExportPresensiPegawai'])->name('exportpresensipegawai');

    Route::get('/presensi-pegawai/datatablepresensi', [PresensiPegawaiController::class, 'datatablePresensi'])->name('presensi-pegawai.datatablepresensi');
    Route::post('/presensi-pegawai/getdatapresensipegawai', [PresensiPegawaiController::class, 'getdataPresensiPegawai'])->name('presensi-pegawai.getdatapresensipegawai');
    Route::get('/presensi-pegawai/runmanual', [PresensiPegawaiController::class, 'manualcronjob'])->name('presensi-pegawai.runmanual');

    //uang makan
    Route::prefix('kalkulasi')->group(function () {
        //indrawan
        Route::get('/export-to-excel/umak/{bulan}/{tahun}', [PegawaiRiwayatUmakController::class, 'exportToExcel'])->name('pegawai-riwayat-umak.export-excel-umak');
        Route::get('/export-to-excel/umak/{bulan}/{tahun}/{unitKerjaId}', [PegawaiRiwayatUmakController::class, 'exportToExcelDua'])->name('pegawai-riwayat-umak.export-excel-umak-dua');
        Route::post('/pegawai-riwayat-umak/datatable', [PegawaiRiwayatUmakController::class, 'datatable'])->name('pegawai-riwayat-umak.datatable');
        Route::post('/pegawai-riwayat-umak/kalkulasi-umak', [PegawaiRiwayatUmakController::class, 'kalkulasiUmak'])->name('pegawai-riwayat-umak.kalkulasi-umak');
        Route::resource('/pegawai-riwayat-umak', PegawaiRiwayatUmakController::class)->only(['index']);

        //thr
        Route::get('/export-to-excel/thr/{tahun}', [PegawaiRiwayatThrController::class, 'exportToExcel'])->name('pegawai-riwayat-thr.export-excel-thr');
        Route::get('/export-to-excel/thr/{tahun}/{unitKerjaId}', [PegawaiRiwayatThrController::class, 'exportToExcelDua'])->name('pegawai-riwayat-thr.export-excel-thr-dua');
        Route::post('/pegawai-riwayat-thr/datatable', [PegawaiRiwayatThrController::class, 'datatable'])->name('pegawai-riwayat-thr.datatable');
        Route::post('/pegawai-riwayat-thr/kalkulasi-thr', [PegawaiRiwayatThrController::class, 'kalkulasiThr'])->name('pegawai-riwayat-thr.kalkulasi-thr');
        Route::resource('/pegawai-riwayat-thr', PegawaiRiwayatThrController::class)->only(['index']);

        //gaji 13
        Route::get('/export-to-excel/gajiplus/{tahun}', [PegawaiRiwayatGajiplusController::class, 'exportToExcel'])->name('pegawai-riwayat-gajiplus.export-excel-gajiplus');
        Route::get('/export-to-excel/gajiplus/{tahun}/{unitKerjaId}', [PegawaiRiwayatGajiplusController::class, 'exportToExcelDua'])->name('pegawai-riwayat-gajiplus.export-excel-gajiplus-dua');
        Route::post('/pegawai-riwayat-gajiplus/datatable', [PegawaiRiwayatGajiplusController::class, 'datatable'])->name('pegawai-riwayat-gajiplus.datatable');
        Route::post('/pegawai-riwayat-gajiplus/kalkulasi-gajiplus', [PegawaiRiwayatGajiplusController::class, 'kalkulasiGajiplus'])->name('pegawai-riwayat-gajiplus.kalkulasi-gajiplus');
        Route::resource('/pegawai-riwayat-gajiplus', PegawaiRiwayatGajiplusController::class)->only(['index']);
    });

    //master data
    Route::prefix('master')->group(function () {
        //indrawan
        Route::post('/uang-makan/datatable', [UangMakanController::class, 'datatable'])->name('uang-makan.datatable');
        Route::resource('/uang-makan', UangMakanController::class);

        Route::post('/unit-kerja/datatable', [UnitKerjaController::class, 'datatable'])->name('unit-kerja.datatable');
        Route::resource('/unit-kerja', UnitKerjaController::class);

        Route::post('/status-pegawai/datatable', [StatusPegawaiController::class, 'datatable'])->name('status-pegawai.datatable');
        Route::resource('/status-pegawai', StatusPegawaiController::class);

        Route::post('/tukin/datatable', [TukinController::class, 'datatable'])->name('tukin.datatable');
        Route::resource('/tukin', TukinController::class);

        Route::post('/tunjangan-beras/datatable', [TunjanganBerasController::class, 'datatable'])->name('tunjangan-beras.datatable');
        Route::resource('/tunjangan-beras', TunjanganBerasController::class);

        Route::post('/aturan-thr-gajiplus/datatable', [AturanThrGajiplusController::class, 'datatable'])->name('aturan-thr-gajiplus.datatable');
        Route::resource('/aturan-thr-gajiplus', AturanThrGajiplusController::class);

        Route::post('/pegawai-rekening/datatable', [PegawaiRekeningController::class, 'datatable'])->name('pegawai-rekening.datatable');
        Route::resource('/pegawai-rekening', PegawaiRekeningController::class);

        Route::post('/pegawai-hirarki/datatable', [PegawaiHirarkiController::class, 'datatable'])->name('pegawai-hirarki.datatable');
        Route::resource('/pegawai-hirarki', PegawaiHirarkiController::class)->only('index');

        Route::post('/ruang-rapat/datatable', [RuangRapatController::class, 'datatable'])->name('ruang-rapat.datatable');
        Route::resource('/ruang-rapat', RuangRapatController::class);
        //
    });

    Route::prefix('pegawai')->group(function () {

        Route::get('/a-riwayat-jabatan/{pegawai_id}', [PegawaiRiwayatJabatanController::class, 'create'])->name('a-riwayat-jabatan.create');
        Route::get('/a-riwayat-jabatan/{pegawai_riwayat_jabatan_id}/edit', [PegawaiRiwayatJabatanController::class, 'edit'])->name('a-riwayat-jabatan.edit');
        Route::post('/a-riwayat-jabatan/get-jabatan-unit-kerja', [PegawaiRiwayatJabatanController::class, 'get_jabatan_unit_kerja'])->name('a-riwayat-jabatan.get-jabatan-unit-kerja');
        Route::post('/a-riwayat-jabatan/store', [PegawaiRiwayatJabatanController::class, 'store'])->name('a-riwayat-jabatan.store');
        Route::post('/a-riwayat-jabatan/update', [PegawaiRiwayatJabatanController::class, 'update'])->name('a-riwayat-jabatan.update');


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
        Route::get('/anak/verifikasi/{id}', [AnakController::class, 'verifikasi_sdmoh'])->name('anak.verifikasi-sdmoh');


        // pasangan

        Route::get('/pasangan/create/{pegawai_id}', [SuamiIstriController::class, 'create'])->name('pasangan.create');
        Route::post('/pasangan/datatable', [SuamiIstriController::class, 'datatable'])->name('pasangan.datatable');
        Route::resource('/pasangan', SuamiIstriController::class)->except(['create', 'index']);
        Route::get('/pasangan/verifikasi/{id}', [SuamiIstriController::class, 'verifikasi_sdmoh'])->name('pasangan.verifikasi-sdmoh');

        // Pendidikan

        Route::get('/pendidikan/create/{pegawai_id}', [RiwayatPendidikanController::class, 'create'])->name('pendidikan.create');
        Route::post('/pendidikan/datatable', [RiwayatPendidikanController::class, 'datatable'])->name('pendidikan.datatable');
        Route::resource('/pendidikan', RiwayatPendidikanController::class)->except(['create', 'index']);
        Route::get('/pendidikan/verifikasi/{id}', [RiwayatPendidikanController::class, 'verifikasi_sdmoh'])->name('pendidikan.verifikasi-sdmoh');

        // Alamat

        Route::post('/alamat-by-pegawai', [PegawaiAlamatController::class, 'getAlamatByPegawaiId'])->name('alamat.get-data-by-pegawai-id');
        Route::resource('/alamat', PegawaiAlamatController::class)->only(['store']);
        Route::get('/alamat/verifikasi/{id}', [PegawaiAlamatController::class, 'verifikasi_sdmoh'])->name('alamat.verifikasi-sdmoh');

        // Diklat
        Route::post('/diklat/datatable', [PegawaiDiklatController::class, 'datatable'])->name('diklat.datatable');
        Route::get('/diklat/create/{pegawai_id}', [PegawaiDiklatController::class, 'create'])->name('diklat.create');
        Route::resource('/diklat', PegawaiDiklatController::class)->except('create');
        Route::get('/diklat/verifikasi/{id}', [PegawaiDiklatController::class, 'verifikasi_sdmoh'])->name('diklat.verifikasi-sdmoh');


        // TMT Gaji
        Route::post('/tmt-gaji/tmt-gaji-by-id', [PegawaiTmtGajiController::class, 'getTmtGajiById'])->name('tmt-gaji.get-tmt-gaji-by-id');
        Route::post('/tmt-gaji/datatable', [PegawaiTmtGajiController::class, 'datatable'])->name('tmt-gaji.datatable');
        Route::resource('/tmt-gaji', PegawaiTmtGajiController::class)->only(['store', 'destroy']);

        // Riwayat Jabatan
        Route::get('/riwayat-jabatan', [RiwayatJabatanController::class, 'index'])->name('riwayat-jabatan.index');
        Route::post('/riwayat-jabatan/datatable', [RiwayatJabatanController::class, 'datatable'])->name('riwayat-jabatan.datatable');
        Route::get('/riwayat-jabatan/{id}/create', [RiwayatJabatanController::class, 'create'])->name('riwayat-jabatan.create');
        Route::post('/riwayat-jabatan/{id}/store', [RiwayatJabatanController::class, 'store'])->name('riwayat-jabatan.store');
        Route::get('/riwayat-jabatan/show/{id}', [RiwayatJabatanController::class, 'show'])->name('riwayat-jabatan.show');
        Route::get('/riwayat-jabatan/get-fungsional-umum', [RiwayatJabatanController::class, 'get_fungsional_umum'])->name('riwayat-jabatan.get_fungsional_umum');
        Route::get('/riwayat-jabatan/get-fungsional-tertentu', [RiwayatJabatanController::class, 'get_fungsional_tertentu'])->name('riwayat-jabatan.get_fungsional_tertentu');
        Route::get('/riwayat-jabatan/get-eselon-satu', [RiwayatJabatanController::class, 'get_eselon_satu'])->name('riwayat-jabatan.get_eselon_satu');
        Route::get('/riwayat-jabatan/get-eselon-dua', [RiwayatJabatanController::class, 'get_eselon_dua'])->name('riwayat-jabatan.get_eselon_dua');

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
        ])->parameters(['' => 'id'])->only(['index', 'show', 'edit', 'update']);



        //Pengajuan Peninjauan Masa Kerja
        //Route::resource('/pengajuan-mk', PegawaiPengajuanMk::class);
        //Route::post('/pengajuan-mk/datatable', [PegawaiPengajuanMk::class, 'datatable'])->name('pengajuan-mk.datatable');

    });

    Route::get('/esselon2/pegawai', [PegawaiController::class, 'index_esselon'])->name('pegawai.index-esselon');
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

        Route::get('/saldo_cuti_pegawai', [CutiController::class, 'saldo_cuti_pegawai'])->name('cuti.saldo-cuti-pegawai');
        Route::post('/datatable_saldo_cuti', [CutiController::class, 'datatable_saldo_cuti'])->name('cuti.datatable-saldo-cuti-pegawai');
        Route::post('/update_all_saldo_cuti', [CutiController::class, 'update_all_saldo_cuti'])->name('cuti.update-all-saldo-cuti');
        Route::get('/pengajuan_masuk', [CutiController::class, 'pengajuan_masuk'])->name('cuti.pengajuan-masuk');
        Route::get('/pengajuan_masuk/{id}', [CutiController::class, 'detail_pengajuan_masuk'])->name('cuti.detail-pengajuan-masuk');
        Route::get('/pengajuan_masuk_sdmoh', [CutiController::class, 'pengajuan_masuk_sdmoh'])->name('cuti.pengajuan-masuk-sdmoh');
        Route::post('/datatable_pengajuan_masuk', [CutiController::class, 'datatable_pengajuan_masuk'])->name('cuti.datatable-pengajuan-masuk');
        Route::get('/pengajuan_masuk_sdmoh/{id}', [CutiController::class, 'detail_pengajuan_masuk_sdmoh'])->name('cuti.detail-pengajuan-masuk-sdmoh');
        Route::post('/datatable_pengajuan_masuk_sdmoh', [CutiController::class, 'datatable_pengajuan_masuk_sdmoh'])->name('cuti.datatable-pengajuan-masuk-sdmoh');
        Route::post('/acc_atasan_langsung', [CutiController::class, 'acc_atasan_langsung'])->name('cuti.acc-atasan-langsung');
        Route::post('/acc_kabiro_sdmoh', [CutiController::class, 'acc_kabiro_sdmoh'])->name('cuti.acc-kabiro-sdmoh');
    });
    Route::prefix('thp')->group(function () {
        Route::get('/semua_thp', [ThpController::class, 'index'])->name('thp.semua-thp');
        Route::post('/datatable', [ThpController::class, 'datatable'])->name('thp.datatable');
    });
    Route::prefix('penghasilan')->group(function () {
        Route::post('/tukin/generate', [PegawaiRiwayatThpController::class, 'generate_tukin'])->name('penghasilan.generate-tukin');
        Route::get('/', [PegawaiRiwayatThpController::class, 'index'])->name('penghasilan.index');
        Route::get('/show/gaji/{id}', [PegawaiRiwayatThpController::class, 'gaji_detail'])->name('penghasilan.gaji-detail');
        Route::get('/show/tukin/{id}', [PegawaiRiwayatThpController::class, 'tukin_detail'])->name('penghasilan.tukin-detail');
        Route::get('/show/umak/{id}', [PegawaiRiwayatThpController::class, 'umak_detail'])->name('penghasilan.umak-detail');
        Route::get('/show/{id}', [PegawaiRiwayatThpController::class, 'show'])->name('penghasilan.show');
        Route::post('/datatable', [PegawaiRiwayatThpController::class, 'datatable'])->name('penghasilan.datatable');
        Route::post('/datatable_show', [PegawaiRiwayatThpController::class, 'datatable_show'])->name('penghasilan.datatable_show');
    });
    Route::get('/esselon2/penghasilan', [PegawaiRiwayatThpController::class, 'index_esselon'])->name('penghasilan.index-esselon');
    Route::post('/esselon2/penghasilan/datatable_esselon', [PegawaiRiwayatThpController::class, 'datatable_esselon'])->name('penghasilan.datatable-esselon');
    Route::post('/esselon2/penghasilan/datatable_show_esselon', [PegawaiRiwayatThpController::class, 'datatable_show_esselon'])->name('penghasilan.datatable-show-esselon');
    Route::get('/esselon2/penghasilan/show/{id}', [PegawaiRiwayatThpController::class, 'show_esselon'])->name('penghasilan.show-esselon');
    Route::get('/esselon2/penghasilan/show/gaji/{id}', [PegawaiRiwayatThpController::class, 'gaji_detail_esselon'])->name('penghasilan.gaji-detail-esselon');
    Route::get('/esselon2/penghasilan/show/tukin/{id}', [PegawaiRiwayatThpController::class, 'tukin_detail_esselon'])->name('penghasilan.tukin-detail-esselon');
    Route::get('/esselon2/penghasilan/show/umak/{id}', [PegawaiRiwayatThpController::class, 'umak_detail_esselon'])->name('penghasilan.umak-detail-esselon');
});


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [LdapController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LdapController::class, 'login'])->name('login.check');
});
