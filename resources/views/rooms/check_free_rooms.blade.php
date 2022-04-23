@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
    <div class="col-10">
        <h1>Проверка за свободни зали</h1>
    </div>
</div>
<form action="{{route('rooms.show_free_rooms')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mt-2">
        <div class="col-md-2"><label for="date"><strong>Дата:</strong></label></div>
        <div class="col-md-10"><input type="date" name="date" id="date" class="form-control form-control-sm" value="{{date('m / d / Y')}}"></div>
    </div>
    <div class="row mt-2">
        <div class="col-md-2"><label for="period"><strong>Час:</strong></label></div>
        <div class="col-md-10">
            <select name="period" id="period" class="form-select form-select-sm">
                <option value="0" selected>Всички</option>
            @foreach (config('enums.class_periods') as $period_key => $period)
                <option value="{{$period_key}}">{{$period}}</option>
            @endforeach    
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-sm mt-3">
        Провери
    </button>        
</form>  
</div>
    
@endsection