<?php

use Illuminate\Support\Facades\Route;


Route::post('/register', 'userController@register');
Route::post('/login', 'userController@login');
Route::middleware('auth:api')->get('/user', 'userController@show');

Route::get('/airport', 'AirportController@index');
Route::get('/flight', 'AirportController@flights');

Route::post('/booking', 'BookingController@store');
Route::get('/booking/{code}', 'BookingController@show');
Route::get('/booking/{code}/seat', 'BookingController@seats');
Route::patch('/booking/{code}/seat', 'BookingController@editSeat');
Route::get('/booking', 'BookingController@index');
