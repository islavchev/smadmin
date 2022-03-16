@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
    <div class="col-10">
        <h1>Детайли за преподавател</h1>
    </div>
    <div class="col-2">
        <a 
            class="link-info px-0 pt-1 pb-0"
            href="{{route('academics.edit', $academic->id)}}">
            <span class="material-icons md-18">edit</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-2 text-end"><strong>Имена:</strong></div>
    <div class="col-10">{{$academic->first_name}} {{$academic->last_name}}</div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Обр./научна степен:</strong></div>
    <div class="col-10">{{config('enums.acad_titles')[$academic->acad_title]}} </div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Академична длъжност:</strong></div>
    <div class="col-10">{{config('enums.acad_positions')[$academic->acad_position]}}</div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Кабинет:</strong></div>
    <div class="col-10">{{$academic->room_no}}</div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Телефон:</strong></div>
    <div class="col-10">{{$academic->phone}}</div>
</div>

<div class="row">
    <div class="col-2 text-end"><strong>Електронна поща:</strong></div>
    <div class="col-10">{{$academic->email}}</div>
</div>

</div>
    
@endsection