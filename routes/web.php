<?php

use App\Http\Controllers\Pegawai\PegawaiAlamatController;
use App\Http\Controllers\Pegawai\PegawaiController;
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
Route::prefix('pegawai')->group(function () {
    Route::post('/datatable', [PegawaiController::class, 'datatable'])->name('pegawai.datatable');
    Route::resource('/alamat', PegawaiAlamatController::class);
    Route::resource('/', PegawaiController::class, [
        'names' => [
            'index' => 'pegawai.index',
            'store' => 'pegawai.store',
            'edit' => 'pegawai.edit',
            'show' => 'pegawai.show',
            'update' => 'pegawai.update',
            'destroy' => 'pegawai.destroy',
        ]
    ])->parameters(['' => 'id']);
});
Route::prefix('data')->group(function () {
    Route::get('propinsi', [PropinsiController::class, 'getPropinsi'])->name('propinsi.data');
});
