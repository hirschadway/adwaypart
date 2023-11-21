<?php
// Route::apiResource('/productcategories',CommentController::class);

use App\Http\Controllers\ProductcategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
    ])
    ->name('productcategories.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/productcategories', [ProductcategoryController::class, 'index'])
        // ->withoutMiddleware('auth')
        ->name('index');

        Route::get('/productcategories/{productcategory}', [ProductcategoryController::class, 'show'])
        // ->where('productcategory','[1-9]+')
        ->whereNumber('productcategory')
        ->name('show');

        Route::post('/productcategories', [ProductcategoryController::class, 'store'])
        ->name('store');

        Route::patch('/productcategories/{productcategory}', [ProductcategoryController::class, 'update'])
        ->whereNumber('productcategory')
        ->name('update');

        Route::delete('/productcategories/{productcategory}', [ProductcategoryController::class, 'destroy'])
        ->whereNumber('productcategory')
        ->name('destroy');
    });
