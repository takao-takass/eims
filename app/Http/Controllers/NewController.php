<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Item;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('new');
    }

    /**
     * 新規アイテムの登録
     */
    public function entry(Request $request)
    {

        // アイテム情報を取得
        $item = new Item;
        $item->name = $request['name'];
        $item->categoryId = $request['category'];
        $item->purchaseDate = $request['purchase'];
        $item->limitDate = $request['limit'];
        $item->limitDate = $request['limit'];
        $item->quantity = $request['quantity'];

        // アイテム情報のチェック
        $isBadParam = false;
        if($this->isBadParam($item)){
            return response(json_encode(['message'=>'Bad Pamater']),400);
        }

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
            ]
        );

        return response('',200);

    }

    /**
     * アイテム情報のチェック
     */
    private function isBadParam(Item $item){

        $result = false;

        if($item->name == null ||
           $item->categoryId == null ||
           $item->purchaseDate == null ||
           $item->limitDate == null||
           $item->quantity == null){
            // パラメータにNULLが有ればエラー
            $result = true;
        }
        else if(!is_numeric($item->quantity))
        {
            // 数量が数値でない場合はエラー
            $result = true;
        }
        else if(intval($item->quantity) < 0)
        {
            // 数量がマイナスの場合はエラー
            $result = true;
        }

        return $result;

    }


}
