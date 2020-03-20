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

Route::get('booking', 'BookingController@index');

Route::post('booking-form', 'BookingController@create');

Route::post('/booking-create', 'BookingController@store');

Route::post('bookingcheck', 'MyController@check');

Route::get('session/remove', 'BookingController@deleteSessionData');
