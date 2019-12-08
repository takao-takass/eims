<!doctype html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
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

        <!-- ログインフォーム -->
        <div class="container">
            <h1 class="text-center">EIMSにログイン</h1>
            <div class="row">
                <div class="col-md-3">
                    <label>メールアドレス：</label>
                </div>
                <div class="col-md-9">
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>パスワード：</label>
                </div>
                <div class="col-md-9">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
            </div>
            <div class="row">
                <button id="loginbutton" class="btn btn-primary">ログイン</button>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script type="text/javascript">

            // ログインボタンクリック
            $('#loginbutton').on('click',function(){
                $.ajax({
                    url:window.location.href+'/auth',
                    type:'POST',
                    data:{
                        email : $('#email').val(),
                        password : $('#password').val()
                    }
                })
                .done( (data) => {
                    window.location.href = './list/0';
                })
                .fail( (data) => {
                        resobj = JSON.parse(data.responseText);
                        alert(resobj.message);
                        $.each(resobj.params, function(index, value) {
                            $('#'+value).addClass('input_error');
                        });
                });
            });

        </script>
    </body>
</html>