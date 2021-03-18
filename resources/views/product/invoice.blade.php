@extends('welcome')
@section('content')
<div class="row invoicecolor duBorder">
        <table class="table ">
            <div class="col-md-4 detial">
                <h6> العميل   :  <span>{{$customer->name}}</span></h6>
                <h6> العنوان  :  <span> {{$customer->address}}</span></h6>
                <h6> التليفون  :  <span>{{$customer->phone}}</span></h6>
                <h6 id="date"></h6>
            </div>
            <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">المنتج</th>
                <th scope="col">السعر</th>
                <th scope="col">الكمية</th>
                <th scope="col">القيمة</th>
            </tr>
            </thead>
            @for ($i=0;$i<sizeof($carts);$i++)
            <tbody class="table-light">
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$carts[$i]['product_detail']->name}}</td>
                    <td>{{$carts[$i]['product_detail']->outPrice}}</td>
                    <td>{{$carts[$i]['quantity']}}</td>               
                    <td>{{$carts[$i]['quantity']*$carts[$i]['product_detail']->outPrice}}</td>
                </tr>
                </tbody>
            @endfor
            <tr class="total ">
                <td colspan="3" class="table-light"></td>
                <th class="table-secondary" >المجموع</th>
                <th class="table-secondary">{{$carts[0]['totalPrice']}}</th>
            </tr>
        </table>
        <div class="card-footer no-print">
            <div class="pull-right" style="margin: 10px">
                <a href="../submitorder/{{$customer->id}}" class="btn btn-success pull-right">تأكيد الطلب</a>
            </div>
            <a href="" onclick="jsPrintAll()"   class="btn btn-dark print">طباعة</a>

        </div>
</div>


<script   type="text/javascript">

    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML ="  التاريخ " +" : " +  d + "/" + m + "/" + y ;
    var jsPrintAll = function () {
    window.print();
    }
</script>
@endsection