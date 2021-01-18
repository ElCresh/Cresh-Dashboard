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

Route::view('/','home')->name('home');
Route::get('/ups', '\App\Http\Controllers\UpsController@list')->name('ups.list');
Route::get('/ups/{id}', '\App\Http\Controllers\UpsController@history')->name('ups.history');