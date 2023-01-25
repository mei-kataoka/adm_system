@extends('layouts.app')
@section('title', '商品登録')
@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
            @csrf
            <input name="id" class="form-control" value="{{ $product->id}}" type="hidden">
            <div class="form-group">
                <label for="product_name">
                    商品名
                </label>
                <input id="productName" name="product_name" class="form-control" value="{{ $product->product_name }}" type="text">
                @if ($errors->has('product_name'))
                <div class="text-danger">
                    {{ $errors->first('product_name') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="company_id">
                    会社名
                </label>
                <input id="companyId" name="company_id" class="form-control" value="{{ $product->company_id}}" type="text">
                @if ($errors->has('company_id'))
                <div class="text-danger">
                    {{ $errors->first('company_id') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                価格
                </label>
                <input id="price" name="price" class="form-control" value="{{ $product->price}}" type="number">
                @if ($errors->has('price'))
                <div class="text-danger">
                    {{ $errors->first('price') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="stock">
                    在庫数
                </label>
                <input id="stock" name="stock" class="form-control" value="{{ $product->stock}}" type="number">
                @if ($errors->has('stock'))
                <div class="text-danger">
                    {{ $errors->first('stock') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="comment">
                    コメント
                </label>
                <textarea id="comment" name="comment" class="form-control" rows="4" value="{{$product->comment}}">{{$product->comment}}
                </textarea>
                @if ($errors->has('comment'))
                <div class="text-danger">
                    {{ $errors->first('comment') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="img_path">
                    商品画像
                </label>
                <input id="imgPath" name="img_path" class="form-control" value="{{ $product->img_path}}" type="file" enctype=”multipart/form-data”>
                @if ($errors->has('img_path'))
                <div class="itext-danger">
                    {{ $errors->first('img_path') }}
                </div>
                @endif
                <img src="{{asset('storage/'.$product->img_path)}}" alt="商品画像" style=" max-width: 50%;">
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-primary">
                    更新
                </button>
                <a class="btn btn-secondary" href="{{ route('products') }}">
                    戻る
                </a>

            </div>
        </form>
    </div>
</div>

<script>
    function checkSubmit() {
        if (window.confirm('送信してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>

@endsection