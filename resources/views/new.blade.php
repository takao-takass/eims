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

        <!-- アイテム登録表示 -->
        <div class="container">
            <h1 class="text-center">アイテム追加</h1>
            <div class="row form-group">
                <div class="col-md-3">カテゴリ</div>
                <div class="col-md-9">
                    <select class="form-control" id="">
                        <option>食品</option>
                        <option>飲料</option>
                        <option>乾電池</option>
                        <option>モバイルバッテリ</option>
                        <option>非常トイレ</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">アイテム名</div>
                <div class="col-md-9"><input type="text" class="form-control" id="" value="非常用品ｘｘｘｘｘｘｘｘｘｘｘ"></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">購入日</div>
                <div class="col-md-9"><input type="date" class="form-control" id=""></div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">使用期限</div>
                <div class="col-md-9"><input type="date" class="form-control" id=""></div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-primary">　登録　</button>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
