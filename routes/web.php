<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\PemadamanController;
use App\Http\Controllers\Auth\LoginController;


// Route untuk logout hanya bisa diakses oleh yang sudah login
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Public routes
Route::get('/', [PemadamanController::class, 'publicIndex'])->name('public.index');
Route::get('/cek-pemadaman/{wilayah_id}', [PemadamanController::class, 'cekPemadaman'])->name('public.cek-pemadaman');

// Auth routes dengan middleware guest (hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// Route untuk logout hanya bisa diakses oleh yang sudah login
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->get('/home', [DashboardController::class, 'index'])->name('home');

// Admin routes dengan middleware auth Laravel (untuk pengguna yang sudah login)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('wilayah', WilayahController::class);
    Route::resource('pemadaman', PemadamanController::class);

    Route::get('/', [PemadamanController::class, 'publicIndex'])->name('public.index');
Route::get('/cek-pemadaman/{wilayah_id}', [PemadamanController::class, 'cekPemadaman'])->name('public.cek-pemadaman');

});
