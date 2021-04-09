@extends('welcome')
@section('content')

<div class="row">
    <div class="divform">
        <form action="/updateproduct" method="post">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label >الاسم</label>
                <input class="form-control"  value="{{$product->name}}" name="name" type="text" placeholder="ادخل الاسم">  
                <input class="form-control"  value="{{$product->id}}" name="id" type="hidden" >                  
            </div>
            <div class="form-group">
                <label >الوحدة</label>
                <input class="form-control" value="{{$product->unit}}" name="unit" type="text" placeholder="ادخل الوحدة">         
            </div>
            <div class="form-group">
                <label >النوع</label>
                <select class="form-select" name="category" aria-label="Default select example">
                    @if($product->category==0)
                    <option value="{{$product->category}}" selected >عطارة</option>
                    <option value="1">أعشاب</option>
                    <option value="2">بقوليات</option>
                    <option value="3">حلواني</option>
                    <option value="4">مستحضرات</option>
                    @endif
                    @if($product->category==1)
                    <option value="{{$product->category}}" selected >أعشاب</option>
                    <option value="0">عطارة</option>
                    <option value="2">بقوليات</option>
                    <option value="3">حلواني</option>
                    <option value="4">مستحضرات</option>
                    @endif
                    @if($product->category==2)
                    <option value="{{$product->category}}" selected >بقوليات</option>
                    <option value="0">عطارة</option>
                    <option value="1">أعشاب</option>
                    <option value="3">حلواني</option>
                    <option value="4">مستحضرات</option>
                    @endif
                    @if($product->category==3)
                    <option value="{{$product->category}}" selected >حلواني</option>
                    <option value="0">عطارة</option>
                    <option value="1">أعشاب</option>
                    <option value="2">بقوليات</option>
                    <option value="4">مستحضرات</option>
                    @endif
                    @if($product->category==4)
                    <option value="{{$product->category}}" selected >مستحضرات</option>
                    <option value="0">عطارة</option>
                    <option value="1">أعشاب</option>
                    <option value="2">بقوليات</option>
                    <option value="3">حلواني</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label >سعر البيع</label>
                <input class="form-control"  value="{{$product->outPrice}}" name="outPrice" type="text" placeholder="ادخل سعر البيع">          
            </div>
            <div class="form-group">
                <label >الكمية</label>
                <input class="form-control"  value="{{$product->store_quan}}" name="store_quan" type="text" placeholder="ادخل الكمية">          
            </div>               
            <button type="submit" class="btn btn-primary subbut">Submit</button>
        </form>
    </div>
</div>
@endsection