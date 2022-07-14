<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ParentKriteriaController;
use App\Http\Controllers\SeleksiPegawaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Halaman Beranda'
    ]);
});
// Route::get('/home', function () {
//     return view('home');
// });

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login/proses', [AuthController::class, 'authenticated'])->name('authenticated');


Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cek_login:admin']], function(){
        Route::get('admin', [AdminController::class, 'index']);
        Route::resource('/admin/kriteria', KriteriaController::class);
        Route::resource('/admin/kriteria-parent', ParentKriteriaController::class);
        Route::resource('/admin/bobot', BobotController::class);
    });

    Route::group(['middleware' => ['cek_login:pegawai']], function(){
        // Route::get('pegawai', function(){
        //     return view('employee.index');
        // });
        Route::get('pegawai', [EmployeeController::class, 'index']);
        Route::get('pegawai/kriteria', [EmployeeController::class, 'kriteria']);
        Route::get('pegawai/bobot', [EmployeeController::class, 'bobot']);
    });
});


Route::resource('/data-karyawan', DataKaryawanController::class)->middleware('auth');
Route::get('/karyawan/hapus-semua', [DataKaryawanController::class, 'deleteAll'])->middleware('auth');
Route::get('/seleksi-karyawan', [SeleksiPegawaiController::class, 'index'])->middleware('auth');
Route::get('/seleksi-karyawan/proses', [SeleksiPegawaiController::class, 'seleksi'])->middleware('auth');
Route::get('/seleksi-karyawan/proses/cetak', [SeleksiPegawaiController::class, 'cetak'])->middleware('auth');
Route::get('/seleksi-karyawan/hapus-semua', [SeleksiPegawaiController::class, 'deleteAll'])->middleware('auth');
