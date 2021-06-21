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

/**
 * 管理者権限にてアクセス可能なページ
 */

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });
    });
Route::group(['middleware' => ['auth', 'can:admin']], function () {
	Route::get('/admin', 'AdminController@showUserList');
    Route::get('/admin/{id}', 'AdminController@showDetail');
});

    // Route::get('/admin', 'AdminController@showUserList')->name('admin');


Auth::routes();



// Route::get('/home', 'HomeController@index')->name('home');




