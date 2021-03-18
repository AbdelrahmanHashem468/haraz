@extends('welcome')
@section('content')
<script src="https://use.fontawesome.com/c560c025cf.js"></script>
@if ($carts==null)
<div class="card-header bg-warning text-light">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        عربة التسوق فارغة.
    أضف سلع لعربة التسوق واستعرضهم قبل عملية الشراء.
</div>
@else
    <div class="card shopping-cart">

        <div class="card-header bg-dark text-light">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            العربة التسوق
        </div>

        @for ($i=0;$i<sizeof($carts);$i++)
            <div class="card-body bodycard">
                <!-- PRODUCT -->
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2 text-center">
                            <img class="img-responsive" src="../images/depositphotos_36735325-stock-photo-a-selection-of-spices.jpg" alt="prewiew" width="120" height="80">
                    </div>
                    <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                        <h4 class="product-name"><strong> الكمية المتاحة <span class="marge">{{$carts[$i]['product_detail']->store_quan}}</span></strong><strong>{{$carts[$i]['product_detail']->name}}</strong></h4>
                        <br>
                        <h4>
                            <span class="pricee">{{$carts[$i]['product_detail']->outPrice*$carts[$i]->quantity}}</span>
                        </h4>
                    </div>
                    
                    <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                        <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                            <h6><strong>{{$carts[$i]['product_detail']->outPrice}}<span class="text-muted">x</span></strong></h6>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4">
                            <div class="quantity">
                                <input type="button" value="+" class="plus">
                                <input type="input" disabled step="1" data-min="1" data-value="{{$carts[$i]->quantity}}" title="Qty" class="qty" size="4" id="quanChange">
                                <input type="button" value="-" class="minus">
                            </div>
                        </div>
                        <div class="col-2 col-sm-2 col-md-2 text-right">
                            <a a href="deletefromcart/{{$carts[$i]['product_detail']->id}}" type="button" class="btn btn-outline-danger btn-xs">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- END PRODUCT --> 
            </div>
        @endfor
        <div class="form-group">
            <select class="form-select selectcolor" id="customer" name="customer" aria-label="Default select example" >
                <option  value="" selected  disabled>أختر العميل</option>
                @foreach ($customers as $customer)
                    <option value="{{$customer->id}}" >{{$customer->name}}</option>
                @endforeach
            </select>
        </div>
        @if (\Session::has('danger'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
        @endif
        <div class="card-footer">
            <div class="pull-right" style="margin: 10px">
                <a href="../invoice/"  onclick="location.href=this.href+scrt_var;return false;" class="btn btn-success pull-right">تابع عملية الشراء</a>
                <div class="pull-right" style="margin: 5px">
                    المجموع: <b class="pricee">{{$carts[0]['totalPrice']}}</b>
                </div>
            </div>
        </div>
    </div>
@endif

<script type="text/javascript">
var scrt_var;
$(document).ready(function() {
    $("#customer").on('change',function(){
        scrt_var = $(this).val();
    });
    $("#quanChange").on("change",()=>{
        console.log($(this).attrvalue)
    })
});



</script>
@endsection