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
						<h3 class="product-title">{{$customer->name}}</h3>
						<h4 class="price">العنوان <span>{{$customer->address}}</span></h4>
                        <h4 class="price">التليفون<span>{{$customer->phone}}</span></h4>
					</div>
				</div>
			</div>
		</div>

        <br>
        <h4 class="title">الفواتير التي لم  يتم دفعها </h4>
        <table class="table table-dark table-striped rtl">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">السعر </th>
                <th scope="col">التاريح</th>
                <th scope="col">الدفع</th>
                </tr>
            </thead>
            @for ($i=0;$i<sizeof($unpaidInvoices);$i++)
            <tbody>
                <tr>
                <th scope="row">{{$i+1}}</th>
                <td><a href="../invoiceDetail/{{$unpaidInvoices[$i]->id}}">{{$unpaidInvoices[$i]->price}}</a></td>
                <td>{{$unpaidInvoices[$i]->created_at->format('d/m/Y')}}</td>
                <td><i class="fa fa-times" aria-hidden="true" style="color: red"></i></td>
                </tr>
            </tbody>
            @endfor
        </table>
        <br>
        <h4 class="title">الفواتير التي دفعت  </h4>
        <table class="table table-dark table-striped rtl">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">السعر </th>
                <th scope="col">التاريح</th>
                <th scope="col">الدفع</th>
                </tr>
            </thead>
            @for ($i=0;$i<sizeof($paidInvoices);$i++)
            <tbody>
                <tr>
                <th scope="row">{{$i+1}}</th>
                <td><a href="../invoiceDetail/{{$paidInvoices[$i]->id}}">{{$paidInvoices[$i]->price}}</a></td>
                <td>{{$paidInvoices[$i]->created_at->format('d/m/Y')}}</td>
                <td><i class="fa fa-check" aria-hidden="true" style="color: green"></i>
                </td>
                </tr>
            </tbody>
            @endfor
        </table>
	</div>
@endsection