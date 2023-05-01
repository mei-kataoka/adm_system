@extends('layouts.listHeader')
@section('title','商品詳細')
@section('content')

<br>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h2>{{ $product -> product_name}}</h2>
      <span>作成日{{ $product ->created_at}}</span>
      <span>更新日{{ $product ->updated_at}}</span>




      <table class="table table-striped">
        <tr>
          <th>商品情報ID</th>
          <th>商品画像</th>
          <th>商品名</th>
          <th>メーカー名</th>
          <th>価格</th>
          <th>在庫数</th>
          <th>コメント</th>
          <th>編集</th>
        </tr>

        <tr>
          <td>{{ $product->id }}</td>
          <td><img src="{{asset('storage/'.$product->img_path)}}" alt="商品画像" style=" max-width: 100%;"></td>
          <td>{{ $product->product_name }}</td>
          <td>{{ $product->company_id}}</td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->stock }}</td>
          <td>{{ $product->comment}}</td>
          <td><button type="button" class="btn btn-primary" onclick="location.href='/adm/public/product/edit/{{ $product->id }}'">編集</button></td>

        </tr>
      </table>

    </div>
  </div>
</div>
@endsection