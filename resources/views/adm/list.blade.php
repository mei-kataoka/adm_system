@extends('layouts.listHeader')
@section('title','商品一覧')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">

            <h2>商品情報</h2>
            <div class="alert">
                @if (session('message'))
                <div class="alertMessage" style="color:red; ">
                    {{ session('message') }}
                </div>
                @endif
            </div>

            <form class="form-inline my-2 my-lg-0 ml-2" action="{{route('search')}}">
                <div class="form-group">
                    <input type="search" class="form-control mr-sm-2" name="search" value="{{request('$keyword')}}" placeholder="キーワードを入力" aria-label="検索...">
                </div>

                <!--プルダウンカテゴリ選択-->
                <div class="form-group">
                    <label>{{ __('メーカー名') }}</label>
                    <select name="categoryId" class="form-control" value="{{request('categoryId')}}">
                        <option value="">未選択</option>
                        @foreach ($categories as $category )
                        <option value="{{ $category->company_id }}">{{ $category->company_id }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="検索" class="btn btn-info">

            </form>

            <table class="table table-striped">
                <tr>
                    <th>id</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th>詳細表示</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{asset('storage/'.$product->img_path)}}" style=" max-width: 100%;" alt=""></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_id }}</td>
                    <td><a href="/adm/public/product/{{ $product->id }}">詳細</a></td>
                    <td><button type="button" class="btn btn-primary" onclick="location.href='/adm/public/product/edit/{{ $product->id }}'">編集</button></td>
                    <form method="POST" action="{{ route('delete',$product->id) }}" onSubmit="return checkDelete()" enctype="multipart/form-data">
                        @csrf
                        <td><button type="submit" class="btn btn-primary" onclick="">削除</button></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<script>
    function checkDelete() {

        if (window.confirm('削除してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection