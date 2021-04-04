<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderCart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function ordercardProduct()
    {
        $products = orderCart::all();
        if((sizeof($products)<=0))
            return;

        $products[0]['totalPrice'] = 0;
        for($i=0;$i<sizeof($products);$i++)
        {
            $products[$i]['product_detail'] = Product::find( $products[$i]['product_id']);
            $products[0]['totalPrice'] = $products[0]['totalPrice'] + $products[$i]->inPrice*$products[$i]->quantity;
        }
        return $products;
    }

}
