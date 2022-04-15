@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-10">
            <h1>Избор на профилна снимка</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-5 text-center">
            <img src="{{asset('/storage/images/'.$person->image)}}" alt="" class="">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-5 text-center">
            <h4>{{$person->first_name}} {{$person->last_name}}</h4>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12 col-md-5 text-center">
            <form action="{{route($role.'.upload', $person->id)}}" method="POST" enctype="multipart/form-data" class="gap-2 d-grid">
                @csrf
                @method('PUT')
                <input class="form-control form-control-sm" type="file" name="imgFile">
                <input class="btn btn-sm btn-outline-secondary d-block" type="submit" value="Upload">
            </form>
        </div>
    </div>
</div>
    
@endsection