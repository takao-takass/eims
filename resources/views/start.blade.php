@extends('layout')

@section('content')
        <!-- 登録フォーム -->
        <div class="container">
            <h1 class="text-center">EIMSの利用を始める</h1>
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
                <div class="col-md-3">
                    <label>パスワード（もう一度入力）：</label>
                </div>
                <div class="col-md-9">
                    <input type="password" class="form-control" id="passwordcheck" placeholder="Password">
                </div>
            </div>
            <div class="row">
                <button class="btn btn-primary" onclick="entry()">登録</button>
            </div>
        </div>

@endsection

@section('script')
<script type="text/javascript">

function entry(){
    $.ajax({
        url:window.location.href+'/entry',
        type:'POST',
        data:{
            email : $('#email').val(),
            password : $('#password').val(),
            passwordcheck : $('#passwordcheck').val()
        }
    })
    .done( (data) => {
        window.location.href = './login';
    })
    .fail( (data) => {
            resobj = JSON.parse(data.responseText);
            alert(resobj.message);
            $('.input_error').removeClass('input_error');
            $.each(resobj.params, function(index, value) {
                $('#'+value).addClass('input_error');
            });
    });
}

</script>
@endsection
