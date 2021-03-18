<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getCartItems()
    {
        $carts = Cart::all();
        if(sizeof($carts)<=0)
        {
            return ;
        }
        $carts[0]['totalPrice'] = 0;
        for($i=0;$i<sizeof($carts);$i++)
        {
            $carts[$i]['product_detail'] = $carts[$i]->product;
            $carts[0]['totalPrice'] = $carts[0]['totalPrice'] + $carts[$i]->product->outPrice*$carts[$i]->quantity;
        }
        return $carts;
    }





    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
