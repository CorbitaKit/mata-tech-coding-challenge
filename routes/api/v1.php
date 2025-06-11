<?php

use App\Http\Controllers\v1\Auth\AuthController;
use App\Http\Controllers\v1\PizzaTypeController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('pizza-types', PizzaTypeController::class)->only(['store', 'update', 'destroy']);
});
