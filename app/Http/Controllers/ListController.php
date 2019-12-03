<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Item;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        // ページング:skipの計算
        $skip = intval($page) * 10;

        // アイテム一覧の取得
        $param['items'] = DB::table('item')
        ->leftJoin('category_master as category', 'item.category_id', '=', 'category.category_id')
        ->skip($skip)
        ->take(10)
        ->orderBy('item.create_datetime', 'desc')
        ->select('item.id', 'item.name', 'category.category_name', 'item.purchase_date', 'item.limit_date', 'item.deleted','item.quantity')
        ->get();

        \Debugbar::info(json_encode($param));

        return view('list', $param);

    }

}
