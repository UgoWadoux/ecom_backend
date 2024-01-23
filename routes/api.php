<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::apiResource('product', \App\Http\Controllers\Api\ProductController::class);
Route::apiResource('category', \App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('user', \App\Http\Controllers\Api\UserController::class);
Route::apiResource('blog', \App\Http\Controllers\Api\BlogController::class);
Route::apiResource('service', \App\Http\Controllers\Api\ServiceController::class);
Route::apiResource('order', \App\Http\Controllers\Api\OrderController::class);
Route::apiResource('comment', \App\Http\Controllers\Api\CommentController::class);


