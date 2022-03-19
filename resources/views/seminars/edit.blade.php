@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mt-2">
        <h1>Редактиране на занимание</h1>
    </div>

    <form action="{{route('seminars.update',$seminar->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mt-2">
            <div class="col-md-2"><label for="date"><strong>Дата на заниманието:</strong></label></div>
            <div class="col-md-10"><input type="date" name="date" id="date" class="form-control form-control-sm" value="{{$seminar->date}}"></div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2"><label for="period"><strong>Час на заниманието:</strong></label></div>
            <div class="col-md-10"><select name="period" id="period" class="form-select form-select-sm">
                @foreach (config('enums.class_periods') as $period_key => $period)
                    <option value="{{$period_key}}" {{$seminar->period == $period_key ? 'selected':''}}>{{$period}}</option>
                @endforeach    
            </select></div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2"><label for="subject_id"><strong>Дисциплина:</strong></label></div>
            <div class="col-md-10">
                <select name="subject_id" id="subject_id" class="form-select form-select-sm">
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}" {{$subject->id == $seminar->subject->id ? 'selected':''}}>{{$subject->name.' - '.config('enums.edu_form')[$subject->edu_form]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2"><label for="student_group_id"><strong>Група:</strong></label></div>
            <div class="col-md-10">
                <select name="student_group_id" id="student_group_id" class="form-select form-select-sm">
                    @foreach ($student_groups as $group)
                        <option value="{{$group->id}}" {{$group->id == $seminar->student_group->id ? 'selected':''}}>
                            {{$group->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2"><label for="academic"><strong>Преподавател:</strong></label></div>
            <div class="col-md-10">
                <select name="academid" id="academic" class="form-select form-select-sm">
                    @foreach ($academics as $academic)
                        <option value="{{$academic->id}}" {{$academic->id == $seminar->academic->id ? 'selected':''}}>
                            {{config('enums.acad_positions')[$academic->acad_position].' '.$academic->first_name.' '.$academic->last_name.', '.config('enums.acad_titles')[$academic->acad_title]}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-sm mt-3">
            Запиши
        </button>        
    </form>  
</div>    
@endsection