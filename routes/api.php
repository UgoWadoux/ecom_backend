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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware'=>'auth:sanctum'], function (){
    Route::apiResource('order', OrderController::class);
    Route::apiResource('user', UserController::class);

    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category/{id}', [CategoryController::class, 'update']);
    Route::get('category/{id}', [CategoryController::class, 'destroy']);

    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::get('product/{id}', [ProductController::class, 'destroy']);

    Route::post('blog', [BlogController::class, 'store']);
    Route::put('blog/{id}', [BlogController::class, 'update']);
    Route::get('blog/{id}', [BlogController::class, 'destroy']);

    Route::post('service', [ServiceController::class, 'store']);
    Route::put('service/{id}', [ServiceController::class, 'update']);
    Route::get('service/{id}', [ServiceController::class, 'destroy']);

    Route::post('comment', [CommentController::class, 'store']);
    Route::put('comment/{id}', [CommentController::class, 'update']);
    Route::get('comment/{id}', [CommentController::class, 'destroy']);
});
// Public routes of authentication
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
});
// Public routes for product
Route::controller(ProductController::class)->group(function (){
   Route::get('product', 'index');
   Route::get('product/{id}', 'show');
});
// Public routes for category
Route::controller(CategoryController::class)->group(function (){
    Route::get('category', 'index');
    Route::get('category/{id}', 'show');
});
// Public routes for blog
Route::controller(BlogController::class)->group(function (){
    Route::get('blog', 'index');
    Route::get('blog/{id}', 'show');
});
// Public routes for service
Route::controller(ServiceController::class)->group(function (){
    Route::get('service',  'index');
    Route::get('service/{id}',  'show');
});
// Public routes for comment
Route::controller(CommentController::class)->group(function (){
    Route::get('comment', 'index');
    Route::get('comment/{id}', 'show');
});




//Route::post('/forgot-password', function (Request $request) {
//    $request->validate(['email' => 'required|email']);
//
//    $status = Password::sendResetLink(
//        $request->only('email')
//    );
////    $status = Password::sendResetLink(
////        $request->only('email')
////    );
////    dd($status);
//    return $status === Password::RESET_LINK_SENT
//        ? back()->with(['status' => __($status)])
//        : back()->withErrors(['email' => __($status)]);
//})->middleware('guest')->name('password.email');


Route::post('password/email',  ForgotPasswordController::class);
Route::post('password/code/check', CodeCheckController::class);
Route::post('password/reset', ResetPasswordController::class);

//Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
