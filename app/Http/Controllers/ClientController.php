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
        $products = orderCart::ordercardProduct();
        $clients  = Client::all(); 
        return view('client.ordercart',compact('products','clients'));
    }

    public function updateinprice(Request $request)
    {
        $fetchedData = $request->all();
        if($fetchedData['inprice']>0)
        {
        orderCart::where('product_id',$fetchedData['id'])->update([
                'inPrice'=>$fetchedData['inprice']
                ]);
            return json_encode( $fetchedData);
        }
        else
        {
            return json_encode( ['errors'  =>'أدخل سعر الشراء بطريقة صحيحه']);
        }
    }

    public function updateoutprice(Request $request)
    {
        $fetchedData = $request->all();
        if($fetchedData['outprice']>0)
        {
        orderCart::where('product_id',$fetchedData['id'])->update([
                'outPrice'=>$fetchedData['outprice']
                ]);
            return json_encode( $fetchedData);
        }
        else
        {
            return json_encode( ['errors'  =>'أدخل سعر البيع بطريقة صحيحه']);
        }
    }

    public function updatequantity(Request $request)
    {
        $fetchedData = $request->all();
        if($fetchedData['quantity']>0)
        {
        orderCart::where('product_id',$fetchedData['id'])->update([
                'quantity'=>$fetchedData['quantity']
                ]);
            return json_encode( $fetchedData);
        }
        else
        {
            return json_encode( ['errors'  =>'أدخل الكمية بطريقة صحيحه']);
        }
    }

    public function deletefromordercart($id)
    {
        DB::table('order_carts')->where('product_id', $id)->delete();
        return Redirect::back();
    }

    public function showorder($id)
    {
        if($id==null||$id=='undefined')
            return Redirect::back()->with('danger', 'أختر المورد');
        $nullvalue = DB::table('order_carts')->whereNull('inprice')
        ->orwhereNull('outPrice')->orwhereNull('quantity')->get();
        if((sizeof($nullvalue)!=0))
            return Redirect::back()->with('danger', 'ادخل سعر الشراء و سعر البيع والكمية جيدا');
        $products = orderCart::ordercardProduct();
        $client  = Client::find($id); 
        return view('client.order',compact('products','client'));
    }

}
