<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->group(function () {
        Route::middleware('auth')
            ->group(function () {
                Route::get('/logout', [AuthController::class, 'logout']);
            });

        Route::middleware('guest')
            ->group(function () {
                Route::get('/login', [ViewController::class, 'login'])
                    ->name('login');
                Route::post('/login', [AuthController::class, 'login']);
            });
    });
