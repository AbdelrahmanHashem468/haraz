<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\orderCart;
use App\Models\Product;
use App\Models\Client;
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
        $clients  = Client::all(); 
        if((sizeof($products)<=0))
            $products = null;
        foreach($products as $product)
        {
            $product['product_detail'] = Product::find($product['product_id']);
        }
        return view('client.ordercart',compact('products','clients'));
    }

    public function updateinprice(Request $request)
    {
        $fetchedData = $request->all();
        orderCart::where('product_id',$fetchedData['id'])->update([
                'inPrice'=>$fetchedData['inprice']
                ]);
            return json_encode( $fetchedData);
    }

    public function updateoutprice(Request $request)
    {
        $fetchedData = $request->all();
        orderCart::where('product_id',$fetchedData['id'])->update([
                'outPrice'=>$fetchedData['outprice']
                ]);
            return json_encode( $fetchedData);
    }

    public function updatequantity(Request $request)
    {
        $fetchedData = $request->all();
        orderCart::where('product_id',$fetchedData['id'])->update([
                'quantity'=>$fetchedData['quantity']
                ]);
            return json_encode( $fetchedData);
    }

    public function deletefromordercart($id)
    {
        DB::table('order_carts')->where('product_id', $id)->delete();
        return Redirect::back();
    }

}
