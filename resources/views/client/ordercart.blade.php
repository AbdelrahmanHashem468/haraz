@extends('welcome')
@section('content')

@if ($products==null)
<div class="card-header bg-warning text-light">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        الطلب فارغ.
    أضف سلع للطلب واستعرضهم قبل عملية الشراء.
</div>
@else
dsdsds
@endif
@endsection