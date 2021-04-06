@extends('welcome')
@section('content')
<div class="row invoicecolor duBorder">
        <table class="table table-dark">
            <div class="col-md-4 detial">
                <h6> المورد   :  <span>{{$client->name}}</span></h6>
                <h6> العنوان  :  <span> {{$client->address}}</span></h6>
                <h6> التليفون  :  <span>{{$client->phone}}</span></h6>
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
            @for ($i=0;$i<sizeof($products);$i++)
            <tbody class="table-light">
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$products[$i]['product_detail']->name}}</td>
                    <td>{{$products[$i]->inPrice}}</td>
                    <td>{{$products[$i]['quantity']}}</td>               
                    <td>{{$products[$i]['quantity']*$products[$i]->inPrice}}</td>
                </tr>
                </tbody>
            @endfor
            <tr class="total ">
                <td colspan="3" class="table-light"></td>
                <th class="table-secondary" >المجموع</th>
                <th class="table-secondary">{{$products[0]['totalPrice']}}</th>
            </tr>
        </table>
        <div class="row maneg">
            <h6 > أدارة   /   عمر هاشم        ===============        التليفون  /          01152041410    </h6>
        </div>

        <div class="card-footer no-print">
            <div class="pull-right" style="margin: 10px">
                <a href="../submitclientorder/{{$client->id}}" class="btn btn-success pull-right">تأكيد الطلب</a>
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