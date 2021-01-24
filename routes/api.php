<?php

use Illuminate\Support\Facades\Route;


Route::post('/register', 'userController@register');
Route::post('/login', 'userController@login');
Route::middleware('auth:api')->get('/user', 'userController@show');

Route::get('/airport', 'AirportController@index');
Route::get('/flight', 'AirportController@flights');

Route::post('/booking', 'bookingController@store');
Route::get('/booking/{code}', 'bookingController@show');
Route::get('/booking/{code}/seat', 'bookingController@seats');
Route::patch('/booking/{code}/seat', 'bookingController@editSeat');
Route::get('/booking', 'bookingController@index');
