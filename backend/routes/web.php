<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// authorization
Route::post('/api/auth/login', [AuthController::class, 'login']);
Route::post('/api/auth/signup', [AuthController::class, 'signup']);
Route::get('/api/auth/{id}', [AuthController::class, 'getUser']);
Route::put('/api/auth/{id}', [AuthController::class, 'updateUser']);

// items
Route::post('/api/items', [ItemController::class, 'insertItem']);
Route::put('/api/items/{id}', [ItemController::class, 'updateItem']);
Route::delete('/api/items/{id}', [ItemController::class, 'deleteItem']);
Route::put('/api/items/{id}/photo', [ItemController::class, 'deleteItemPhoto']);
Route::post('/api/items/{id}/photo', [ItemController::class, 'updateItemPhoto']);
Route::get('/api/items/{id}',  [ItemController::class, 'getItem']);
Route::get('/api/items', [ItemController::class, 'getItems']);

// cart
Route::post('/api/carts/{idUser}', [CartController::class, 'createCart']);
Route::post('/api/carts/items', [CartController::class, 'insertItemIntoCart']);
Route::put('/api/carts/items/{idCartItem}', [CartController::class, 'updateCartItemQuantity']);
Route::delete('/api/carts/items/{idCartItem}', [CartController::class, 'deleteCartItem']);
Route::get('/api/carts/{idUser}', [CartController::class, 'getCart']);

// orders
Route::post('/api/orders', [OrderController::class, 'insertOrder']);
Route::get('/api/orders/{idUser}', [OrderController::class, 'getOrdersByUserId']);
Route::get('/api/orders/{id}', [OrderController::class, 'getOrderDetails']);
Route::delete('/api/orders/{id}', [OrderController::class, 'deleteOrder']);

// categories
Route::post('/api/categories', [CategoryController::class, 'addCategory']);
Route::get('/api/categories/{id}', [CategoryController::class, 'getCategoryById']);
Route::delete('/api/categories/{id}', [CategoryController::class, 'deleteCategory']);
Route::get('/api/categories', [CategoryController::class, 'searchCategory']);



