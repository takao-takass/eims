<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Item;
use Carbon\Carbon;
use App\Exceptions\ParamInvalidException;

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
            ->where('deleted', 0)
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
        $item->categoryId = $request['categoryId'];
        $item->purchaseDate = $request['purchaseDate'];
        $item->limitDate = $request['limitDate'];
        $item->quantity = $request['quantity'];

        // アイテム情報のチェック
        $this->checkParam($item);
        if ($item->id != $id)
        {
            throw new ParamInvalidException(
                '更新するアイテム情報が一致しません。再読み込みしてください。',
                ['id']
            );
        }

        // itemテーブルを更新
        DB::table('item')
            ->where('id', $item->id)
            ->update([
                'name' => $item->name,
                'category_id'=> $item->categoryId,
                'purchase_date' => $item->purchaseDate,
                'limit_date' => $item->limitDate,
                'quantity' => $item->quantity,
                'update_datetime' => Carbon::now('Asia/Tokyo'),
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
        if ($item->id != $id)
        {
            throw new ParamInvalidException(
                '更新するアイテム情報が一致しません。再読み込みしてください。',
                ['id']
            );
        }

        // itemテーブルに登録
        DB::table('item')
        ->where('id', $item->id)
        ->update([
            'deleted' => 1,
            'update_datetime' => Carbon::now('Asia/Tokyo'),
        ]);

        return response('',200);
    } 

    /**
     * 更新時のアイテム情報のチェック
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
