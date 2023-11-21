<?php

use App\Http\Controllers\KalagroupController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
])
    ->name('kalagroups.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/kalagroups', [KalagroupController::class, 'index'])
            // ->withoutMiddleware('auth')
            ->name('index');

        Route::get('/kalagroups/{kalagroup}', [KalagroupController::class, 'show'])
            // ->where('kalagroup','[1-9]+')
            ->whereNumber('kalagroup')
            ->name('show');

        Route::post('/kalagroups', [KalagroupController::class, 'store'])
            ->name('store');

        Route::patch('/kalagroups/{kalagroup}', [KalagroupController::class, 'update'])
            ->whereNumber('kalagroup')
            ->name('update');

        Route::delete('/kalagroups/{kalagroup}', [KalagroupController::class, 'destroy'])
            ->whereNumber('kalagroup')
            ->name('destroy');

        // Route::kalagroup('/kalagroups/{kalagroup}/share', [KalagroupController::class, 'share'])
        //     ->whereNumber('kalagroup')
        //     ->name('share');
    });
