<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth',
    ])
    ->name('users.')
    // ->prefix('heyaa')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])
        // ->withoutMiddleware('auth')
        ->name('index');

        Route::get('/users/{user}', [UserController::class, 'show'])
        // ->where('user','[1-9]+')
        ->whereNumber('user')
        ->name('show');

        Route::post('/users', [UserController::class, 'store'])
        ->name('store');

        Route::patch('/users/{user}', [UserController::class, 'update'])
        ->whereNumber('user')
        ->name('update');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->whereNumber('user')
        ->name('destroy');
    });
