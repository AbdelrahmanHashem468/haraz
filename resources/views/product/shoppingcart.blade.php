@extends('welcome')
@section('content')

@if ($carts==null)
<div class="card-header bg-warning text-light">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        عربة التسوق فارغة.
    أضف سلع لعربة التسوق واستعرضهم قبل عملية الشراء.
</div>
@else
    <div class="card shopping-cart mgTop">
        
        <div class="card-header bg-dark text-light">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            العربة التسوق
        </div>

        @for ($i=0;$i<sizeof($carts);$i++)
            <div class="card-body bodycard cart-total box" data-len={{sizeof($carts)}}>
                <!-- PRODUCT -->
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2 text-center">
                            <img class="img-responsive" src="../images/depositphotos_36735325-stock-photo-a-selection-of-spices.jpg" alt="prewiew" width="120" height="80">
                    </div>
                    <div class="col-12 text-sm-center col-sm-12 text-md-right col-md-4 heeee">
                        <strong>{{$carts[$i]['product_detail']->name}}</strong>
                        <h4 class="product-name"><strong> الكمية المتاحة: <span class="marge {{"availble".$i}}">{{$carts[$i]['product_detail']->store_quan}}</span></strong></h4>
                        <br>
                        
                    </div>
                    
                    <div class="col-12 col-sm-12 text-sm-center col-md-6 text-md-right row">
                        <div class="col-3 col-sm-3 col-md-6 textAlignCenter" style="padding-top: 5px">
                            <h6 ><strong>
                                <span class="{{"prodPrice".$i}}" >{{$carts[$i]['product_detail']->outPrice}}</span>
                                <span class="text-muted">x</span></strong></h6>
                                <br>
                                <h4>
                                    <!--???????????????????????????????????????????????????????????????????????-->
                                    <span class="pricee {{"res".$i}}">{{$carts[$i]['product_detail']->outPrice*$carts[$i]->quantity}}</span>
                                </h4>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 mgTop">
                            <div class="quantity">
                                <!--???????????????????????????????????????????????????????????????????????-->
                                <input data-id="{{$carts[$i]['product_detail']->id}}" type="text" data-index="{{'quan'.$i}}"  placeholder="الكمية" min="1" value="{{$carts[$i]->quantity}}"  class=" qty {{'quan'.$i}}" onChange="cusCalc({{$i}})" style="text-align: right; direction:rtl;">
                            </div>  
                        </div>
                        <div class="col-2 col-sm-2 col-md-2 text-right mgTop">
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
                    المجموع: <b class="pricee total">{{$carts[0]['totalPrice']}}</b>
                </div>
            </div>
        </div>
    </div>
@endif

<script type="text/javascript">
var scrt_var;
var cartTotal = parseInt($(".cart-total").data('len'))

$(document).ready(function() {
    
    $("#customer").on('change',function(){
        scrt_var = $(this).val();
    });
});
    function cusCalc(e){
        var productPrice = parseInt($(".prodPrice"+e).html())
        var quan = parseInt($(".quan"+e).val())
        var valll = quan*productPrice
        var prodId =  $(".quan"+e).data("id")
        
        $(".res"+e).html(valll)
        var tt = 0
        for(var i = 0;i<cartTotal;i++){
            tt+= parseInt($(".res"+i).html())
        }
        $(".total").html(tt)
        $.ajax({
            type: "POST",
            url: "/updateQan",
            // The key needs to match your method's input parameter (case-sensitive).
            data: JSON.stringify({"_token": "{{ csrf_token() }}","id": prodId,"quan":quan}),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data){console.log(data);},
            error: function(errMsg) {
                alert(errMsg);
            }
        });
    }
</script>
@endsection