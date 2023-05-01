<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //テーブル名
    protected $table = 'sales';
      protected $primaryKey = 'id';



    //可変項目
    protected $fillable  =
    [
        'product_id'
    ];

    public function create($sale,$product){
     $sale->fill([
        'product_id' => $product['product_name']
       ]);
       return $sale;
    }

}
