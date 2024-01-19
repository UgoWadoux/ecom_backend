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
Route::get('products',[\App\Http\Controllers\Api\ProductController::class, 'index']);
Route::post('product', [\App\Http\Controllers\Api\ProductController::class,'createProduct']);
Route::get('product/{id}', [\App\Http\Controllers\Api\ProductController::class,'findProduct']);
Route::put('product/{id}',[\App\Http\Controllers\Api\ProductController::class, 'modifyProduct']);
Route::delete('product/{id}',[\App\Http\Controllers\Api\ProductController::class,'deleteProduct']);

Route::get('categories',[\App\Http\Controllers\Api\CategoryController::class,'getCategories']);
Route::get('category/{id}',[\App\Http\Controllers\Api\CategoryController::class,'getCategory']);
Route::post('category',[\App\Http\Controllers\Api\CategoryController::class,'createCategory']);
Route::put('category/{id}',[\App\Http\Controllers\Api\CategoryController::class,'modifyCategory']);
Route::delete('category/{id}',[\App\Http\Controllers\Api\CategoryController::class,'deleteCategory']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('users',[\App\Http\Controllers\Api\UserController::class, 'getUsers']);
Route::get('user/{id}',[\App\Http\Controllers\Api\UserController::class, 'getUser']);
Route::post('user',[\App\Http\Controllers\Api\UserController::class, 'createUser']);
Route::put('user/{id}',[\App\Http\Controllers\Api\UserController::class, 'updateUser']);
Route::delete('user/{id}',[\App\Http\Controllers\Api\UserController::class, 'deleteUser']);

Route::get('blogs',[\App\Http\Controllers\Api\BlogController::class, 'getBlogs']);
Route::get('blog/{id}',[\App\Http\Controllers\Api\BlogController::class, 'getBlog']);
Route::post('blog',[\App\Http\Controllers\Api\BlogController::class, 'createBlog']);
Route::put('blog/{id}',[\App\Http\Controllers\Api\BlogController::class, 'updateBlog']);
Route::delete('blog/{id}',[\App\Http\Controllers\Api\BlogController::class, 'deleteBlog']);
