<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'lang'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::group(['middleware' => 'auth:api', 'prefix' => 'profile'], function () {
            Route::get('/', [AuthController::class, 'profile'])->name('profile');
            Route::post('/update', [AuthController::class, 'updateProfile'])->name('updateProfile');
            Route::post('/delete', [AuthController::class, 'deleteProfile'])->name('deleteProfile');
        });
    });
    Route::get('/config', [ConfigController::class, 'getConfig']);
    Route::group(['prefix' => 'home'], function () {
        Route::get('/banners', [HomeController::class, 'getBanners'])->name('banners');
        Route::get('/categories', [HomeController::class, 'popularCategories'])->name('popular.categories');
        Route::get('/products', [HomeController::class, 'getLatestProducts'])->name('latest.products');
    });
});
