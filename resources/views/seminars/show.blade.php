@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
    <div class="col-10">
        <h1>Детайли за занимание</h1>
    </div>
    <div class="col-2">
        <a 
            class="link-info px-0 pt-1 pb-0"
            href="{{route('seminars.edit', $seminar->id)}}">
            <span class="material-icons md-18">edit</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-2"><strong>Дата на заниманието:</strong></div>
    <div class="col-10">{{DateTime::createFromFormat('Y-m-d', $seminar->date)->format('m.d.y')}}</div>
</div>
<div class="row">
    <div class="col-2"><strong>Час на заниманието:</strong></div>
    <div class="col-10">{{config('enums.class_periods')[$seminar->period]}}</div>
</div>
<div class="row">
    <div class="col-2"><strong>Форма на обучение:</strong></div>
    <div class="col-10">{{config('enums.edu_form')[$seminar->subject->edu_form]}}</div>
</div>
<div class="row">
    <div class="col-2"><strong>Дисциплина:</strong></div>
    <div class="col-10">{{$seminar->subject->name}}</div>
</div>
<div class="row">
    <div class="col-2"><strong>Код:</strong></div>
    <div class="col-10">{{$seminar->subject->code}}</div>
</div>
<div class="row">
    <div class="col-2"><strong>Група:</strong></div>
    <div class="col-10">{{$seminar->student_group->name}}</div>
</div>
<div class="row">
    <div class="col-2"><strong>Преподавател:</strong></div>
    <div class="col-10">{{$seminar->academic->first_name.' '.$seminar->academic->last_name}}</div>
</div>

</div>
    
@endsection