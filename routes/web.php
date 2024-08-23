<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthSessionController;


// Route::view('/', 'app')->name('main');
Route::get('/', function () {
    return view('app');
});//->middleware('auth:sanctum')->name('main');


Route::view('/auth', 'app')->name('main')->name('login');
// Route::get('/auth', function () {
//     return view('app');
// })->name('login');



Route::prefix('/approval')->group(function () {
    Route::view('/', 'app')->name('approval');
    Route::view('/list/{type}', 'app')->name('approval.list');

    Route::view('/list/formList', 'app')->name('approval.formList');
});


Route::prefix('/auth')->group(function () {
    Route::controller(AuthSessionController::class)->group(function () {
        Route::post('/login', 'store')->name('login');
        Route::delete('/logout', 'destroy')->name('logout');
    });
});



Route::view('/{pathMatch}', 'app')->where('pathMatch', ".*")->name('notfound');
// Route::get('/{pathMatch}', function(){
//     return view('app');
// })->where('pathMatch', ".*");

