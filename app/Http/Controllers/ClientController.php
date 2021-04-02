<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\orderCart;
use DB;

class ClientController extends Controller
{
    public function addToOrderCart($id)
    {
        $cart= DB::select("SELECT * FROM order_carts where product_id = $id");
        if($cart!=null)
            return Redirect::back()->with('warning', 'المنتج مضاف الي الطلب');
        else
        {
            orderCart::create([
                'product_id' => $id,
            ]);
        }
        return Redirect::back()->with('success', 'تم اضافة المنتج الي الطلب');
    }


    public function ordercart()
    {
        $products = orderCart::all();
        if((sizeof($products)<=0))
            $products = null;
        return view('client.ordercart',compact('products'));
    }
}
