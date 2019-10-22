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

Route::resource('address/address','AddressController');

Route::get('address/','AddressController@index')->name('address.index');

Auth::routes();

Route::get('address/home', 'HomeController@index')->name('home');

Route::get('address/show','AddressController@show')->name('address.show');
Route::post('address/newLogin/{id}','AddressController@newLogin')->name('address.newLogin');
