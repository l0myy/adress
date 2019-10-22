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

//Auth::routes();

Route::get('address/home', 'HomeController@index')->name('home');

Route::get('address/show','AddressController@show')->name('address.show');
Route::post('address/newLogin/{id}','AddressController@newLogin')->name('address.newLogin');


// Authentication Routes...
$this->get('address/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('address/login', 'Auth\LoginController@login');
$this->post('address/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('address/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('address/register', 'Auth\RegisterController@register');
