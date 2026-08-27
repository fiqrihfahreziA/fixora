<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AtasanController;
use App\Http\Controllers\DualroleController;
use App\Http\Controllers\PenerimaController;

Route::middleware(['auth', 'dual.role'])
    ->prefix('multirole')
    ->name('multirole.')
    ->group(function () {
         
        //ATASAN
        Route::get('/', [DualroleController::class, 'index'])
            ->name('dashboard');
    
         Route::get('/permintaann/atasan', [AtasanController::class, 'index'])
            ->name('permintaan');

        //PENERIMA
          Route::get('/permintaann', [PenerimaController::class, 'index'])
            ->name('permintaann');
            
    });

