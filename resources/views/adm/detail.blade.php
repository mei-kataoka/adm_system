@extends('layout')
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
          <td>{{ $product->img_path }}</td>
          <td>{{ $product->product_name }}</td>
          <td>{{ $product->company_id}}</td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->stock }}</td>
          <td>{{ $product->comment}}</td>
          <td>編集</td>

        </tr>
      </table>

    </div>
  </div>
</div>
@endsection