<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('messages', [\App\Http\Controllers\MessageController::class, 'store']);
    Route::get('messages', [\App\Http\Controllers\MessageController::class, 'index']);
    Route::delete('messages/{message}', [\App\Http\Controllers\MessageController::class, 'delete']);
});
