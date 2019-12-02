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

        $itemList['items'] = DB::table('item')
        ->skip($skip)
        ->take(10)
        ->orderBy('create_datetime', 'desc')
        ->select('id', 'name', 'category_id', 'purchase_date', 'limit_date', 'deleted','quantity')
        ->get();

        \Debugbar::info(json_encode($itemList));

        return view('list', $itemList);

    }

}
