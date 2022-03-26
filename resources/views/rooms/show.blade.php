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
    <div class="col-md-6">
        <div class="row">
            <div class="col-6 col-md-5"><strong>Име на залата:</strong></div>
            <div class="col-6 col-md-7">{{$room->room_name}}</div>
        </div>
        <div class="row">
            <div class="col-6 col-md-5"><strong>Капацитет:</strong></div>
            <div class="col-6 col-md-7">{{$room->capacity}} студенти</div>
        </div>
        <div class="row">
            <div class="col-6 col-md-5"><strong>Интернет достъп:</strong></div>
            <div class="col-6 col-md-7">{{config('enums.rooms_internet')[$room->internet]}}</div>
        </div>
        <div class="row">
            <div class="col-6 col-md-5"><strong>Мултимедия:</strong></div>
            <div class="col-6 col-md-7">{{config('enums.rooms_multimedia')[$room->multimedia]}}</div>
        </div>
        @if ($room->notes)    
            <div class="row">
                <div class="col-6 col-md-5"><strong>Забележки:</strong></div>
                <div class="col-6 col-md-7">{{$room->notes}}</div>
            </div>
        @endif
        <div class="row">
            <div class="col"><Strong>Дисциплини в залата:</Strong></div>
        </div>
            @foreach ($room->seminars->unique('subject_id') as $seminar)
                <div class="row border-top">
                    <div class="col-8 col-md-8">
                        {{$seminar->subject->name.' ('.$seminar->subject->code.')'}}
                    </div>
                </div>
            @endforeach
    </div>
    <div class="col-md-6">
        <div class="row"><h5>Програма на залата днес:</h5></div>
        <div class="row border-bottom">
            <div class="col-3">
                <strong>Час</strong>
            </div>
            <div class="col-2">
                <strong>Група</strong>
            </div>
            <div class="col-3">
                <strong>Дисциплина</strong>
            </div>
            <div class="col-4">
                <strong>Преподавател</strong>
            </div>
        </div>
        @foreach ($room->seminars->where('date', '=', date('Y-m-d'))->sortBy('date')->sortBy('period') as $seminar)
        <div class="row border-bottom">
            <div class="col-md-3">
                {{config('enums.class_periods')[$seminar->period]}}
            </div>
            <div class="col-md-2">
                {{$seminar->student_group->name}}
            </div>
            <div class="col-md-3">
                {{$seminar->subject->code}}
            </div>
            <div class="col-md-4">
                {{config('enums.acad_positions')[$seminar->academic->acad_position].' '.$seminar->academic->last_name}}
            </div>
        </div>    
        @endforeach
    </div>
</div>
</div>
    
@endsection