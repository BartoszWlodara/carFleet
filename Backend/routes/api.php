<?php

//use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::post('/login', [LoginController::class, 'login']);
Route::delete('/logout', [LoginController::class, 'logout']);

Route::get('/cars', [CarController::class, 'index'])->middleware('auth:sanctum');
Route::prefix('/car')->group(function () {
    Route::post('/store', [CarController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/{id}', [CarController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{id}', [CarController::class, 'destroy'])->middleware('auth:sanctum');
    Route::get('/{id}', [CarController::class, 'show'])->middleware('auth:sanctum');
});

Route::prefix('/user')->group(function () {
    Route::post('/add', [UserController::class, 'store']);
});

Route::get('/run-migrations', function () {
    return Artisan::call('migrate', ["--force" => true ]);
});

Route::get('/status-migrations', function () {
    return Artisan::call('migrate:status');
});

Route::get('/install-migrations', function () {
    return Artisan::call('migrate:install');
});

