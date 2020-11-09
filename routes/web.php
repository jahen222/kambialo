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

// showcase
Route::get('showcase', 'ShowcaseController@index')->name('showcase.index');
Route::get('showcase/data', 'ShowcaseController@data')->name('showcase.data');
Route::post('showcase/favorite', 'ShowcaseController@favorite')->name('showcase.favorite');
Route::get('showcase/search', 'ShowcaseController@search')->name('showcase.search');

Route::get('notification/read','NotificationController@markAsRead')->name('notification.markAsRead');

Route::middleware(['auth'])->group(function () {
//    Route::get('index', 'HomeController@index')->name('index');

    // Products
    Route::get('products', 'ProductController@index')->name('products.index');//->middleware('permission:index');
    Route::get('product/create', 'ProductController@create')->name('product.create');//->middleware('permission:create');
    Route::post('product/store', 'ProductController@store')->name('product.store');//->middleware('permission:store');
    Route::get('product/{role}', 'ProductController@show')->name('product.show');//->middleware('permission:show');
    Route::get('product/{role}/edit', 'ProductController@edit')->name('product.edit');//->middleware('permission:edit');
    Route::put('product/{role}', 'ProductController@update')->name('product.update');//->middleware('permission:update');
    Route::delete('product/{role}', 'ProductController@destroy')->name('product.destroy');//->middleware('permission:destroy');
    // Category
//    Route::post('search/category', 'HomeController@searchCategory')->name('search.category');
    // Favorites
    Route::get('favorites', 'FavoriteController@index')->name('favorites.index');//->middleware('permission:index');
    Route::post('favorite/store', 'FavoriteController@store')->name('favorite.store');//->middleware('permission:store');
    // Matches
    Route::get('matches', 'MatchController@index')->name('matches.index');//->middleware('permission:index');
    Route::get('match/{role}', 'MatchController@show')->name('match.show');//->middleware('permission:show');
	Route::post('match/confirm/{role}', 'MatchController@confirm')->name('match.confirm');//->middleware('permission:show');
    // Favorites
    Route::post('match/store', 'FavoriteController@storeHome')->name('favorite_home.store');//->middleware('permission:store');

    //user profile
    Route::get('users', 'UserController@index')->name('user.index');
    //Route::get('user/create', 'UserController@create')->name('user.create');
    //Route::post('user/store', 'UserController@store')->name('user.store');
    Route::get('user/show/{id?}', 'UserController@show')->name('user.show');
    Route::delete('user/delete/{id}', 'UserController@destroy')->name('user.destroy');//->middleware('permission:destroy');
    Route::get('user/edit/{id?}', 'UserController@edit')->name('user.edit');//->middleware('permission:store');
    Route::post('user/update/{id?}', 'UserController@update')->name('user.update');//->middleware('permission:store');
});
