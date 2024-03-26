<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CodeCheckController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;

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

Route::group(['middleware'=>'auth:sanctum'], function (){

    Route::apiResource('orders', OrderController::class);
    Route::apiResource('users', UserController::class);

    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    Route::post('blogs', [BlogController::class, 'store']);
    Route::put('blogs/{id}', [BlogController::class, 'update']);
    Route::delete('blogs/{id}', [BlogController::class, 'destroy']);

    Route::post('services', [ServiceController::class, 'store']);
    Route::put('services/{id}', [ServiceController::class, 'update']);
    Route::delete('services/{id}', [ServiceController::class, 'destroy']);

    Route::post('comments', [CommentController::class, 'store']);
    Route::put('comments/{id}', [CommentController::class, 'update']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);
});
// Public routes of authentication
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
});
// Public routes for product
Route::controller(ProductController::class)->group(function (){
   Route::get('products', 'index');
   Route::get('products/{id}', 'show');
});
// Public routes for category
Route::controller(CategoryController::class)->group(function (){
    Route::get('categories', 'index');
    Route::get('categories/{id}', 'show');
});
// Public routes for blog
Route::controller(BlogController::class)->group(function (){
    Route::get('blogs', 'index');
    Route::get('blogs/{id}', 'show');
});
// Public routes for service
Route::controller(ServiceController::class)->group(function (){
    Route::get('services',  'index');
    Route::get('services/{id}',  'show');
});
// Public routes for comment
Route::controller(CommentController::class)->group(function (){
    Route::get('comments', 'index');
    Route::get('comments/{id}', 'show');
});
// Resetting password with email
Route::post('password/email',  ForgotPasswordController::class);
Route::post('password/code/check', CodeCheckController::class);
Route::post('password/reset', ResetPasswordController::class);

