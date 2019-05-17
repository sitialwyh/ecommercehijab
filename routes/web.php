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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/images/{filename}');

// Admin Routes
Route::name('admin.')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('products', 'Admin\ProductController');
        Route::resource('orders', 'Admin\OrderController');
    });
});

Route::get('product', 'PublicController@index')->name('public');
Route::get('lihat/{siti}', 'PublicController@show')->name('products.show');
Route::get('/products/image/{imageName}', 'PublicController@image')->name('products.image');


// halaman keranjang
Route::get('/carts', 'CartController@index')->name('carts.index');
Route::get('/carts/add/{id}', 'CartController@add')->name('carts.add');
Route::patch('/carts/update', 'CartController@update')->name('carts.update');
Route::delete('/carts/remove', 'CartController@remove')->name('carts.remove');

//order
Route::post('/posts', 'PublicController@store')->name('posts.review');