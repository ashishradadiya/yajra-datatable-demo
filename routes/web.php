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

Route::get('/', ['uses'=>'UserController@index']);
Route::get('users', ['uses'=>'UserController@index', 'as'=>'users']);
Route::get('users/{userId}', ['uses'=>'UserController@getUserDetails', 'as'=>'user.details']);
