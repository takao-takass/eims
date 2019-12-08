<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exceptions\ParamInvalidException;

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

        // 入力チェック
        if($email == null || $password == null){
            throw new ParamInvalidException(
                'メールアドレスとパスワードを入力してください。',
                ['email','password']
            );
        }

        return response('',200);
    }

}
