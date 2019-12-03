<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Item;

class DetailController extends Controller
{
    /**
     * 画面表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // 指定されたIDに紐づくアイテム情報を取得する
        $queryResults = DB::table('item')
            ->where('id', $id)
            ->select('id', 'name', 'category_id', 'purchase_date', 'limit_date', 'deleted','quantity')
            ->get();

        // 取得したアイテム情報をviewに渡す
        $param['item'] = [];
        foreach ($queryResults as $result)
        {
            $param['item'] = [
                'id' => $result->id,
                'name' => $result->name,
                'category' => $result->category_id,
                'purchase' => $result->purchase_date,
                'limit' => $result->limit_date,
                'deleted' => $result->deleted,
                'quantity' => $result->quantity,
            ];
        }

        // カテゴリマスタを取得する
        $param['categories'] = DB::table('category_master')
            ->orderBy('category_id', 'asc')
            ->get();

        \Debugbar::info(json_encode($param));

        return view('detail', $param);
    }

    /**
     * アイテム更新API
     */
    public function update(Request $request, $id)
    {

        // アイテム情報を取得
        $item = new Item;
        $item->id = $request['id'];
        $item->name = $request['name'];
        $item->categoryId = $request['category'];
        $item->purchaseDate = $request['purchase'];
        $item->limitDate = $request['limit'];
        $item->quantity = $request['quantity'];

        // アイテム情報のチェック
        $isBadParam = false;
        if($this->isBadPatamForUpdate($item,$id))
        {
            return response(json_encode(['message'=>'Bad Pamater']),400);
        }

        // アイテムIDの採番
        $dbItemTable = DB::table('item');

        // itemテーブルに登録
        $dbItemTable
            ->where('id', $item->id)
            ->update([
                'name' => $item->name,
                'category_id'=> $item->categoryId,
                'purchase_date' => $item->purchaseDate,
                'limit_date' => $item->limitDate,
                'quantity' => $item->quantity,
            ]);

        return response('',200);
    } 

    /**
     * アイテム削除API
     */
    public function delete(Request $request, $id)
    {

        // アイテム情報を取得
        $item = new Item;
        $item->id = $request['id'];

        // アイテム情報のチェック
        $isBadParam = false;
        if($this->isBadPatamForDelete($item,$id)){
            return response(json_encode(['message'=>'Bad Pamater']),400);
        }

        // アイテムIDの採番
        $dbItemTable = DB::table('item');

        // itemテーブルに登録
        $dbItemTable
            ->where('id', $item->id)
            ->update([
                'deleted' => '1'
            ]);

        return response('',200);
    } 

    /**
     * 更新時のアイテム情報のチェック
     */
    private function isBadPatamForUpdate(Item $item, $id){

        $result = false;

        if($item->name == null ||
           $item->categoryId == null ||
           $item->purchaseDate == null ||
           $item->limitDate == null||
           $item->quantity == null){
            // パラメータにNULLが有ればエラー
            $result = true;
        }
        else if ($item->id != $id)
        {
            // パラメータのIDが改ざんされている場合は
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

    /**
     * 削除時のアイテム情報のチェック
     */
    private function isBadPatamForDelete(Item $item, $id){

        $result = false;

        if ($item->id != $id)
        {
            $result = true;
        }

        return $result;

    }

}
