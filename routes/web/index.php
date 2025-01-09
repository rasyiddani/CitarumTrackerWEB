<?php

use App\Http\Controllers\ViewController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->group(function () {
        Route::get('/', [ViewController::class, 'index'])
            ->name('home');
    });
