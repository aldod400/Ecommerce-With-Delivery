<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ConfigController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'lang'], function () {
    Route::get('/config', [ConfigController::class, 'getConfig']);
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth:api');
        Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('updateProfile')->middleware('auth:api');
    });
});
