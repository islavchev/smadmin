@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
    <div class="col-10">
        <h1>Детайли за зала</h1>
    </div>
    <div class="col-2">
        <a 
            class="link-info px-0 pt-1 pb-0"
            href="{{route('rooms.edit', $room->id)}}">
            <span class="material-icons md-18">edit</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-2"><strong>Име на залата:</strong></div>
    <div class="col-md-10">{{$room->room_name}}</div>
</div>
<div class="row">
    <div class="col-md-2"><strong>Капацитет:</strong></div>
    <div class="col-md-10">{{$room->capacity}} студенти</div>
</div>
<div class="row">
    <div class="col-md-2"><strong>Интернет достъп:</strong></div>
    <div class="col-md-10">{{config('enums.rooms_internet')[$room->internet]}}</div>
</div>
<div class="row">
    <div class="col-md-2"><strong>Мултимедия:</strong></div>
    <div class="col-md-10">{{config('enums.rooms_multimedia')[$room->multimedia]}}</div>
</div>
@if ($room->notes)    
    <div class="row">
        <div class="col-md-2"><strong>Забележки:</strong></div>
        <div class="col-md-10">{{$room->notes}}</div>
    </div>
@endif
<div class="row">
    <div class="col-md-2"><Strong>Дисциплини в залата:</Strong></div>
    <div class="col-md-10">
        @foreach ($room->seminars->unique('subject_id') as $seminar)
            <div class="row border-bottom">
                <div class="col-md-8">
                    {{$seminar->subject->name.' ('.$seminar->subject->code.')'}}
                </div>
                <div class="col-md-4">
                    {{config('enums.acad_positions')[$seminar->academic->acad_position].' '.$seminar->academic->first_name.' '.$seminar->academic->last_name.' '.config('enums.acad_titles')[$seminar->academic->acad_title]}}
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
    
@endsection