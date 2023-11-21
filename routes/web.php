<?php

use App\Mail\WelcomeMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/tool/{group_name}', function () {
 return view('tools');
});
Route::get('/models/{model?}', function () {
 return view('tools');
});

if(App::environment('local')){
    Route::get('/sendwelcomemail', function () {
        return (new WelcomeMail())->render();
    });
};