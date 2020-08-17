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

Route::post('preregister', 'Auth\RegisterController@preregister')->name('preregister');
Route::post('confirmation', 'Auth\RegisterController@confirmation')->name('confirmation');
Route::post('endregister', 'Auth\RegisterController@endregister')->name('endregister');

Route::get('start', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    // Products
    Route::get('products', 'ProductController@index')->name('products.index');//->middleware('permission:index');
    Route::get('product/create', 'ProductController@create')->name('product.create');//->middleware('permission:create');
    Route::post('product/store', 'ProductController@store')->name('product.store');//->middleware('permission:store');
    Route::get('product/{role}', 'ProductController@show')->name('product.show');//->middleware('permission:show');
    Route::get('product/{role}/edit', 'ProductController@edit')->name('product.edit');//->middleware('permission:edit');
    Route::put('product/{role}', 'ProductController@update')->name('product.update');//->middleware('permission:update');
    Route::delete('product/{role}', 'ProductController@destroy')->name('product.destroy');//->middleware('permission:destroy');
    // Category
    Route::post('search/category', 'HomeController@searchCategory')->name('search.category');
    // Favorites
    Route::get('favorites', 'FavoriteController@index')->name('favorites.index');//->middleware('permission:index');
    Route::post('favorite/store', 'FavoriteController@store')->name('favorite.store');//->middleware('permission:store');
    // Matches
    Route::get('matches', 'MatchController@index')->name('matches.index');//->middleware('permission:index');
    Route::get('match/{role}', 'MatchController@show')->name('match.show');//->middleware('permission:show');
    // Favorites
    Route::post('match/store', 'FavoriteController@storeHome')->name('favorite_home.store');//->middleware('permission:store');
});
