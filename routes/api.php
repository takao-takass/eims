<?php

use Illuminate\Http\Request;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

# ログイン画面：認証API
Route::post('/eims/login/auth','LoginController@auth');

# アイテム登録画面：登録
Route::post('/eims/new/entry','NewController@entry');

# アイテム詳細画面：更新
Route::post('/eims/detail/{id}/update','DetailController@update');

# アイテム詳細画面：削除
Route::post('/eims/detail/{id}/delete','DetailController@delete');