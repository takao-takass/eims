<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Exceptions\ParamInvalidException;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 有効なトークンでない場合はログイン画面へ
        if(!$this->isValidToken()){
            return redirect('eims/login');
        }

        // カテゴリマスタを取得する
        $param['categories'] = DB::table('category_master')
        ->orderBy('category_id', 'asc')
        ->get();

        // レスポンス
        return response()
        ->view('new', $param)
        ->cookie('sign',$this->updateToken()->signtext,24*60);
    }

    /**
     * 新規アイテムの登録
     */
    public function entry(Request $request)
    {
        // 有効なトークンでない場合は認証エラー
        if(!$this->isValidToken()){
            response('Unauthorized ',401);
        }

        // アイテム情報を取得
        $item = new Item;
        $item->name = $request['name'];
        $item->categoryId = $request['categoryId'];
        $item->purchaseDate = $request['purchaseDate'];
        $item->limitDate = $request['limitDate'];
        $item->quantity = $request['quantity'];
        $item->owner = $this->getTokenUser()->id;

        // アイテム情報のチェック
        $this->checkParam($item);

        // 数量を数値に変換
        $item->quantity = intval($item->quantity);

        // アイテムIDの採番
        $dbItemTable = DB::table('item');
        $item->id = sprintf('%012d', $dbItemTable->count());

        // itemテーブルに登録
        $dbItemTable->insert(
                [
                    'id' => $item->id,
                    'name' => $item->name,
                    'category_id'=> $item->categoryId,
                    'purchase_date' => $item->purchaseDate,
                    'limit_date' => $item->limitDate,
                    'quantity' => $item->quantity,
                    'owner' => $item->owner,
                ]
        );

        // レスポンス
        return response('',200)
        ->cookie('sign',$this->updateToken()->signtext,24*60);
    }

    /**
     * アイテム情報のチェック
     */
    private function checkParam(Item $item){

        // 更新パラメータにNULLが含まれていればエラー
        $nullKeys = [];
        $itemprops = get_object_vars($item);
        foreach($itemprops as $key => $value){
            if($value == null && in_array($key,Item::$requireProps)){
                $nullKeys[] = $key;
            };
        }
        if(count($nullKeys)>0){
            throw new ParamInvalidException(
                'アイテム情報を全て入力してください。',
                $nullKeys
            );
        }
        
        // 数量が数値でない場合はエラー
        if(!is_numeric($item->quantity))
        {
            throw new ParamInvalidException(
                '数量は半角数字を入力してください。',
                ['quantity']
            );
        }

        // 数量がマイナスの場合はエラー
        if(intval($item->quantity) < 0)
        {
            throw new ParamInvalidException(
                '数量は0以上の数字を入力してください。',
                ['quantity']
            );
        }
    }

}
