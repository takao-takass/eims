<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Item;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        // 有効なトークンでない場合はログイン画面へ
        if(!$this->isValidToken()){
            return redirect('eims/login');
        }

        // 要求ページ(文字列)を数値に変換
        $maxRecordByPage = 5;
        $numPage = intval($page);

        // アイテムの総数を取得
        $user = $this->getTokenUser();
        $recordCount = DB::table('item')
        ->where('item.owner', $user->id)
        ->where('item.deleted', 0)
        ->count();

        // 最大ページ数の計算
        // ・要求ページが最大ページを超えていたら、最大ページとする
        // ・要求ページがマイナス値であれば、0ページとする
        $maxPage = floor($recordCount / $maxRecordByPage);
        if( $maxPage < $numPage )
        {
            $numPage = $maxPage;
        }
        else if( $numPage < 0 )
        {
            $numPage = 0;
        }

        // ページングの情報を設定
        // ・現在のページ数
        // ・ページ表示のリスト
        //   表示例：" [←][1][2][3][→] "
        $param['currentPage'] = $numPage;
        $pageList = [];
        if($maxPage < 3)
        {
            for($i=0; $i<=$maxPage; $i++)
            {
                array_push($pageList, $i);
            }
        }
        else if($maxPage == $numPage)
        {
            $pageList = [$numPage-2, $numPage-1, $numPage];
        }
        else if(0 == $numPage)
        {
            $pageList = [$numPage, $numPage+1, $numPage+2];
        }
        else
        {
            $pageList = [$numPage-1, $numPage, $numPage+1];
        }
        $param['pageList'] = $pageList;
        
        // アイテム一覧の取得
        $param['items'] = DB::table('item')
        ->leftJoin('category_master as category', 'item.category_id', '=', 'category.category_id')
        ->where('item.owner', $user->id)
        ->where('item.deleted', 0)
        ->skip($numPage * $maxRecordByPage)
        ->take($maxRecordByPage)
        ->orderBy('item.create_datetime', 'desc')
        ->select('item.id', 'item.name', 'category.category_name', 'item.purchase_date', 'item.limit_date', 'item.deleted','item.quantity')
        ->get();

        // レスポンス
        return response()
        ->view('list', $param)
        ->cookie('sign',$this->updateToken()->signtext,24*60);

    }

}
