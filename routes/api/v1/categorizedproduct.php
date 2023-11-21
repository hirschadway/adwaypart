<?php
// Route::apiResource('/categorizedproducts',CommentController::class);

use App\Http\Controllers\CategorizedproductController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
    ])
    ->name('categorizedproducts.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/categorizedproducts', [CategorizedproductController::class, 'index'])
        // ->withoutMiddleware('auth')
        ->name('index');

        Route::get('/categorizedproducts/{categorizedproduct}', [CategorizedproductController::class, 'show'])
        // ->where('categorizedproduct','[1-9]+')
        ->whereNumber('categorizedproduct')
        ->name('show');

        Route::post('/categorizedproducts', [CategorizedproductController::class, 'store'])
        ->name('store');

        Route::patch('/categorizedproducts/{categorizedproduct}', [CategorizedproductController::class, 'update'])
        ->whereNumber('categorizedproduct')
        ->name('update');

        Route::delete('/categorizedproducts/{categorizedproduct}', [CategorizedproductController::class, 'destroy'])
        ->whereNumber('categorizedproduct')
        ->name('destroy');

        // ***************************
        Route::get('/groups/{groupname}', [CategorizedproductController::class, 'getgroup'])
        // ->withoutMiddleware('auth')
        ->name('index');
    });
