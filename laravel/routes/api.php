<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'Auth\LoginController@isAuth');
    Route::post('/logout', 'Auth\LoginController@logout');

    //Sections
    Route::get('/sections', 'Section\SectionController@index');
    Route::post('/sections', 'Section\SectionController@store');
    Route::put('/section/{id}', 'Section\SectionController@update');
    Route::delete('/section/{id}', 'Section\SectionController@destroy');

    //Users
    Route::get('/users', 'Users\UsersController@index');
    Route::post('/users', 'Users\UsersController@store');
    Route::put('/user/{id}', 'Users\UsersController@update');
    Route::delete('/user/{id}', 'Users\UsersController@destroy');

});

Route::post('/login', 'Auth\LoginController@login');
Route::post('/login-token', 'Auth\LoginController@loginToken');

Route::post('/register', 'Auth\RegisterController@store');

