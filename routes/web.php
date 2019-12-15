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

# ユーザ登録画面
Route::get('/eims/start','StartController@index');

# アイテム一覧：画面表示
Route::redirect('/eims/list', '/eims/list/0');
Route::get('/eims/list/{page}','ListController@index')->name('list');

# アイテム登録画面：画面表示
Route::get('/eims/new','NewController@index')->name('new');

# アイテム詳細画面：画面表示
Route::get('/eims/detail/{id}','DetailController@index')->name('detail');
