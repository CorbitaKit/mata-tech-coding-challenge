<?php


use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(base_path('routes/api/v1.php'));
