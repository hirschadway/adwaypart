<?php

use App\Http\Controllers\MainproductController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
])
    ->name('mainproducts.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/mainproducts', [MainproductController::class, 'index'])
            // ->withoutMiddleware('auth')
            ->name('index');

        Route::get('/mainproducts/{mainproduct}', [MainproductController::class, 'show'])
            // ->where('mainproduct','[1-9]+')
            ->whereNumber('mainproduct')
            ->name('show');

        Route::post('/mainproducts', [MainproductController::class, 'store'])
            ->name('store');

        Route::patch('/mainproducts/{mainproduct}', [MainproductController::class, 'update'])
            ->whereNumber('mainproduct')
            ->name('update');

        Route::delete('/mainproducts/{mainproduct}', [MainproductController::class, 'destroy'])
            ->whereNumber('mainproduct')
            ->name('destroy');
    });
