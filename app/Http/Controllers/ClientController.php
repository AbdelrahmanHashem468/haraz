<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\ProductOrder;
use App\Models\orderCart;
use App\Models\Order;
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

    public function submitclientorder($id)
    {
        $carts =orderCart::ordercardProduct();
        $order = Order::create([
            'client_id' => $id,
            'price'       => $carts[0]['totalPrice']
        ]);
        for ($i=0;$i<sizeof($carts);$i++)
        {
            ProductOrder::create([
                'outPrice'      => $carts[$i]->outPrice,
                'inPrice'      => $carts[$i]->inPrice,
                'quantity'   => $carts[$i]->quantity,
                'product_id' => $carts[$i]->id,
                'order_id' => $order->id
            ]);
            $product = Product::find($carts[$i]->id);
            $product->update([
                'outPrice' => $carts[$i]->outPrice,
                'inPrice' => $carts[$i]->inPrice
            ]);
            $product->increment('store_quan',$carts[$i]->quantity);        }
        orderCart::truncate();
        return redirect('/clients');
    }

    public function show()
    {
        $clients = Client::all();
        return view('client.clients',compact('clients'));
    }

    public function addclient(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $fetchedData = $request->all();

        $client = Client::create([
            'name' => $fetchedData['name'],
            'address' => $fetchedData['address'],
            'phone' => $fetchedData['phone']
        ])->wasRecentlyCreated;

        if($client==1)
            return Redirect::back()->with('success', ' تمت اضافت مورد');
    }

    public function clientorder($id)
    {
        $orders = Order::where('client_id',$id)->get();
        $client = Client::find($id);
        return view('client.profile',compact('orders','client'));
    }

    public function orderDetail($id)
    {
        $order  = Order::find($id) ;
        $client = Client::find($order->id);
        $productorders = Order::find($id)->productorders;
        foreach($productorders as $productorder)
        {
            $productorder['product_detail'] = Product::find($productorder['product_id']);
        }
        return view('client.productorder',compact('order','productorders','client'));
    }
}