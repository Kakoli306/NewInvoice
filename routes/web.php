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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('customers','CustomerController');

Route::get('/product', 'ProductController@index');
Route::get('product/{product_id?}', 'ProductController@show');
Route::post('product', 'ProductController@store');
Route::put('product/{product_id}', 'ProductController@update');
Route::delete('product/{product_id}', 'ProductController@destroy');

Route::get('/sale', 'HomeController@sale');
Route::post('/sale/add','HomeController@add');

Route::get('/cash', 'CashController@index');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'CashController@index'));
Route::post('cash', 'CashController@store');

Route::get('/user', 'HomeController@user');

