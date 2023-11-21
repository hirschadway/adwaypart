<?php
// Route::apiResource('/shops',CommentController::class);

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
    ])
    ->name('shops.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/shops', [ShopController::class, 'index'])
        // ->withoutMiddleware('auth')
        ->name('index');

        Route::get('/shops/{shop}', [ShopController::class, 'show'])
        // ->where('shop','[1-9]+')
        ->whereNumber('shop')
        ->name('show');

        Route::post('/shops', [ShopController::class, 'store'])
        ->name('store');

        Route::patch('/shops/{shop}', [ShopController::class, 'update'])
        ->whereNumber('shop')
        ->name('update');

        Route::delete('/shops/{shop}', [ShopController::class, 'destroy'])
        ->whereNumber('shop')
        ->name('destroy');
    });
