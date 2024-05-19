<?php

use App\Http\Controllers\AnalisisBebanKerjaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/create-profile', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [AnalisisBebanKerjaController::class, 'dashboard'])->name('dashboard');
    Route::get('/beban-kerja/list', [AnalisisBebanKerjaController::class, 'list'])->name('beban-kerja.list');
    Route::get('/beban-kerja', [AnalisisBebanKerjaController::class, 'index'])->name('beban-kerja.index');
    Route::get('/beban-kerja-report/{tahun}', [AnalisisBebanKerjaController::class, 'generatePDF'])->name('beban-kerja.report');
    Route::get('/beban-kerja/create', [AnalisisBebanKerjaController::class, 'create'])->name('beban-kerja.create');
    Route::post('/beban-kerja', [AnalisisBebanKerjaController::class, 'store'])->name('beban-kerja.store');
    Route::post('/beban-kerja/verifikasi', [AnalisisBebanKerjaController::class, 'verifikasi'])->name('beban-kerja.verifikasi');
    // Route::get('/beban-kerja/{id}/edit', [AnalisisBebanKerjaController::class, 'edit'])->name('beban-kerja.edit');
    // Route::patch('/beban-kerja/{id}', [AnalisisBebanKerjaController::class, 'update'])->name('beban-kerja.update');
    // Route::delete('/beban-kerja/{id}', [AnalisisBebanKerjaController::class, 'destroy'])->name('beban-kerja.destroy');
});

require __DIR__ . '/auth.php';
