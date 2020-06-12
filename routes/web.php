<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('products', 'ProductController@index')->name('products.index')->middleware('permission:products.index');
    Route::get('product/create', 'ProductController@create')->name('product.create')->middleware('permission:product.create');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::get('product/{role}', 'ProductController@show')->name('product.show')->middleware('permission:product.show');
    Route::get('product/{role}/edit', 'ProductController@edit')->name('product.edit')->middleware('permission:product.edit');
    Route::put('product/{role}', 'ProductController@update')->name('product.update');
    Route::delete('product/{role}', 'ProductController@destroy')->name('product.destroy')->middleware('permission:product.destroy');
});
