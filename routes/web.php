<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ParentKriteriaController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\CheckLogin;

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
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});

// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login/authenticathed', [LoginController::class, 'authenticathed'])->name('authenticathed');
// Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
// Route::post('/register/store', [RegisterController::class, 'store'])->name('store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login/proses', [AuthController::class, 'authenticated'])->name('authenticated');


Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cek_login:admin']], function(){
        Route::get('admin', [AdminController::class, 'index']);
    });

    Route::group(['middleware' => ['cek_login:pegawai']], function(){
        Route::get('pegawai', function(){
            return view('employee.index');
        });
    });
});


Route::resource('/admin/kriteria', KriteriaController::class)->middleware('admin');
Route::resource('/admin/kriteria-parent', ParentKriteriaController::class)->middleware('auth');
Route::resource('/admin/bobot', BobotController::class);