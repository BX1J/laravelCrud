<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::controller(ProductController::class)->group(function(){
    Route::get('/products','index')->name('products.index');
    Route::get('/products/create','create')->name('products.create');
    Route::post('/produtcs','store')->name('products.store');
    Route::get('/products/{id}/edit','edit')->name('products.edit');
    Route::put('/products/{id}','update')->name('products.update');
    Route::delete('/products/{id}','destroy')->name('products.destroy');
    Route::get('/products/deleteAll','deleteAll')->name('products.deleteAll');
});
