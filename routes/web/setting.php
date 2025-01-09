<?php

use App\Http\Controllers\SettingController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [ViewController::class, 'setting']);
        Route::post('/limits', [SettingController::class, 'updateLimit']);
    });
