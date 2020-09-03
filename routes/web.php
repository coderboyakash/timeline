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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'UsersController@index')->name('home');

Route::resource('user', 'UsersController');
Route::resource('user/post', 'PostsController');
Route::resource('user/friendrequest', 'FriendRequestsController');
Route::get('user/{user}', 'UsersController@show')->name('profile');
Route::get('search', 'SearchController@search')->name('search');
