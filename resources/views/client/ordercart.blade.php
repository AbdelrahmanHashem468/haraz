@extends('welcome')
@section('content')

@if ($products==null)
<div class="card-header bg-warning text-light">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        الطلب فارغ.
    أضف سلع للطلب واستعرضهم قبل عملية الشراء.
</div>
@else
<div class="row">
    <div class="divform">
        <form class="makeorder">
            @for ($i=0;$i<sizeof($products);$i++)
            <h4 class="proname">{{$products[$i]->product_detail->name}}</h4>
            <div class="form-row">
                <div class="col-3">
                    <label >سعر الشراء</label>
                    <input data-id="{{$products[$i]->product_detail->id}}" data-index="{{'in'.$i}}" type="text" value="{{$products[$i]->inPrice}}" class="form-control  {{'in'.$i}}" onChange="updateinprice({{$i}})" placeholder="سعر الشراء">
                </div>
                <div class="col-3">
                    <label >سعر البيع</label>
                    <input data-id="{{$products[$i]->product_detail->id}}" data-index="{{'in'.$i}}" type="text" value="{{$products[$i]->outPrice}}" class="form-control  {{'out'.$i}}" onChange="updateoutprice({{$i}})" placeholder="سعر البيع">
                </div>
                <div class="col-3">
                    <label >الكمية</label>
                    <input data-id="{{$products[$i]->product_detail->id}}" data-index="{{'in'.$i}}" type="text" value="{{$products[$i]->quantity}}" class="form-control  {{'quan'.$i}}" onChange="updatequantity({{$i}})" placeholder="الكمية">
                </div>
                <div class="col-3">
                    <a a href="deletefromordercart/{{$products[$i]->product_detail->id}}" type="button" class="btn btn-outline-danger btn-xs delete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <hr>
            @endfor
            <div class="col-10">
                <select class="form-select selectcolor selectclientr" id="client" name="client" aria-label="Default select example" >
                    <option  value="" selected  disabled>أختر المورد</option>
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}" >{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="pull-right ">
                <a href="../order/"  onclick="location.href=this.href+scrt_var;return false;" class="btn btn-success pull-right foloworder" >تابع الطلب</a>
            </div>
        </form>
    </div>
</div>
@endif

<script type="text/javascript">

var scrt_var;
$(document).ready(function() {
    
    $("#client").on('change',function(){
        scrt_var = $(this).val();
    });
});


    function updateinprice(e)
    {
            var inprice = parseInt($(".in"+e).val())
            var prodId =  $(".in"+e).data("id")
            $.ajax({
                type: "POST",
                url: "/updateinprice",
                // The key needs to match your method's input parameter (case-sensitive).
                data: JSON.stringify({"_token": "{{ csrf_token() }}","id": prodId,"inprice":inprice}),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data){console.log(data);},
                error: function(errMsg) {
                    alert(errMsg);
                }
            });
    }

    function updateoutprice(e)
    {
        var outprice = parseInt($(".out"+e).val())
        var prodId =  $(".in"+e).data("id")
        $.ajax({
                type: "POST",
                url: "/updateoutprice",
                // The key needs to match your method's input parameter (case-sensitive).
                data: JSON.stringify({"_token": "{{ csrf_token() }}","id": prodId,"outprice":outprice}),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data){console.log(data);},
                error: function(errMsg) {
                    alert(errMsg);
                }
            });
    }

    function updatequantity(e)
    {
        var quantity = parseInt($(".quan"+e).val())
        var prodId =  $(".in"+e).data("id")
        $.ajax({
                type: "POST",
                url: "/updatequantity",
                // The key needs to match your method's input parameter (case-sensitive).
                data: JSON.stringify({"_token": "{{ csrf_token() }}","id": prodId,"quantity":quantity}),
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