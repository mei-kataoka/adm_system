<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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
    public function showList(Request $request)
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
        $products = Product::all();
        $keyword  = $request->input('search');
        $categoryId = $request->input('categoryId');

        $query = Product::query();
        if (isset($keyword)) {
            $query->where('product_name', 'LIKE', "%$keyword%");
        }
        if (isset($categoryId)) {
            $query->where('company_id', $categoryId);
        }

        $posts = $query->orderBy('id', 'asc')->paginate(15);

        return view('adm.list', ['products' => $posts, 'categories' => $products]);
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
        // 商品のデータを受け取る
        $inputs = $request->all();
        $imgSet = $request->img_path;


        \DB::beginTransaction();
        try {
            //画像を保存
            if (is_null($imgSet)) {
                $img = $imgSet;
            } else {
                $imgName = $imgSet->getClientOriginalName();

                $img = $request->img_path->storeAs('/img', $imgName, 'public');
            }
            // 商品を登録
            $product = new Product();
            $product->fill([
                'company_id' => $inputs['company_id'],
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'img_path' => $img
            ]);
            $product->save();


            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを登録しました');
        return redirect(route('products'));
    }

    /*商品編集フォームを表示する
     *  @param int $id
     *  @return view
     */


    public function showEdit($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }

        return view(
            'adm.edit',
            ['product' => $product]
        );
    }
    /**
     * 商品を更新する
     * 
     * @return view
     */
    public function exeUpdate(ProductRequest $request)
    {
        // 商品のデータを受け取る
        $inputs = $request->all();
        $imgSet = $request->img_path;
        //画像を保存
        if (is_null($imgSet)) {
            $img = $imgSet;
        } else {
            $imgName = $imgSet->getClientOriginalName();

            $img = $request->img_path->storeAs('/img', $imgName, 'public');
        }
        \DB::beginTransaction();
        try {
            // 商品を更新
            $product = Product::find($inputs['id']);
            $product->fill([
                'company_id' => $inputs['company_id'],
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'img_path' => $img
            ]);
            $product->save();
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを登録しました');
        return redirect(route('products'));
    }
    /*商品削除
     *  @param int $id
     *  @return view
     */


    public function exeDelete($id)
    {

        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }

        try {
            //商品削除
            Product::destroy($id);
        } catch (\Throwable $e) {
            abort(500);
        }
        \Session::flash('err_msg', '削除しました。');
        return redirect(route('products'));
    }
}
