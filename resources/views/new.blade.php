@extends('layout')

@section('content')
        <!-- アイテム登録表示 -->
        <div class="container">
            <h1 class="text-center">アイテム追加</h1>
            <div class="row form-group">
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
                <div class="col-md-9"><input type="text" class="form-control" id="name"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">購入日</div>
                <div class="col-md-9"><input type="date" class="form-control" id="purchaseDate"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">使用期限</div>
                <div class="col-md-9"><input type="date" class="form-control" id="limitDate"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">数量</div>
                <div class="col-md-9"><input type="number" class="form-control" id="quantity"></div>
            </div>

            <div class="row">
                <button class="btn btn-primary" id="entrybutton">　登録　</button>
            </div>
        </div>
@endsection

@section('script')
<script type="text/javascript">
            // 登録ボタンクリック
            $('#entrybutton').on('click',function(){
                $.ajax({
                    url:window.location.href+'/entry',
                    type:'POST',
                    data:{
                        categoryId : $('#categoryId').val(),
                        name : $('#name').val(),
                        purchaseDate : $('#purchaseDate').val(),
                        limitDate : $('#limitDate').val(),
                        quantity : $('#quantity').val(),
                    }
                }).done( (data) => {
                    window.location.href = './list/0';
                }).fail( (data) => {
                    resobj = JSON.parse(data.responseText);
                        alert(resobj.message);
                        $('.input_error').removeClass('input_error');
                        $.each(resobj.params, function(index, value) {
                            $('#'+value).addClass('input_error');
                        });
                });
            });
</script>
@endsection
