<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Import Controller lo biar nggak error
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class);