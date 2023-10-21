<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });s



// Authenticate User
Route::post('/user/authenticate',[LoginController::class,'authenticate']);

// Register User
Route::post('/user/register',[UserController::class,'store']);

// Order
Route::post('/customer/{customerId}/placeorder',[OrderController::class,'placeOrder']);

//Shoppingcart
Route::post('/shoppingcart/additem',[ShoppingCartController::class,'addItem']);
Route::post('/shoppingcart/updateQuantity',[ShoppingCartController::class,'updateQuantity']);

// Products
Route::get('/products',[ProductController::class,'getAllProducts']);
Route::post('/products',[ProductController::class,'addProduct']);
Route::get('/products/{productId}',[ProductController::class,'getProduct']);
Route::get('/products/{productId}/updatestock',[ProductController::class,'updateStock']);
