@extends('layout')
@section('title','商品一覧')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>商品情報</h2>
            @if (session(''))<p class="text-danger">
                {{session('err_msg')}}
            </p>
            @endif
            <table class="table table-striped">
                <tr>
                    <th>id</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th>詳細表示</th>
                    <th>削除</th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->img_path }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_id }}</td>
                    <td><a href="/adm/public/product/{{ $product->id }}">詳細</a></td>
                    <td></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection