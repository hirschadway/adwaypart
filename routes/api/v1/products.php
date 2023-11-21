<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
])
    ->name('products.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/products', [ProductController::class, 'index'])
            // ->withoutMiddleware('auth')
            ->name('index');

        Route::get('/products/{product}', [ProductController::class, 'show'])
            // ->where('product','[1-9]+')
            ->whereNumber('product')
            ->name('show');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('store');

        Route::patch('/products/{product}', [ProductController::class, 'update'])
            ->whereNumber('product')
            ->name('update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->whereNumber('product')
            ->name('destroy');
    });
