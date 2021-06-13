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
Route::group(['middleware' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin');
    });

});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/home', 'HomeController@index')->name('home');




