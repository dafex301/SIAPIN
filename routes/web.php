<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MhsPraktikumController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

// // Login Page
// Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
// Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

// // Logout
// Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// // Dashboard
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// // CRUD Matkul
// Route::resource('dashboard/matkul', MatkulController::class)->middleware('auth');
// Login Page
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// QR Code view 
Route::get('dashboard/qrcode', [QrCodeController::class, 'index']);
Route::post('dashboard/qrcode', [QrCodeController::class, 'generateQrCode']);
Route::get('dashboard/qrcode/scan', [QrCodeController::class, 'scanQrCode']);


// CRUD Mahasiswa
// Route::resource('dashboard/mahasiswa', MahasiswaController::class)->middleware('auth');
Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/dashboard/mahasiswa/getMahasiswa', [MahasiswaController::class, 'create'])->name('mahasiswa.get');
Route::get('/dashboard/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::get('/dashboard/mahasiswa/destroy/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

Route::post('/dashboard/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::post('/dashboard/mahasiswa/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

//Lab
Route::get('/dashboard/lab', [LabController::class, 'index'])->name('lab.index');
Route::get('/dashboard/lab/getLab', [LabController::class, 'create'])->name('lab.get');
Route::get('/dashboard/lab/edit/{id}', [LabController::class, 'edit'])->name('lab.edit');
Route::get('/dashboard/lab/destroy/{id}', [LabController::class, 'destroy'])->name('lab.destroy');

Route::post('/dashboard/lab/store', [LabController::class, 'store'])->name('lab.store');
Route::post('/dashboard/lab/update', [LabController::class, 'update'])->name('lab.update');

//Matkul
Route::get('/dashboard/matkul', [MatkulController::class, 'index'])->name('matkul.index');
Route::get('/dashboard/matkul/getMatkul', [MatkulController::class, 'create'])->name('matkul.get');
Route::get('/dashboard/matkul/edit/{id}', [MatkulController::class, 'edit'])->name('matkul.edit');
Route::get('/dashboard/matkul/destroy/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');

Route::post('/dashboard/matkul/store', [MatkulController::class, 'store'])->name('matkul.store');
Route::post('/dashboard/matkul/update', [MatkulController::class, 'update'])->name('matkul.update');

//Jadwal
Route::get('/dashboard/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/dashboard/jadwal/getJadwal', [JadwalController::class, 'create'])->name('jadwal.get');
Route::get('/dashboard/jadwal/edit/{id}', [JadwalController::class, 'edit'])->name('jadwal.edit');
Route::get('/dashboard/jadwal/destroy/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
Route::get('/dashboard/jadwal/inputJadwal/{id}', [JadwalController::class, 'inputJadwal'])->name('jadwal.inputJadwal');


Route::post('/dashboard/jadwal/store', [JadwalController::class, 'store'])->name('jadwal.store');
Route::post('/dashboard/jadwal/update', [JadwalController::class, 'update'])->name('jadwal.update');

//MhsPraktikum
Route::get('/dashboard/mhspraktikum', [MhsPraktikumController::class, 'index'])->name('mhspraktikum.index');
Route::get('/dashboard/mhspraktikum/getMhsPraktikum', [MhsPraktikumController::class, 'create'])->name('mhspraktikum.get');
Route::get('/dashboard/mhspraktikum/edit/{id}', [MhsPraktikumController::class, 'edit'])->name('mhspraktikum.edit');
Route::get('/dashboard/mhspraktikum/destroy/{id}', [MhsPraktikumController::class, 'destroy'])->name('mhspraktikum.destroy');

Route::post('/dashboard/mhspraktikum/store', [MhsPraktikumController::class, 'store'])->name('mhspraktikum.store');
Route::post('/dashboard/mhspraktikum/update', [MhsPraktikumController::class, 'update'])->name('mhspraktikum.update');
Route::post('/dashboard/mhspraktikum/updateAtt', [MhsPraktikumController::class, 'updateAtt'])->name('mhspraktikum.updateAtt');


