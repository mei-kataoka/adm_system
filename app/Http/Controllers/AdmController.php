<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class AdmController extends Controller
{

    /**
     * 商品一覧を表示する
     * 
     * @return view
     */
    public function showList()
    {
        $products = Product::all();

        return view('adm.list', ['products' => $products]);
    }

    /**
     * 商品登録画面を表示する
     * 
     * @return view
     */
    public function showCreate()
    {
        return view('adm.form');
    }


    /*商品詳細を表示する
     *  @param int $id
     *  @return view
     */


    public function showDetail($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }

        return view(
            'adm.detail',
            ['product' => $product]
        );
    }
    /**
     * 商品を登録する
     * 
     * @return view
     */
    public function exeStore(ProductRequest $request)
    {
        // 商品のデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            // 商品を登録
            Adm::create($inputs);
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを登録しました');
        return redirect(route('products'));
    }
}
