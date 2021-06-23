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
    //トップ画面を表示
    Route::get('/', function () {
        return view('home');
    });
    });
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    //管理者トップ画面を表示
	Route::get('/admin', 'AdminController@showUserList')->name('admin');
    //ユーザー詳細を表示
    Route::get('/admin/{id}', 'AdminController@showDetail')->name('detail');
    //ユーザー編集画面を表示
    Route::get('/admin/edit/{id}', 'AdminController@showEdit')->name('edit');
    //ユーザー編集
    Route::post('/admin/update', 'AdminController@exeUpdate')->name('update');
});

    // Route::get('/admin', 'AdminController@showUserList')->name('admin');


Auth::routes();



// Route::get('/home', 'HomeController@index')->name('home');




