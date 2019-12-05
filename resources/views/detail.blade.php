<!doctype html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    </head>

    <body>
    
        <!-- ヘッダ -->
         <div class="navbar navbar-dark shadow-sm" style="background-color: #46a032;">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex">
                    <h2><strong>E I M S </strong></h2>
                </a>
            </div>
        </div>

        <!-- アイテム詳細表示 -->
        <div class="container">
            <h1 class="text-center">アイテム詳細</h1>
            <div class="row form-group">
                <input type="hidden" id="id" value="{{$item['id']}}">
                <div class="col-md-3">カテゴリ</div>
                <div class="col-md-9">
                    <select class="form-control" id="category">
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
                <div class="col-md-9"><input type="date" class="form-control" id="purchase" value="{{$item['purchase']}}"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">使用期限</div>
                <div class="col-md-9"><input type="date" class="form-control" id="limit" value="{{$item['limit']}}"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">数量</div>
                <div class="col-md-9"><input type="number" class="form-control" id="quantity" value="{{$item['quantity']}}"></div>
            </div>

            <div class="row">
                <button id="updatebutton" class="btn btn-primary">　更新　</button>
                <button id="deletebutton" class="btn btn-danger">　削除　</button>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script type="text/javascript">

            // 画面読み込み
            $(document).ready(function(){
                $("#category").val("{{$item['category']}}");
            });

            // 更新ボタンクリック
            $('#updatebutton').on('click',function(){
                $.ajax({
                    url:window.location.href+'/update',
                    type:'POST',
                    data:{
                        id : $('#id').val(),
                        category : $('#category').val(),
                        name : $('#name').val(),
                        purchase : $('#purchase').val(),
                        limit : $('#limit').val(),
                        quantity : $('#quantity').val(),
                    }
                }).done( (data) => {
                    window.location.href = '/eims/list/0';
                }).fail( (data) => {
                    alert("更新できませんでした。");
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
                    alert("削除できませんでした。");
                });
            });

        </script>
    
    </body>
</html>
