<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Message;

class Product extends Model
{
    //テーブル名
    protected $table = 'products';

    protected $primaryKey = 'id';


    //可変項目
    protected $fillable  =
    [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path'
    ];
    /**
     * 商品を登録する
     * 
     * 
     */
    function productRegister($request, $product)
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

            $product->fill([
                'company_id' => $inputs['company_id'],
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'img_path' => $img
            ]);
            $product->save();

            $flashMessage = config('message.registerTrueMessage');
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            $flashMessage = config('message.deleteFalseMessage');
        }
        return $flashMessage;
    }
    /**
     * 検索フォーム
     * 
     *
     */
    public function search($request)
    {

        $keywords = $request->keywordId;
        $category = $request->categoryId;
        $stockUp = $request->stockUp;
        $stockDawn = $request->stockDawn;

        $query = Product::query();
        if (isset($keywords)) {
            $query->where('product_name', 'LIKE', '%' . $keywords . '%')->get();
        }
        if (isset($category)) {
            $query->where('company_id', $category)->get();
        }
        if (isset($stockUp)) {
            $query->where('price', '<', $stockUp)->get();
        }
        if (isset($stockDawn)) {
            $query->where('price', '>=', $stockDawn)->get();
        }
        $posts = $query->get();
        return $posts;
    }
    /*
     *商品詳細を表示する
     *  
    */


    public function showDetail($id)
    {
        $productId = Product::find($id);

        if (is_null($productId)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }

        return $productId;
    }
    /*商品編集フォームを表示する
     */

    public function showEdit($id)
    {
        $productId = Product::find($id);

        if (is_null($productId)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('products'));
        }

        return  $productId;
    }

    /**
     * 商品を更新する
     * 
     */
    public function productUpdate($request, $product)
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
    }


    /*商品削除
     *  @param int $id
     *  @return view
     */


    public function productDelete($request)
    {
        $id = $request->id;
        if (empty($id)) {
            return redirect(route('products'));
        }
        $flashMessage = config('message.deleteTrueMessage');

        try {
            //商品削除
            Product::destroy($id);
        } catch (\Throwable $e) {
            abort(500);
        }

        //\Session::flash($flashMessage);
        return  $flashMessage;
    }
    /*プルダウンメニュー
     *  
     *  
     */
    public static function selectlist()
    {
        $products = Product::all();
        $list = array();
        $list += array("" => "選択してください"); //selectlistの先頭を空に
        foreach ($products as $product) {
            $list += array($product->company_id => $product->company_id);
        }
        return $list;
    }
    /*
     *購入処理  
     *  
     */
     public static function saleUpdate($productUpdate,$product)
    {
             $productStock =$product->stock;
             $stock = --$productStock;
             $productUpdate =Product::find($product->id);
             $productUpdate->update([
               'stock' =>$stock
             ]);


        return $productUpdate;
    }
}
