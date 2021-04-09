<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PayTransaction;
use App\Models\Order;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function therestofamount($id)
    {
        $totalinvoiceprice = Order::where('client_id',$id)->sum('price');
        $totalpayeprice    = PayTransaction::where('client_id',$id)->sum('price');
        return  $totalinvoiceprice - $totalpayeprice;
    }

    public function paytransactions()
    {
        return $this->hasMany(PayTransaction::class);
    }
}
