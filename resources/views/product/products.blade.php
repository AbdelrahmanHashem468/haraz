@extends('welcome')
@section('content')

    <div class="row">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('warning'))
            <div class="alert alert-warning">
                <ul>
                    <li>{!! \Session::get('warning') !!}</li>
                </ul>
            </div>
        @endif
        @foreach ($products as $product)
            <div class="card col-md-3" style="width: 18rem;">
                @if($product->category==0)
                <img src="../images/depositphotos_36735325-stock-photo-a-selection-of-spices.jpg" class="card-img-top" alt="...">
                @endif
                @if($product->category==1)
                <img src="../images/depositphotos_52083087-stock-photo-fresh-medicinal-herbs.jpg" class="card-img-top" alt="...">
                @endif    
                @if($product->category==2)
                <img src="../images/9 Super Foods for Healthy and Luscious Hair.jpg" class="card-img-top" alt="...">
                @endif   
                @if($product->category==3)
                <img src="../images/Fuji Apple Spice Cake with Cream Cheese Frosting.jpg" class="card-img-top" alt="...">
                @endif  
                @if($product->category==4)
                <img src="../images/71TE1yF-5LL._AC_SL1000_.jpg" class="card-img-top" alt="...">
                @endif                         
                <div class="card-body">
                    <a href="../productdetail/{{$product->id}}" class="hoverr"><h5 class="card-title">{{$product->name}}<span class="pricee">{{$product->outPrice}}</span></h5></a>
                    <a href="../addtocart/{{$product->id}}" class="btn btn-primary active btt"> العربة</a>
                    <a href="../addtocart/{{$product->id}}" class="btn btn-primary active bttt">الطلب</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection