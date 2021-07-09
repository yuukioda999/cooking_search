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

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    //トップ画面を表示
    Route::get('/', function () {
        return view('home');
    });
    });
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    
    //管理者トップ画面を表示
	Route::get('/admin', 'AdminController@showUserList')->name('admin');
    //レシピ登録画面
    Route::get('/admin/create', 'AdminController@create')->name('create');
    //レシピ登録
    Route::post('/admin/store', 'AdminController@store')->name('store'); 
    //レシピ検索
    Route::get('/admin/recipe_list', 'AdminController@recipe_list')->name('recipe_list'); 
    //レシピ詳細を表示
    Route::get('/admin/recipe_list/{id}', 'AdminController@recipe_showDetail')->name('recipe_detail');
    //レシピ編集画面を表示
    Route::get('/admin/recipe_list/recipe_edit/{id}', 'AdminController@recipe_showEdit')->name('recipe_edit');
    //レシピ編集
    Route::post('/admin/recipe_list/update', 'AdminController@recipe_exeUpdate')->name('recipe_update');
    

    //ユーザー詳細を表示
    Route::get('/admin/{id}', 'AdminController@showDetail')->name('detail');
    //ユーザー編集画面を表示
    Route::get('/admin/edit/{id}', 'AdminController@showEdit')->name('edit');
    //ユーザー編集
    Route::post('/admin/update', 'AdminController@exeUpdate')->name('update');
    
});

   










