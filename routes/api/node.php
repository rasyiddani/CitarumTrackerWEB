<?php

use App\Http\Controllers\NodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('nodes')
    ->group(function () {
        Route::get('/', [NodeController::class, 'index']);
        Route::get('/list', [NodeController::class, 'nodeList']);
        Route::post('/', [NodeController::class, 'store']);
    });
