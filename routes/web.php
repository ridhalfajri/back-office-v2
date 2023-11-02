<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\Pegawai\PegawaiAlamatController;
use App\Http\Controllers\Pegawai\PegawaiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanTukinController;
use App\Http\Controllers\JabatanUnitKerjaController;
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
Route::get('/', function () {
    return view('try');
});


Route::get('/gaji/datatable', [GajiController::class, 'datatable'])->name('gaji.datatable');
Route::resource('/gaji', GajiController::class);

Route::get('/jabatan-tukin/datatable', [JabatanTukinController::class, 'datatable'])->name('jabatan-tukin.datatable');
Route::resource('/jabatan-tukin', JabatanTukinController::class);

Route::get('/jabatan-unit-kerja/datatable', [JabatanUnitKerjaController::class, 'datatable'])->name('jabatan-unit-kerja.datatable');
Route::resource('/jabatan-unit-kerja', JabatanUnitKerjaController::class);


Route::prefix('pegawai')->group(function () {
    Route::post('/datatable', [PegawaiController::class, 'datatable'])->name('pegawai.datatable');
    Route::post('/alamat-by-id', [PegawaiAlamatController::class, 'getAlamatById'])->name('alamat.get-data-by-id');
    Route::resource('/alamat', PegawaiAlamatController::class)->only(['store']);
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
    Route::post('propinsi', [PropinsiController::class, 'getPropinsi'])->name('propinsi.data');
    Route::post('kota', [KotaController::class, 'getKota'])->name('kota.data');
    Route::post('kecamatan', [KecamatanController::class, 'getKecamatan'])->name('kecamatan.data');
    Route::post('desa', [DesaController::class, 'getDesa'])->name('desa.data');
});
