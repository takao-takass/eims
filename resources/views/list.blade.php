@extends('layout')

@section('content')
        <!-- アイテム一覧 -->
        <div class="container">
            <h1 class="text-center">アイテム一覧</h1>
            <div class="row justify-content-end">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="/eims/list/{{$currentPage-1}}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        @foreach($pageList as $page)
                            @if($page == $currentPage)
                                <li class="page-item active"><a class="page-link" href="/eims/list/{{$page}}">{{$page+1}}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="/eims/list/{{$page}}">{{$page+1}}</a></li>
                            @endif
                        @endforeach
                        <li class="page-item">
                            <a class="page-link" href="/eims/list/{{$currentPage+1}}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row justify-content-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">カテゴリ</th>
                            <th scope="col">アイテム</th>
                            <th scope="col">数量</th>
                            <th scope="col">使用期限</th>
                            <th scope="col">警告</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$item['category_name']}}</td>
                            <td><a href="/eims/detail/{{$item['id']}}">{{$item['name']}}</td>
                            <td>{{$item['quantity']}}</td>
                            <td>{{$item['limit_date']}}</td>
                            <td>{{$item['warning']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <a href="/eims/new"><button class="btn btn-primary">　追加　</button></a>
            </div>
        </div>
@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection
