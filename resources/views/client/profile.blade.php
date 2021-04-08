@extends('welcome')

@section('content')
<script src="https://use.fontawesome.com/c560c025cf.js"></script>

	<div class="container">
		<div class="caard">
			<div class="container-fliud">
				<div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1">
									<img src="../images/ben-sweet-456320-unsplash-768x432.jpg" class="card-img-top" alt="...">							
							</div>
                        </div>
                    </div>
					<div class="details col-md-6" dir="rtl" lang="ar">
						<h3 class="product-title">{{$client->name}}</h3>
						<h4 class="price">العنوان <span>{{$client->address}}</span></h4>
                        <h4 class="price">التليفون<span>{{$client->phone}}</span></h4>
                        <hr>
                        <h3 class="price">المبلغ المتبقي<span>{{$therestofamount}}</span></h3>
					</div>
				</div>
			</div>
		</div>
        <h4 class="title">ٌقم بالدفع </h4>
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
        <form class="form-inline col-8" action="/paytoclient" method="post">
            @csrf
            <label class="sr-only" for="inlineFormInputName2">المبلغ</label>
            <input type="text" name="price"  class="form-control" id="inlineFormInputName2" placeholder="أدخل المبلغ">
            <input type="hidden"  name="client_id"  value="{{$client->id}}">
            <button type="submit" class="btn btn-primary col-2">أدفع</button>
            <a class="payhis"  href="#Lorem_Ipsum" >تواريخ الدفع </a>
        </form>
        <br>
        <h4 class="title" >الفواتير </h4>
        <table class="table table-dark table-striped rtl">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">السعر </th>
                <th scope="col">التاريح</th>
                <th scope="col">الدفع</th>
                </tr>
            </thead>
            @for ($i=0;$i<sizeof($orders);$i++)
            <tbody>
                <tr>
                <th scope="row">{{$i+1}}</th>
                <td><a href="../orderDetail/{{$orders[$i]->id}}">{{$orders[$i]->price}}</a></td>
                <td>{{$orders[$i]->created_at->format('d/m/Y')}}</td>
                <td><i class="fa fa-times" aria-hidden="true" style="color: red"></i></td>
                </tr>
            </tbody>
            @endfor
        </table>
        <br>
        <br>
        <h4 class="title" id="Lorem_Ipsum">تواريخ الدفع  </h4>
        <table class="table table-dark table-striped rtl">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">السعر </th>
                <th scope="col">التاريح</th>
                <th scope="col">الدفع</th>
                </tr>
            </thead>
            @for ($i=0;$i<sizeof($paytransaction);$i++)
            <tbody>
                <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$paytransaction[$i]->price}}</td>
                <td>{{$paytransaction[$i]->created_at->format('d/m/Y')}}</td>
                <td><i class="fa fa-check" aria-hidden="true" style="color: green"></i></td>
                </tr>
            </tbody>
            @endfor
        </table>
        <br>
	</div>
@endsection