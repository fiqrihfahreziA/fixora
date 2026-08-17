<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AtasanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\keuanganController;

// Route::get('/admin/login', function () {
//     return view('auth.admin-login');
// })->name('admin.login');

// Route::get('/admin/login', [AdminController::class, 'login'])
//             ->name('admin.login');

Route::middleware(['auth', 'role:keuangan'])
    ->prefix('keuangan')
    ->name('keuangan.')
    ->group(function () {

        Route::get('/', [keuanganController::class, 'index'])
            ->name('dashboard');
         
        Route::get('/permintaann', [keuanganController::class, 'showpengadaan'])
            ->name('pengadaan');
        Route::get('/pengadaan/{id}/detail', [KeuanganController::class, 'detail'])->name('pengadaan.detail');
        Route::put('keuangan/verifikasi/lengkap/{id}', [KeuanganController::class, 'verifikasiLengkap'])->name('verifikasi.lengkap');
        Route::put('keuangan/verifikasi/sebagian/{id}', [KeuanganController::class, 'verifikasiSebagian'])->name('verifikasi.sebagian');
        Route::put('keuangan/tolak/{id}', [KeuanganController::class, 'tolak'])->name('tolak');
        // Route::get('/permintaann/edit/{id}', [AtasanController::class, 'edit'])->name('permintaan.edit');
        // Route::put('/permintaannea/update/{id}', [AtasanController::class, 'update'])->name('permintaan.update');   
      
        // Route::get('/atasan/permintaan/{id}/view', [AtasanController::class, 'view'])
        //     ->name('permintaan.view');
        // Route::get('permintaan/{id}/gambar', [AtasanController::class, 'lihatGambar'])->name('permintaan.gambar');
        // // Route::delete('/permintaan-penerima/{id}',[PenerimaController::class, 'destroy'])->name('permintaan.destroyy');

        // // pengadaan
        // Route::get('/chart/pengadaan', [AtasanController::class, 'pengadaanshow'])
        //     ->name('pengadaan');
        
        // Route::get('/pengadaan/{id}', [AtasanController::class, 'showpengadaan'])->name('pengadaan.show');
        // Route::put('/pengadaan/{id}/verifikasi', [AtasanController::class, 'verifikasi'])
        //     ->name('pengadaan.verifikasi');

    });

