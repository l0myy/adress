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

Route::resource('/address','AddressController');

Route::get('/','AddressController@index')->name('address.index');
/*
Route::get('address/create','AddressController@create')->name('address.create');
Route::get('address/edit/{id}','AddressController@edit')->name('address.edit');
Route::post('address/','AddressController@store')->name('address.store');

Route::patch('address/','AddressController@update')->name('address.update');
Route::delete('address/{id}','AddressController@destroy')->name('address.destroy');

Route::get('address/load','AddressController@load')->name('address.load');
*/


;
