<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PhoneController;
use \App\Http\Controllers\TestController;



Route::get('/{path?}', [PhoneController::class, 'index']);

Route::post('/upload', [PhoneController::class, 'store']);
Route::delete('/delete', [PhoneController::class, 'destroy']);

Route::post('/test', [TestController::class, 'store']);


