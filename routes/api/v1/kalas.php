<?php

use App\Http\Controllers\KalaController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
])
    ->name('kalas.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/kalas', [KalaController::class, 'index'])
            // ->withoutMiddleware('auth')
            ->name('index');

        Route::get('/kalas/{kala}', [KalaController::class, 'show'])
            // ->where('kala','[1-9]+')
            ->whereNumber('kala')
            ->name('show');

        Route::post('/kalas', [KalaController::class, 'store'])
            ->name('store');

        Route::patch('/kalas/{kala}', [KalaController::class, 'update'])
            ->whereNumber('kala')
            ->name('update');

        Route::delete('/kalas/{kala}', [KalaController::class, 'destroy'])
            ->whereNumber('kala')
            ->name('destroy');
    });
