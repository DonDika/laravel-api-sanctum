<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function(){
    return response()->json([
        'error' => true,
        'message' => 'akses tidak diperbolehkan'
    ], 401);
});

Route::get('/product', [ProductController::class, 'getProduct'])->middleware('auth:sanctum');

Route::post('/register',[AuthController::class, 'registerUser']);

Route::post('/login',[AuthController::class, 'loginUser']);