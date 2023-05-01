<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Config\Message;
use App\Http\Requests\ProductRequest;


class AdmController extends Controller
{

    //ミドルウェアADMコントローラー経由の場合ログイン機能のアクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧を表示する
     * 
     * @return view
     */
    public function showList()
    {
        $products = Product::all();
        return view('adm.list', ['products' => $products, 'categories' => $products]);
    }

    /**
     * 検索フォーム
     * 
     *
     */


    public function indexSearch(Request $request)
    {
        //非同期で動かしたい検索フォーム
        $products = new Product();
        $product = $products->search($request);
        return response()->json($product);
    }
    /*商品詳細を表示する
     *  @param int $id
     *  @return view
     */


    public function showDetail($id)
    {

        $product = new Product();
        $productId = $product->showDetail($id);

        return view('adm.detail', ['product' => $productId]);
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

    /**
     * 商品を登録する
     * 
     * @return view
     */
    public function exeStore(ProductRequest $request)
    {
        $product = new Product();
        $flashMessage = $product->productRegister($request, $product);
        return redirect()->route('products')->with('message', $flashMessage);
    }

    /*商品編集フォームを表示する
     *  @param int $id
     *  @return view
     */


    public function showEdit($id)
    {

        $product = new Product();
        $productId = $product->showEdit($id, $product);
        return view(
            'adm.edit',
            ['product' => $productId]
        );
    }
    /**
     * 商品を更新する
     * 
     * @return view
     */
    public function exeUpdate(ProductRequest $request)
    {

        $product = new Product();
        $productUpdate = $product->productUpdate($request, $product);
        return redirect(route('products'));
    }
    /*商品削除
     *  @param int $id
     *  @return view
     */


    public function exeDelete(Request $request)
    {
        $products = new Product();
        $list = $products->productDelete($request);
        return response()->json($list);
    }
}
