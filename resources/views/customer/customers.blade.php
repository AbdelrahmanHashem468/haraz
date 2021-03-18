@extends('welcome')
@section('content')

<div class="row">
    <div class="divform">
        <form action="addcustomer" method="post">
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
                <label >العنوان</label>
                <input class="form-control" name="address" type="text" placeholder="ادخل العنوان">          
            </div>              
            <div class="form-group">
                <label >التليفون</label>
                <input class="form-control" name="phone" type="text" placeholder="ادخل النليفون">          
            </div>   
            <button type="submit" class="btn btn-primary subbut">Submit</button>
        </form>
    </div>

    <table class="table table-dark table-striped rtl">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">العنوان</th>
            <th scope="col">التليفون</th>
            </tr>
        </thead>
        @for ($i=0;$i<sizeof($customers);$i++)
        <tbody>
            <tr>
            <th scope="row">{{$i+1}}</th>
            <td><a href="../customer/{{$customers[$i]->id}}">{{$customers[$i]->name}}</a></td>
            <td>{{$customers[$i]->address}}</td>
            <td>{{$customers[$i]->phone}}</td>
            </tr>
        </tbody>
        @endfor
    </table>
</div>
@endsection