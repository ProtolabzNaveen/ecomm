<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\ProductController;

Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::get('/products',[ProductController::class, 'index']);

Route::middleware(['token.valid'])->group(function () {
    // Add your protected routes here
    Route::get('users', [ApiController::class, 'users']);
    Route::get('user/{id}', [ApiController::class, 'user']);
    Route::post('product/store',[ProductController::class,'store']);
    Route::get('product/edit/{id}',[ProductController::class,'edit']);
    Route::post('product/update',[ProductController::class,'update']);
});

