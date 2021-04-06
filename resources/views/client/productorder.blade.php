@extends('welcome')
@section('content')
<div class="row invoicecolor duBorder">
        <table class="table ">
            <div class="col-md-4 detial">
                <h6> العميل   :  <span>{{$client->name}}</span></h6>
                <h6> العنوان  :  <span> {{$client->address}}</span></h6>
                <h6> التليفون  :  <span>{{$client->phone}}</span></h6>
                <h6> التاريخ  :  <span>{{$order->created_at->format('d/m/Y')}}</span></h6>
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
            @for ($i=0;$i<sizeof($productorders);$i++)
            <tbody class="table-light">
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$productorders[$i]['product_detail']->name}}</td>
                    <td>{{$productorders[$i]['outPrice']}}</td>
                    <td>{{$productorders[$i]['quantity']}}</td>               
                    <td>{{$productorders[$i]['quantity']*$productorders[$i]['inPrice']}}</td>
                </tr>
                </tbody>
            @endfor
            <tr class="total ">
                <td colspan="3" class="table-light"></td>
                <th class="table-secondary" >المجموع</th>
                <th class="table-secondary">{{$order->price}}</th>
            </tr>
        </table>
        <div class="row maneg">
            <h6 > أدارة   /   عمر هاشم        ===============        التليفون  /          01152041410    </h6>
        </div>
        <div class="card-footer no-print">
            <a href="" onclick="jsPrintAll()"   class="btn btn-dark print">طباعة</a>
        </div>
</div>


<script   type="text/javascript">
    var jsPrintAll = function () {
    window.print();
    }
</script>
@endsection