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

/*Route::get('/', function () {
    return view('welcome');
});*/

// set login as home page
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('auth.login');
   });
});

// resource route
Route::resource('/contact', 'ContactController');

// named routes
Route::post('/search', 'ContactController@search')->name('search');
Route::post('/sorting', 'ContactController@sorting')->name('sorting');

// auth routes
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
