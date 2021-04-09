<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\InvoiceItem;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Cart;
use DB;

class ProductController extends Controller
{
    public function show($id)
    {
        $products = Product::where('category',$id)->orderBy('name', 'ASC')->get();
        return view('product.products',compact('products')); 
    }

    public function addProduct(Request $request)
    {
        $fetchedData = $request->all();

        $request->validate([
            'name' => 'required|unique:products,name',
            'category' => 'required',
            'unit'  =>  'required'
        ]);

        $product = Product::create([
            'name' => $fetchedData['name'],
            'unit' => $fetchedData['unit'],
            'category' => $fetchedData['category']
        ])->wasRecentlyCreated;

        if($product==1)
            return Redirect::back()->with('success', 'المنتج تمت اضافته');
    }

    public function productdetail($id)
    {
        $product =  Product::find($id);
        return view('product.productdetail',compact('product')); 
    }

    public function addtocart($id)
    {
        $cart= DB::select("SELECT * FROM carts where product_id = $id");
        $product = Product::where('id',$id)->get('store_quan');
        if($cart!=null)
            return Redirect::back()->with('warning', 'المنتج مضاف الي العربة');
        if($product[0]['store_quan']<=0)
        {
            return Redirect::back()->with('warning', 'لا يوحد كمية متاحه من المنتج');
        }
        if($product[0]['store_quan']<10)
        {
            Cart::create([
                'product_id' => $id,
                'quantity' =>$product[0]['store_quan']
            ]);
        }
        else
        {
            Cart::create([
                'product_id' => $id,
            ]);
        }
        return Redirect::back()->with('success', 'تم اضافة المنتج الي العربه');
    }

    public function deletefromcart($id)
    {
        DB::table('carts')->where('product_id', $id)->delete();
        return Redirect::back();
    }


    public function shoppingcart()
    {
        $carts = Cart::getCartItems();
        $customers = Customer::all();
        return view('product.shoppingcart',compact('carts','customers')); 
    }

    public function showinvoice($id)
    {
        if($id==null||$id=='undefined')
            return Redirect::back()->with('danger', 'أختر العميل');
        $customer =  Customer::find($id);
        $carts = Cart::getCartItems();
        return view('product.invoice',compact('carts','customer')); 
    }

    public function submitorder($id)
    {
        $carts = Cart::getCartItems();
        $invoice = Invoice::create([
            'customer_id' => $id,
            'price'       => $carts[0]['totalPrice']
        ]);
        for ($i=0;$i<sizeof($carts);$i++)
        {
            InvoiceItem::create([
                'price'      => $carts[$i]['product_detail']->outPrice,
                'quantity'   => $carts[$i]->quantity,
                'product_id' => $carts[$i]['product_detail']->id,
                'invoice_id' => $invoice->id
            ]);
            Product::where('id',$carts[$i]['product_detail']->id)->decrement('store_quan',$carts[$i]->quantity);
        }
        Cart::truncate();
        return redirect('/customers');
    }

    public function editproduct($id)
    {
        $product = Product::find($id);
        return view('product.editproduct',compact('product')); 
    }

    public function updateproduct(Request $request)
    {
        $fetchedData = $request->all();

        $request->validate([
            'name' => [
                'required',
                'unique:products,name,'.$fetchedData['id']
            ],
            'category' => 'required',
            'unit'  =>  'required'
        ]);

        product::where('id',$fetchedData['id'])->update([
            'name'=>$fetchedData['name'],
            'category'=>$fetchedData['category'],
            'unit'=>$fetchedData['unit'],
            'outPrice'=>$fetchedData['outPrice'],
            'store_quan'=>$fetchedData['store_quan']
            ]);
            return Redirect::to('productdetail/'.$fetchedData['id']);
    }

}
