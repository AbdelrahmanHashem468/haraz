<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\product;
use App\Models\Cart;
use Redirect;

class CustomerController extends Controller
{
    public function show()
    {
        $customers = Customer::all();
        return view('customer.customers',compact('customers'));
    }

    public function addcustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $fetchedData = $request->all();

        $customer = Customer::create([
            'name' => $fetchedData['name'],
            'address' => $fetchedData['address'],
            'phone' => $fetchedData['phone']
        ])->wasRecentlyCreated;

        if($customer==1)
            return Redirect::back()->with('success', ' تمت اضافته زبون');
    }

    public function customerInvoices($id)
    {
        $unpaidInvoices = Invoice::where('customer_id',$id)->where('paid',0)->get();
        $paidInvoices = Invoice::where('customer_id',$id)->where('paid',1)->get();
        $customer = Customer::find($id);
        return view('customer.profile',compact('customer','paidInvoices','unpaidInvoices'));
    }

    public function invoiceDetail($id)
    {
        $invoice = Invoice::find($id) ;
        $customer = Invoice::find($id)->customer;
        $invoiceitems = Invoice::find($id)->invoiceitems;
        foreach($invoiceitems as $invoiceitem)
        {
            $invoiceitem['product_detail'] = Product::find($invoiceitem['product_id']);
        }
        return view('customer.invoicedetail',compact('invoice','invoiceitems','customer'));
    }

    public function payinvoice($id)
    {
        Invoice::where('id',$id)->update([
            'paid'=>1,
            'paydate'=>now()
            ]);
        return redirect('/customers');
    }

    public function updateQan(Request $request)
    {
        $fetchedData = $request->all();
        $store_quan = Product::where('id', $fetchedData['id'])->pluck('store_quan');
        if($store_quan[0]>=$fetchedData['quan'] && $fetchedData['quan']>0)
        {
            Cart::where('product_id',$fetchedData['id'])->update([
                'quantity'=>$fetchedData['quan']
                ]);
            return json_encode( $fetchedData);
        }
        else
        {
            return json_encode( ['errors'  =>'الكمية غير متاحه']);
        }
    }
}
