<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Item;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $queryResults = DB::table('item')
            ->where('id', $id)
            ->select('id', 'name', 'category_id', 'purchase_date', 'limit_date', 'deleted')
            ->get();

        $item = [];
        foreach ($queryResults as $result)
        {
            $item = [
                'id' => $result->id,
                'name' => $result->name,
                'category' => $result->category_id,
                'purchase' => $result->purchase_date,
                'limit' => $result->limit_date,
                'deleted' => $result->deleted
            ];
        }

        return view('detail', $item);
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

        // アイテム情報のチェック
        $isBadParam = false;
        if($this->checkItemUpdateParam($item,$id))
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
        if($this->checkItemDeleteParam($item,$id)){
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
    private function checkItemUpdateParam(Item $item, $id){

        $result = false;

        if($item->name == null ||
            $item->categoryId == null ||
            $item->purchaseDate == null ||
            $item->limitDate == null){
                $result = true;
        }
        else if ($item->id != $id)
        {
            $result = true;
        }

        return $result;

    }

    /**
     * 削除時のアイテム情報のチェック
     */
    private function checkItemDeleteParam(Item $item, $id){

        $result = false;

        if ($item->id != $id)
        {
            $result = true;
        }

        return $result;

    }

}
