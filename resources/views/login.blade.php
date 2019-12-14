@extends('layout')

@section('content')
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

@endsection

@section('script')
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
@endsection
