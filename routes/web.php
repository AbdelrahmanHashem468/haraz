<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get ('/          ', function () {return view('welcome           ');});
Route::get ('productform', function () {return view('product.addproduct');});

Route::get ( '/product/{id}         ', [ProductController::class, 'show']);
Route::post('/addproduct            ', [ProductController::class, 'addProduct']);
Route::get ('/orderform             ', [ProductController::class, 'orderform']);
Route::get ('/productcategory/{id}  ', [ProductController::class, 'productcategory']);
Route::post('/addorder              ', [ProductController::class, 'addorder']);
Route::get ('productdetail/{id}     ', [ProductController::class, 'productdetail']);
Route::get ('addtocart/{id}         ', [ProductController::class, 'addtocart']);
Route::get ('shoppingcart           ', [ProductController::class, 'shoppingcart']);
Route::get ('deletefromcart/{id}    ', [ProductController::class, 'deletefromcart']);
Route::get ('invoice/{id}           ', [ProductController::class, 'showinvoice']);
Route::get ('submitorder/{id}       ', [ProductController::class, 'submitorder']);




Route::get('/customers             ', [CustomerController::class, 'show']);
Route::post('/addcustomer          ', [CustomerController::class, 'addcustomer']);
Route::get('/customer/{id}         ', [CustomerController::class, 'customerInvoices']);
Route::get('/invoiceDetail/{id}    ', [CustomerController::class, 'invoiceDetail']);
Route::get('/payinvoice/{id}       ', [CustomerController::class, 'payinvoice']);

