<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;

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
Route::resource('dashboard/matkul', MatkulController::class)->middleware('auth');

// CRUD Lab
Route::resource('dashboard/lab', LabController::class)->middleware('auth');

// CRUD User
Route::resource('dashboard/mahasiswa', UserController::class)->middleware('auth');

// CRUD Jadwal
Route::resource('dashboard/jadwal', JadwalController::class)->middleware('auth');

// Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'mahasiswa'])->middleware('auth')->name('mahasiswa');

Route::get('/popup', function () {
  return view('popup');
});