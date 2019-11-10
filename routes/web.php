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

Route::get('/', function () {
    return view('welcome');
});

# ログイン画面：画面表示
Route::redirect('/eims', '/eims/login');
Route::get('/eims/login','LoginController@index')->name('login');

# ログイン画面：ログイン処理
Route::post('/eims/login/auth','LoginController@auth');#->name('auth');

# アイテム一覧：画面表示
Route::get('/eims/list/{page}','ListController@index')->name('list');

# アイテム登録画面：画面表示
Route::get('/eims/new','NewController@index')->name('new');

# アイテム登録画面：登録
Route::post('/eims/new/entry','NewController@entry');#->name('entry');

# アイテム詳細画面：画面表示
Route::get('/eims/detail/{id}','DetailController@index')->name('detail');

# アイテム詳細画面：更新
Route::post('/eims/detail/{id}/update','DetailController@update')->name('update');

# アイテム詳細画面：削除
Route::post('/eims/detail/{id}/delete','DetailController@update')->name('delete');