<?php

use App\Http\Controllers\NodeController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/nodes/add', [NodeController::class, 'addNode']);

Route::prefix('nodes')
    ->middleware('auth')
    ->group(function () {
        Route::get('/node-data', [NodeController::class, 'fetchNodeData']);
        Route::get('/detail/{id}', [NodeController::class, 'show']);
        Route::get('/table', [NodeController::class, 'table']);
        Route::get('/{number}', function () {
            return view('comingSoon', ['title' => 'Coming Soon']);
        });
    });
