<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\AtasanController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::get('/p', function () {
    return view('welcome');
});



Route::get('/', [AuthenticatedSessionController::class, 'create'])
            ->name('dashboard');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);




// Route::middleware(['auth', 'role:pemohon'])->get('/pemohon', [PemohonController::class, 'index']);
// Route::middleware(['auth', 'role:penerima'])->get('/penerima', [PenerimaController::class, 'index']);
// Route::middleware(['auth', 'role:atasan'])->get('/atasan', [AtasanController::class, 'index']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/pemohon.php';
require __DIR__.'/penerima.php';
require __DIR__.'/direktur.php';
require __DIR__.'/atasan.php';
require __DIR__.'/keuangan.php';
require __DIR__.'/dualrole.php';