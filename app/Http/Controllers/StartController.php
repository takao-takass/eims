<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exceptions\ParamInvalidException;
use App\Models\UserEntry;

class StartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('start');
    }

    /**
     * ユーザー登録
     */
    public function entry(Request $request)
    {
        // 入力情報を取得
        $user = new UserEntry;
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->passwordcheck = $request['passwordcheck'];

        // 入力情報のチェック
        $this->checkParam($user);

        // ユーザーIDの採番
        $dbUserMaster = DB::table('user_master');
        $user->id = sprintf('%08d', $dbUserMaster->count());
        $user->name = substr($user->email, 0, 50);

        // ユーザマスタに登録
        $dbUserMaster->insert(
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'authtext'=> password_hash($user->password, PASSWORD_BCRYPT, ['cost' => 12])
                ]
        );

        return response('',200);
    }

    /**
     * ユーザー登録前のチェック処理
     */
    private function checkParam(UserEntry $user){

        // 更新パラメータにNULLが含まれていればエラー
        $nullKeys = [];
        $itemprops = get_object_vars($user);
        foreach($itemprops as $key => $value){
            if($value == null && in_array($key,UserEntry::$requireProps)){
                $nullKeys[] = $key;
            };
        }
        if(count($nullKeys)>0){
            throw new ParamInvalidException(
                '入力項目は全て入力してください。',
                $nullKeys
            );
        }

        // パスワードが確認用と一致しなければエラー
        if($user->password != $user->passwordcheck){
            throw new ParamInvalidException(
                'パスワードが一致しません。',
                ['password','passwordcheck']
            );
        }

        // メールアドレスが既に登録されている場合はエラー
        $emailCount = DB::table('user_master')
        ->where('email', $user->email)
        ->count();
        if($emailCount>0){
            throw new ParamInvalidException(
                'メールアドレスは既に登録されています。',
                ['email']
            );
        }

    }

}
