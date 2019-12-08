<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Exceptions;

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
        if($email == null || $password == null){
            abort(401,'Auth Error.');
        }
        if($email == 'a'){
            throw new ParamInvalidException('だめです');
        }

        return response('',200);;
    }

}
