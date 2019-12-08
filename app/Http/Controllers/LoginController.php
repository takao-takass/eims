<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * 認証API
     */
    public function auth(Request $request)
    {
        // リクエストパラメータを取得
        $email = $request['email'];
        $password = $request['password'];

        // メールアドレスとパスワードを用いた認証
        $isAuthError = false;
        if($email == null || $password == null){
            $isAuthError = true;
        }

        // レスポンスの作成
        $response = response('',200);
        if($isAuthError){
            $response = response(json_encode(['message'=>'auth error']),401);
        }

        return $response;
    }

}
