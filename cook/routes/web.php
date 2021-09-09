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






Auth::routes();

Route::get('/auth/{service}', 'OAuthLoginController@getGoogleAuth')->where('service', 'google');
Route::get('/auth/callback/google', 'OAuthLoginController@authGoogleCallback');

Route::group(['middleware' => 'auth'], function () {
    
    // ユーザートップ
    Route::get('/', 'AdminController@recipeSearch')->name('search');
    //レシピ検索
    Route::get('/recipe_search', 'AdminController@recipe_search')->name('recipe_search'); 
    //レシピ詳細
    Route::get('/recipe_search/recipe_Detail/{id}', 'AdminController@recipe_Detail')->name('recipe_Detail'); 
    // お気に入り機能
    Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);
    // マイページ
    Route::get('/mypage', 'AdminController@mypage')->name('mypage');
    // ユーザー編集画面表示
    Route::get('/mypage/edit/{id}', 'AdminController@user_showEdit')->name('user_showEdit');
     //ユーザー編集
    Route::post('/mypage/update', 'AdminController@user_exeUpdate')->name('user_exeUpdate');

});







  

/**
 * 管理者権限にてアクセス可能なページ
 */
    
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    
    //管理者トップ画面を表示
	Route::get('/admin', 'AdminController@showUserList')->name('admin');
    //レシピ登録画面
    Route::get('/admin/create', 'AdminController@create')->name('create');
    //レシピ登録
    Route::post('/admin/store', 'AdminController@store')->name('store'); 
    //レシピ検索
    Route::get('/admin/recipe_list', 'AdminController@recipe_list')->name('recipe_list'); 
    //ユーザー詳細を表示
    Route::get('/admin/{id}', 'AdminController@showDetail')->name('detail');
    //ユーザー編集画面を表示
    Route::get('/admin/edit/{id}', 'AdminController@showEdit')->name('edit');
    //ユーザー編集
    Route::post('/admin/update', 'AdminController@exeUpdate')->name('update');
    //レシピ詳細を表示
    Route::get('/admin/recipe_list/{id}', 'AdminController@recipe_showDetail')->name('recipe_detail');
    //レシピ編集画面を表示
    Route::get('/admin/recipe_list/recipe_edit/{id}', 'AdminController@recipe_showEdit')->name('recipe_edit');
    //レシピ編集
    Route::post('/admin/recipe_list/recipe_update', 'AdminController@recipe_exeUpdate')->name('recipe_update');
    //レシピ削除
    Route::post('/admin/recipe_list/delete/{id}/', 'AdminController@exeDelete')->name('delete');
});




   










