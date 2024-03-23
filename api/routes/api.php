<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/check', [AuthController::class, 'checkAuth']);

    Route::apiResource('companies', CompanyController::class);
    Route::apiResource('clients', ClientController::class);
});