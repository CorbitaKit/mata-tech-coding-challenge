<?php

use App\Http\Controllers\v1\Auth\AuthController;
use App\Http\Controllers\v1\DashboardController;
use App\Http\Controllers\v1\PizzaTypeController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('pizza-types', PizzaTypeController::class)->only(['store', 'update', 'destroy']);

    Route::controller(DashboardController::class)->group(function () {
        Route::get('total-sales', 'totalSales');
        Route::get('total-orders', 'totalOrders');
        Route::get('top-selling-pizzas', 'topSellingPizzas');
        Route::get('top-selling-ingredients', 'topsSellingIngredients');
        Route::get('sales-summary', 'salesSummary');
        Route::get('latest-orders', 'getLatestOrders');
    });
});
