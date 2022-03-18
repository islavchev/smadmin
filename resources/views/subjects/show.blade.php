@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
    <div class="col-10">
        <h1>Детайли за дисциплина</h1>
    </div>
    <div class="col-2">
        <a 
            class="link-info px-0 pt-1 pb-0"
            href="{{route('subjects.edit', $subject->id)}}">
            <span class="material-icons md-18 btn-sm">edit</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-2 text-end"><strong>Код:</strong></div>
    <div class="col-10">{{$subject->code}}</div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Име на дисциплината:</strong></div>
    <div class="col-10">{{$subject->name}}</div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Форма на обучение:</strong></div>
    <div class="col-10">{{config('enums.edu_form')[$subject->edu_form]}} </div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Вид на дисциплината:</strong></div>
    <div class="col-10">{{config('enums.subject_types')[$subject->type]}}</div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Лекции:</strong></div>
    <div class="col-10">{{$subject->lecture_hours}}</div>
</div>
<div class="row">
    <div class="col-2 text-end"><strong>Упражнения:</strong></div>
    <div class="col-10">{{$subject->seminar_hours}}</div>
</div>

<div class="row">
    <div class="col-2 text-end"><strong>Забележка:</strong></div>
    <div class="col-10">{{$subject->note}}</div>
</div>

</div>
    
@endsection