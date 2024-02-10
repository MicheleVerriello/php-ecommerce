<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
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

// items
Route::post('/api/items', [ItemController::class, 'insertItem']);
Route::put('/api/items/{id}', [ItemController::class, 'updateItem']);
Route::delete('/api/items/{id}', [ItemController::class, 'deleteItem']);
Route::get('/api/items/{id}',  [ItemController::class, 'getItem']);
Route::get('/api/items', [ItemController::class, 'getItems']);

// cart
Route::post('/api/carts/{id}/items', 'CartController@insertItemIntoCart');
Route::put('/api/carts/items/{idCartItem}', 'CartController@updateCartItemQuantity');
Route::delete('/api/carts/items/{idCartItem}', 'CartController@deleteCartItem');
Route::get('/api/carts/{idUser}', 'CartController@insertItem');

// orders
Route::post('/api/orders', 'OrderController@insertOrder');
Route::get('/api/orders/{idUser}', 'OrderController@getOrdersByUserId');
Route::get('/api/orders/{id}', 'OrderController@getOrderDetails');
Route::delete('/api/orders/{id}', 'OrderController@deleteOrder');



