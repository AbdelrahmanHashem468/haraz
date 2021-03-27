@extends('welcome')
@section('content')

<div class="row">
    <div class="divform">
        <form action="/addorder" method="post">
            @csrf
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- category: -->
            <div class="form-group">
                <label for="category">النوع</label>
                <select name="category" class="form-select" aria-label="Default select example">
                    <option value="" selected disabled>اختر النوع</option>
                    @foreach ($category as $key => $value)
                        <option value="{{$key}}" >{{$value}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status: -->
            <div class="form-group">
                <label for="product_id">المنتج</label>
                <select name="product_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>اختر المنتج</option>
                </select>
            </div>

            <div class="form-group">
                <label >سعر الشراء</label>
                <input name="inPrice" class="form-control" type="text" placeholder="ادخل السعر">         
            </div>

            <div class="form-group">
                <label >سعر البيع</label>
                <input name="outPrice" class="form-control" type="text" placeholder="ادخل السعر">         
            </div>

            <div class="form-group">
                <label >الكمية</label>
                <input name="quantity" class="form-control" type="text" placeholder="ادخل الكمية">
            </div>  

            <div class="form-group">
                <label >الموردين</label>
                <select name="client_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>اختر المورد</option>
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}" >{{$client->name}}</option>
                    @endforeach
                </select>
            </div>              
            <button type="submit" class="btn btn-primary subbut">Submit</button>
        </form>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="category"]').on('change',function(){
            var categoryid = jQuery(this).val();
            if(categoryid)
            {
                jQuery.ajax({
                    url : 'productcategory/' +categoryid,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        console.log(data);
                        jQuery('select[name="product_id"]').empty();
                        jQuery.each(data, function(key,value){
                        $('select[name="product_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            }
            else
            {
                $('select[name="product_id"]').empty();
            }
            });
    });
</script>
@endsection