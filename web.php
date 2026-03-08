<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\MahasiswaController; // Pastikan ini ada 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute CRUD Mahasiswa (Sesuai Modul 2)
// Diletakkan di luar middleware auth agar bisa diakses langsung untuk keperluan praktikum
Route::resource('mahasiswa', MahasiswaController::class);

Route::resource('matakuliah', MatakuliahController::class);
// Grup Middleware untuk Auth (Breeze/Jetstream)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute untuk Assets
    Route::prefix('assets')->name('assets.')->group(function () {
        Route::get('/', [AssetController::class, 'index'])->name('index');
        Route::get('/luxury', [AssetController::class, 'luxury'])->name('luxury');
        Route::post('/store', [AssetController::class, 'store'])->name('store');
        Route::delete('/{id}', [AssetController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';

Route::view('/cv', 'cv');