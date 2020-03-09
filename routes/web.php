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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('clients', 'ClientController')->middleware('auth');
Route::resource('competitors', 'CompetitorController')->middleware('auth');
Route::resource('events', 'EventController')->middleware('auth');
Route::resource('bets', 'BetController')->middleware('auth');
