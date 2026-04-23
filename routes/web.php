<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\LaporanController;

// --- Authentication Routes ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Protected Routes ---
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Siswa Routes
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/tambahsiswa', [SiswaController::class, 'create']);
    Route::post('/siswa', [SiswaController::class, 'store']);
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit']);
    Route::put('/siswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

    // Buku Routes
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/tambahbuku', [BukuController::class, 'create']);
    Route::post('/buku', [BukuController::class, 'store']);
    Route::get('/buku/{id}', [BukuController::class, 'show']);
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit']);
    Route::put('/buku/{id}', [BukuController::class, 'update']);
    Route::delete('/buku/{id}', [BukuController::class, 'destroy']);

    // Kategori Routes
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/tambahkategori', [KategoriController::class, 'create']);
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/kategori/{id}', [KategoriController::class, 'update']);
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

    // Peminjaman Routes
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/tambahpeminjaman', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit']);
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan']);
    Route::post('/peminjaman/{id}/bayar-denda', [PeminjamanController::class, 'payFine']);
    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update']);
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy']);

    // User Routes
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/tambahuser', [UserController::class, 'create']);
    Route::post('/user', [UserController::class, 'store']);
    // keeping RESTful patterns where possible
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::put('/settings', [SettingsController::class, 'update']);

    // Laporan
    Route::get('/laporan/denda', [LaporanController::class, 'denda']);
});
