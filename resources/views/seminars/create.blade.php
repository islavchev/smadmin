@extends('layouts.app')

@section('content')
<div class="container">
    
<div class="row">
    <div class="col-10"><h1>Насрочване на занимания</h1></div>
</div>
<form action="{{route('seminars.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-md-6 col-12">
            <label for="subject_id">Дисциплина:</label>
            <select name="subject_id" id="subject_id" class="form-select form-select-sm">
                <option value="" selected disabled>Изберете дисциплина:</option>
                @foreach ($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->name.' - '.config('enums.edu_form')[$subject->edu_form]}}</option>
                @endforeach
            </select>
        </div> 
        <div class="col-md-3">
            <label for="group_id">Група:</label>
            <select type="text" name="group_id" id="group_id" class="form-select form-select-sm">
                <option value="" class="" disabled selected>изберете група</option>
                @foreach ($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="col-md-2 col-8">
            <label for="seminar_type">Вид заетост:</label>
            <select type="text" name="seminar_type" id="academic" class="form-select form-select-sm">
                <option value="" class="" disabled selected>вид на заетостта...</option>
                @foreach (config('enums.seminar_types') as $seminar_type)
                    <option value="{{$loop->iteration}}">{{$seminar_type}}</option>
                @endforeach
            </select>
        </div> --}}
    </div>
    <div class="row mt-3">
        <div class="col-md-2 col-5">
            <div class="row border">
                <div class="col-12 text-center">
                <strong>Час\Ден</strong>
                </div>
            </div>
            @foreach (config('enums.class_periods') as $period)
                <div class="row border border-top-0">
                    <div class="col-12 text-center">
                        {{$period}}
                    </div>
                </div>
            @endforeach
        </div>
        @foreach (config('enums.weekdays') as $weekday)
        @if ($loop->first==false)
            <div class="col-md-1 col-1">
                <div class="row border border-start-0"> 
                    <div class="col-12 text-center ps-1">               
                        {{$weekday}}
                    </div>
                </div>
                @for ($day_period = 1; $day_period < count(config('enums.class_periods'))+1; $day_period++)
                    <div class="row border-bottom border-end">
                        <div class="col-12 text-center">
                            <input class="form-check-input" type="checkbox" name="classes[{{$loop->iteration-1}}][]" value="{{$day_period}}" id="flexCheckDefault{{$loop->iteration-1}}-{{$day_period}}">
                        </div>
                    </div>
                @endfor
            </div>
        @endif
        @if ($loop->last)
            <div class="col-md-1 col-1">
                <div class="row border border-start-0"> 
                    <div class="col-12 text-center ps-1">               
                        {{config('enums.weekdays')[0]}}
                    </div>
                </div>
                @for ($sunday_period = 1; $sunday_period < count(config('enums.class_periods'))+1; $sunday_period++)
                    <div class="row border-bottom border-end">
                        <div class="col-12 text-center">
                            <input class="form-check-input" type="checkbox" name="classes[0][]" value="{{$sunday_period}}" id="flexCheckDefault0-{{$sunday_period}}">
                        </div>
                    </div>
                @endfor
            </div>
        @endif   
        @endforeach   
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <label for="date_start">Начална дата:</label>
            <input type="date" name="date_start" id="date_start" class="form-control form-control-sm">
        </div>
        <div class="col-md-4 offset-md-1">
            <label for="date_end">Крайна дата:</label>
            <input type="date" name="date_end" id="date_end" class="form-control form-control-sm">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4 col-12">
            <label for="academic_id">Преподавател: <span class="badge bg-warning text-dark">незадължително</span> </label>
            <select type="text" name="academic_id" id="academic_id" class="form-select form-select-sm">
                <option value="" class="" disabled selected>изберете преподавател</option>
                @foreach ($academics as $academic)
                    <option value="{{$academic->id}}">{{config('enums.acad_positions')[$academic->acad_position].' '.$academic->first_name.' '.$academic->last_name.', '.config('enums.acad_titles')[$academic->acad_title]}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 offset-md-1">
            <label for="room_id">Зала: <span class="badge bg-warning text-dark">незадължително</span> </label>
            <select type="text" name="room_id" id="room_id" class="form-select form-select-sm">
                <option value="" class="" disabled selected>изберете зала</option>
                @foreach ($rooms as $room)
                    <option value="{{$room->id}}">{{$room->room_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
        <button type="submit" class="btn btn-success btn-sm mt-3">
            Запиши
        </button>
    
</form>  
</div>  
<script type="application/javascript">
$(function() {
    $('#date_start').change(function() {
        var fromDateValue = $(this).val();
        var toDateValue = $('#date_end').val();
        var newToDate = toDateValue;
        if (fromDateValue > toDateValue) {
            newToDate = fromDateValue;
        }
        $('#date_end').val(newToDate);
    });
    $('#date_end').change(function() {
        var fromDateValue = $('#date_start').val();
        var toDateValue = $(this).val();
        var newFromDate = fromDateValue;
        if (fromDateValue > toDateValue) {
            newFromDate = toDateValue;
        }
        $('#date_start').val(newFromDate);
    });
})
</script>
@endsection