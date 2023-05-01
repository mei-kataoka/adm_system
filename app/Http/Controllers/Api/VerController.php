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

        if( $productStock  <= 0){
             
            $productSale = [
                'result' => false,
                'error' => [
                    'messages' => '在庫切れ'
                ]
            ];

        }else{


             $sale = new Sale();
             $saleCreate = $sale->create($sale,$product);

             $productUpdate = new Product();
             $productSale = $productUpdate -> saleUpdate($productUpdate,$product);

        }
       
         return response()->json($productSale);
     }

}
