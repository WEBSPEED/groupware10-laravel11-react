<?php

use App\Http\Controllers\SiteMenuController;
use App\Http\Controllers\Auth\AuthSessionController;
use App\Http\Controllers\ProductController;


use App\Http\Controllers\Approval\ApprovalController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthSessionController::class, 'destroy'])->name('logout');


Route::get('/siteMenus', [SiteMenuController::class, 'index']);




Route::prefix('/approval')->group(function () {
    Route::controller(ApprovalController::class)->group(function () {
        Route::get('/dashboard', 'dashboard');

        Route::get('/list/{type}', 'getDocLists');
    });
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::post('/products', 'store');
    Route::get('/products/{product}/edit', 'show');
    Route::get('/products/{product}/show', 'show');
    Route::put('/products/{product}', 'update');
    Route::delete('/products/{product}', 'destroy');
});
