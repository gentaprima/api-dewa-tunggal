<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login','AuthController@auth');
Route::post('/create-users','UsersController@store');
Route::get('/get-users/{id}','UsersController@getUsers');
Route::get('/verify-email/{token}','UsersController@verifyEmail');
Route::get('/get-data-users','UsersController@getDataUsers');