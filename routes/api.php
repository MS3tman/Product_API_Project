<?php

use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// for register
Route::post('/register',[PassportAuthController::class, 'register']);

//for login
Route::post('/login',[PassportAuthController::class, 'login']);

// //for userinfo
// Route::middleware('auth:api')->get('/userinfo',[ProductController::class, 'UserInfo']);

// //for create product
// Route::middleware('auth:api')->post('/product/create',[ProductController::class, 'store']);

// //for show all data 
// Route::middleware('auth:api')->get('/product/all',[ProductController::class, 'index']);

// //for show one product
// Route::middleware('auth:api')->get('/product/show',[ProductController::class, 'show']);

// //for update product
// Route::middleware('auth:api')->post('/product/update',[ProductController::class, 'update']);

// //for delete product
// Route::middleware('auth:api')->post('/product/delete',[ProductController::class, 'delete']);

Route::middleware('auth:api')->group(function(){

    // //for userinfo
    // Route::get('/userinfo',[PassportAuthController::class, 'UserInfo']);
    // //for create product
    // Route::post('/createproduct',[ProductController::class, 'store']);
    // //for show all data 
    // Route::get('/products',[ProductController::class, 'index']);
    // //for show one product
    // Route::get('/showproduct/{id}',[ProductController::class, 'show']);
    // //for update product
    // Route::put('/updateproduct/{id}',[ProductController::class, 'update']);
    // //for delete product
    // Route::delete('/deleteproduct/{id}',[ProductController::class, 'delete']);


    //for userinfo
    Route::resource('/userinfo',PassportAuthController::class);
    //for do all CRUP Operation on product
    Route::resource('/product',ProductController::class);

});