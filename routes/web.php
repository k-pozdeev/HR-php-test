<?php

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

Route::get("/", "HelloController@home");
Route::get("/temperature", "TemperatureController@temp")->name("temperature");
Route::get("/orders", "OrderController@orders")->name("orders");
Route::get("/orders/edit/{id}", "OrderController@orderEdit")->name("orders-edit");
Route::post("/orders/save/{id}", "OrderController@orderSave")->name("orders-save");
Route::get("/products", "ProductsController@products")->name("products");
Route::post('/products/edit/{id}', "ProductsController@editPrice");
