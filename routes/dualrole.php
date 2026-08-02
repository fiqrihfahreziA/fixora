<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AtasanController;
use App\Http\Controllers\DualroleController;

Route::middleware(['auth', 'dual.role'])
    ->prefix('multirole')
    ->name('multirole.')
    ->group(function () {
         
        //ATASAN
        Route::get('/', [DualroleController::class, 'index'])
            ->name('dashboard');
    
         Route::get('/permintaann/atasan', [DualroleController::class, 'showpermintaann'])
            ->name('permintaan');

        //PENERIMA
          Route::get('/permintaann', [DualroleController::class, 'showpermintaan'])
            ->name('permintaann');
            
    });

