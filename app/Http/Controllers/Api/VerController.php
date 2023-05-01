<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Ver;

class VerController extends Controller
{


    public function index(Request $request)
    {
       try {
            
            $product =Product::find($request->id);
            
            $result = [
                'result'      => true,
                'product_id' => $product->id,
                'product_name'=> $product->product_name,
                'price'=> $product->price,
                'stock'=> $product->stock,
                'comment'=> $product->comment,
                'img_path'=> $product->img_path
            ];
        } catch(\Exception $e){
            $result = [
                'result' => false,
                'error' => [
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        return $this->update($product);
    }

    
    public function update($product){
        
        
        $productStock =$product->stock;
       $sale =Sale::create([
        'product_id' => $product['product_name']
       ]);
        if( $productStock  <= 0){
             
            $productSale = [
                'result' => false,
                'error' => [
                    'messages' => '在庫切れ'
                ]
            ];

        }else{
            $stock = --$productStock;
             $productSale =Product::find($product->id);
             $productSale ->update([
               'stock' =>$stock
             ]);
        }
       
         return response()->json($productSale);
     }

}
