<?php

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
Route::post('/api/login', 'AuthController@login');
Route::post('/api/signup', 'AuthController@signup');

// items
Route::post('/api/items', 'ItemController@insertItem');
Route::put('/api/items/{id}', 'ItemController@updateItem');
Route::delete('/api/items/{id}', 'ItemController@deleteItem');
Route::get('/api/items/{id}', 'ItemController@getItem');
Route::get('/api/items', 'ItemController@getItems');

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



