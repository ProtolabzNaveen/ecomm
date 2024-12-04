<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::get('/products',[ProductController::class, 'index']);
Route::get('category',[CategoryController::class,'index']);

Route::middleware(['token.valid'])->group(function () {
    // Add your protected routes here
    Route::get('users', [ApiController::class, 'users']);
    Route::get('user/{id}', [ApiController::class, 'user']);
    Route::post('product/store',[ProductController::class,'store']);
    Route::get('product/edit/{id}',[ProductController::class,'edit']);
    Route::post('product/update',[ProductController::class,'update']);
    
    Route::post('category/store',[CategoryController::class,'store']);
    Route::get('category/edit/{id}',[CategoryController::class,'edit']);
    Route::post('category/update',[CategoryController::class,'update']);


});

