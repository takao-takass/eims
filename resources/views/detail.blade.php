@extends('layout')

@section('content')
        <!-- アイテム詳細表示 -->
        <div class="container">
            <h1 class="text-center">アイテム詳細</h1>
            <div class="row form-group">
                <input type="hidden" id="id" value="{{$item['id']}}">
                <div class="col-md-3">カテゴリ</div>
                <div class="col-md-9">
                    <select class="form-control" id="categoryId">
                    @foreach($categories as $category)
                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">アイテム名</div>
                <div class="col-md-9"><input type="text" class="form-control" id="name" value="{{$item['name']}}"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">購入日</div>
                <div class="col-md-9"><input type="date" class="form-control" id="purchaseDate" value="{{$item['purchase']}}"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">使用期限</div>
                <div class="col-md-9"><input type="date" class="form-control" id="limitDate" value="{{$item['limit']}}"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">数量</div>
                <div class="col-md-9"><input type="number" class="form-control" id="quantity" value="{{$item['quantity']}}"></div>
            </div>

            <div class="row">
                <button id="updatebutton" class="btn btn-primary">　更新　</button>
                <button id="deletebutton" class="btn btn-danger">　削除　</button>
            </div>

            <!-- 点検入力 -->
            <h2 class="text-center">点検結果の入力</h2>
            <div class="row form-group">
                <div class="col-md-3">点検実施日</div>
                <div class="col-md-9"><input type="date" class="form-control" id="inspectDate" value=""></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">コメント</div>
                <div class="col-md-9"><input type="text" class="form-control" id="comment" value=""></div>
            </div>
            <div class="row">
                <button id="inspectbutton" class="btn btn-primary">　点検登録　</button>
            </div>
            <div class="row justify-content-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">実施日</th>
                            <th scope="col">コメント</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inspects as $inspect)
                        <tr>
                            <td>{{$inspect->inspect_date}}</td>
                            <td>{{$inspect->comment}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@section('script')
<script type="text/javascript">

// 画面読み込み
$(document).ready(function(){
    $("#categoryId").val("{{$item['category']}}");
});

// 更新ボタンクリック
$('#updatebutton').on('click',function(){
    $.ajax({
        url:window.location.href+'/update',
        type:'POST',
        data:{
            id : $('#id').val(),
            categoryId : $('#categoryId').val(),
            name : $('#name').val(),
            purchaseDate : $('#purchaseDate').val(),
            limitDate : $('#limitDate').val(),
            quantity : $('#quantity').val(),
        }
    }).done( (data) => {
        window.location.href = '/eims/list/0';
    }).fail( (data) => {
        resobj = JSON.parse(data.responseText);
            alert(resobj.message);
            $.each(resobj.params, function(index, value) {
                $('#'+value).addClass('input_error');
            });
    });
});

// 削除ボタンクリック
$('#deletebutton').on('click',function(){
    $.ajax({
        url:window.location.href+'/delete',
        type:'POST',
        data:{
            id : $('#id').val(),
        }
    }).done( (data) => {
        window.location.href = '/eims/list/0';
    }).fail( (data) => {
        resobj = JSON.parse(data.responseText);
            alert(resobj.message);
            $.each(resobj.params, function(index, value) {
                $('#'+value).addClass('input_error');
            });
    });
});

// 点検登録ボタンクリック
$('#inspectbutton').on('click',function(){
    $.ajax({
        url:window.location.href+'/inspect',
        type:'POST',
        data:{
            id : $('#id').val(),
            inspectDate : $('#inspectDate').val(),
            comment : $('#comment').val(),
        }
    }).done( (data) => {
        location.reload();
    }).fail( (data) => {
        resobj = JSON.parse(data.responseText);
            alert(resobj.message);
            $.each(resobj.params, function(index, value) {
                $('#'+value).addClass('input_error');
            });
    });
});

</script>
@endsection
