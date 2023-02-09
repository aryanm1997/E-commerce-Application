<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product;
use App\Http\Controllers\Order;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::any('create-product', 'Product@createproduct');
// Route::any('create-product', [Product::class, 'createproduct']);
Route::any('create-product', 'App\Http\Controllers\Product@createproduct');
Route::any('create-order', 'App\Http\Controllers\Order@createOrder');
Route::get('list-product', 'App\Http\Controllers\Product@listProduct');
Route::get('list-order', 'App\Http\Controllers\Order@listOrder');
Route::delete('delete-product/{id}','App\Http\Controllers\Product@destroyProduct');
Route::delete('delete-order/{id}','App\Http\Controllers\Order@destroyOrder');
Route::get('edit-product/{id}', 'App\Http\Controllers\Product@editProduct');
Route::get('edit-order/{id}', 'App\Http\Controllers\Order@editOrder');
Route::any('update-order/{id}', 'App\Http\Controllers\Order@updateOrder');
Route::any('update-product/{id}', 'App\Http\Controllers\Product@updateProduct');
Route::get('generate-invoice/{id}', [Order::class, 'generateOrderPDF']);
// Route::get('/', function () {
//     return view('welcome');
// });