<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IrsController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PresensiMhsController;

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

// Homepage
Route::get('/', [HomeController::class, 'index']);

// Login Page
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// CRUD Matkul
Route::resource('dashboard/matkul', MatkulController::class)->middleware('admin');

// CRUD Lab
Route::resource('dashboard/lab', LabController::class)->middleware('admin');

// CRUD User
Route::resource('dashboard/mahasiswa', UserController::class)->middleware('admin');

// CRUD Jadwal
Route::resource('dashboard/jadwal', JadwalController::class)->middleware('admin');

// Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'mahasiswa'])->middleware('admin')->name('mahasiswa');

// Show the IRS with given ID of jadwal from url
Route::get('/dashboard/jadwal/{jadwal_id}/mhs', [IrsController::class, 'show'])->middleware('admin')->name('irs.show');
Route::delete('/dashboard/jadwal/{jadwal_id}/mhs/{user_id}', [IrsController::class, 'destroy'])->middleware('admin')->name('irs.destroy');
Route::post('/dashboard/jadwal/{jadwal_id}/mhs', [IrsController::class, 'store'])->middleware('admin')->name('irs.store');

// Presensi Route
Route::get('/dashboard/presensi', [PresensiController::class, 'index'])->middleware('admin')->name('presensi');
Route::get('/dashboard/presensi/{id}', [PresensiController::class, 'show'])->middleware('admin')->name('presensi.show');
Route::post('/dashboard/presensi/{presensi}', [PresensiController::class, 'store'])->middleware('admin')->name('presensi.store');
Route::delete('/dashboard/presensi/{id}', [PresensiController::class, 'destroy'])->middleware('admin')->name('presensi.destroy');



// Generate QR Code
Route::get('/dashboard/presensi/{jadwal_id}/{pertemuan}/qr', [PresensiController::class, 'generateQR'])->middleware('admin')->name('presensi.qr');
Route::delete('/dashboard/presensi/{jadwal_id}/{pertemuan}/qr/{id}', [PresensiController::class, 'destroyQR'])->middleware('admin')->name('qr.destroy');

// Presensi Mahasiswa Route
Route::get('/dashboard/mhs/presensi', [PresensiMhsController::class, 'index'])->middleware('auth')->name('presensi.mhs');
Route::post('/dashboard/mhs/presensi', [PresensiMhsController::class, 'store'])->middleware('auth')->name('presensi.mhs.store');
Route::get('/dashboard/mhs/presensi/history', [PresensiMhsController::class, 'show'])->middleware('auth')->name('presensi.mhs.show');

Route::get('/popup', function () {
  return view('popup');
});
