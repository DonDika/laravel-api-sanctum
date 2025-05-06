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
})->name('login');


Route::post('/register',[AuthController::class, 'registerUser']);
Route::post('/login',[AuthController::class, 'loginUser']);


Route::get('/product', [ProductController::class, 'getProduct'])
        ->middleware('auth:sanctum','ability:product-list');

Route::post('/product',[ProductController::class, 'postProduct'])
        ->middleware('auth:sanctum','ability:product-post');



        