@extends('welcome')
@section('content')
<div class="row invoicecolor">
        <table class="table ">
            <div class="col-md-4 detial">
                <h6> العميل   :  <span>{{$customer->name}}</span></h6>
                <h6> العنوان  :  <span> {{$customer->address}}</span></h6>
                <h6> التليفون  :  <span>{{$customer->phone}}</span></h6>
                <h6> التاريخ  :  <span>{{$invoice->created_at->format('d/m/Y')}}</span></h6>
                @if($invoice->paid==1)<h6> تاريخ الدفع  :  <span>{{$invoice->paydate->format('d/m/Y')}}</span></h6>@endif
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
            @for ($i=0;$i<sizeof($invoiceitems);$i++)
            <tbody class="table-light">
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$invoiceitems[$i]['product_detail']->name}}</td>
                    <td>{{$invoiceitems[$i]['product_detail']->outPrice}}</td>
                    <td>{{$invoiceitems[$i]['quantity']}}</td>               
                    <td>{{$invoiceitems[$i]['quantity']*$invoiceitems[$i]['product_detail']->outPrice}}</td>
                </tr>
                </tbody>
            @endfor
            <tr class="total ">
                <td colspan="3" class="table-light"></td>
                <th class="table-secondary" >المجموع</th>
                <th class="table-secondary">{{$invoice->price}}</th>
            </tr>
        </table>
        <div class="card-footer no-print">
            @if($invoice->paid==0)
            <div class="pull-right" style="margin: 10px">
                <a href="../payinvoice/{{$invoice->id}}" class="btn btn-success pull-right">دفع الفاتورة</a>
            </div>
            @endif
            <a href="" onclick="jsPrintAll()"   class="btn btn-dark print">طباعة</a>

        </div>
</div>


<script   type="text/javascript">
    var jsPrintAll = function () {
    window.print();
    }
</script>
@endsection