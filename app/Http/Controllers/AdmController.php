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

    public function search(Request $request)
    {
        $product = new Product();
        $products = Product::all();
        $posts = $product->search($request, $product);
        return view('adm.list', ['products' => $posts, 'categories' => $products]);
    }
    public function productSearch($searchId)
    {
        $products = Product::all();
        $posts = $products->where('product_name', 'LIKE', '%' . $searchId . '%');
        return response()->json($posts);
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


    public function exeDelete($id)
    {
        $product = new Product();
        $flashMessage = $product->productDelete($id);
        return redirect()->route('products')->with('message', $flashMessage);
    }
}
