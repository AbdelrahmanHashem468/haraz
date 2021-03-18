@extends('welcome')
@section('content')

<div class="row">
    <div class="divform">
        <form action="/addproduct" method="post">
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
            <div class="form-group">
                <label >الاسم</label>
                <input class="form-control" name="name" type="text" placeholder="ادخل الاسم">          
                
            </div>
            <div class="form-group">
                <label >الوحدة</label>
                <input class="form-control" name="unit" type="text" placeholder="ادخل الوحدة">         
            </div>
            <div class="form-group">
                <label >النوع</label>
                <select class="form-select" name="category" aria-label="Default select example">
                    <option value="" selected disabled>أختر النوع</option>
                    <option value="0">عطارة</option>
                    <option value="1">أعشاب</option>
                    <option value="2">بقوليات</option>
                    <option value="3">حلواني</option>
                    <option value="4">مستحضرات</option>
                </select>
            </div>               
            <button type="submit" class="btn btn-primary subbut">Submit</button>
        </form>
    </div>
</div>
@endsection