@extends('welcome')

@section('content')
	<div class="container">
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
		<div class="caard">
			<div class="container-fliud">
				<div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1">
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
							</div>
                        </div>
						<a  href="../editproduct/{{$product->id}}" class=" btn btn-info" type="button" style="width: fit-content">تعديل المنتج</a>
                    </div>
					<div class="details col-md-6" dir="rtl" lang="ar">
						<h3 class="product-title">{{$product->name}}</h3>
						<h4 class="price">النوع <span>
						@if($product->category==0)عطارة@endif
						@if($product->category==1)أعشاب@endif
						@if($product->category==2)بقوليات@endif
						@if($product->category==3)حلواني@endif
						@if($product->category==4)مستحضرات@endif
						</span></h4>
                        <h4 class="price">الوحدة<span>{{$product->unit}}</span></h4>
                        <h4 class="price">سعر البيع <span>{{$product->outPrice}}</span></h4>
                        <h4 class="price">سعر الشراء <span>{{$product->inPrice}}</span></h4>
                        <h4 class="price">الكمية المتاحة<span>{{$product->store_quan}}</span></h4>
						<div class="action">
							<a  href="../addtocart/{{$product->id}}" class="add-to-cart btn btn-primary" type="button">اضف الي العربة</a>
							<a  href="../addToOrderCart/{{$product->id}}" class="add-to-cart btn btn-default" type="button">اضف الي الطلب</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection