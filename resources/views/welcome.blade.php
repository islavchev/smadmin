@extends('layouts.app')
@section('content')
<div class="container">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{-- <div class="row">
        <div class="col-md-6">
            <h2>Специалност "Спортен мениджмънт"</h2>
            <h3>Администрация</h3>
        </div>
        <div class="col-md-6">
            <img src="https://nsa-management.com/images/Dept-MIS-Header-Logosa.png" alt="Management and history of sport department's logo" width="50%" class="float-right">    
        </div>
    </div> --}}

    <div class="row">
        <a href="{{route('rooms.index')}}" class="btn btn-outline-secondary col-sm-2 col-md-1 me-2">Зали</a>
        <a href="{{route('student_groups.index')}}" class="btn btn-outline-secondary col-sm-2 col-md-1 me-2">Групи</a>        
        <a href="{{route('academics.index')}}" class="btn btn-outline-secondary col-sm-3 col-md-3 col-lg-2 me-2">Преподаватели</a>
        <a href="{{route('seminars.create')}}" class="btn btn-outline-success col-sm-1 ms-auto pb-0"><span class="material-icons">more_time</span></a>
        <a href="{{route('seminars.index')}}" class="btn btn-outline-warning col-sm-1 ms-2 pb-0"><span class="material-icons">pending_actions</span></a>
    </div>
    <div class="row">
        <div class="col-lg-1 col-md-3 col-sm-12 mt-3 border border-secondary h-auto" style="background-color:lightgray">
            <div class="row text-center"><strong>Period</strong></div>
            @foreach ( config('enums.class_periods') as $key => $class_period)
                <div class="row border-top border-secondary text-center Row{{$loop -> iteration}} align-items-center"><strong>{{ $class_period }}</strong></div>
            @endforeach
        </div>
        @foreach ($week_array as $weekday)
        <div class="col-lg col-md-3 col-sm-12 mt-3 border border-start-0 border-secondary" style="{{ $loop->even ? "background-color:lightgray;":"" }} {{$weekday==$today ? "background-color:lightblue" : "" }}">
            <div class="row text-center" style="background-color: lightgray"><strong>{{config('enums.weekdays')[$weekday_array[$loop->iteration-1]]}} {{ date('d.m.y', strtotime($weekday)) }}</strong></div>
            @foreach ( config('enums.class_periods') as $key => $class_period)
                <div class="row border-top border-secondary justify-content-center text-center Row{{$loop -> iteration}}">
                    <div class="col-1 d-block d-md-none">
                        {{$loop->iteration}}
                    </div>
                    @php
                        $period = $loop->iteration;
                        $seminars_count = 0;
                    @endphp
                    <div class="col">
                @foreach ($seminars->sortBy('seminar_period')->sortBy('seminar_date') as $seminar)
                    @if ($seminar->seminar_date == $weekday && $seminar->seminar_period == $period)
                        <div class="row {{$seminars_count>0 ? 'border-top':''}}" style="font-size:0.7rem">
                            <div class="col p-0">{{$seminar->seminar_code}}</div>
                            <div class="col p-0"><a href="{{route('academics.show', $seminar->academic)}}">{{$seminar->academic->abbreviation}}</a></div> 
                            <div class="col p-0"><a href="{{route('rooms.show', $seminar->room)}}">{{$seminar->room->room_name}}</a></div>
                            <div class="col p-0">{{$seminar->student_group->name}}</div>
                        </div>
                        @php
                            $seminars_count++;
                        @endphp
                    @endif
                @endforeach
            </div>
                </div>
            @endforeach
        </div>
        @endforeach        
    </div>
</div>

<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="application/javascript">
    $(document).ready(function() {
        var periods = @json(config('enums.class_periods'));
        $.each(periods, function( index, value ) {
            var maxHeightRow = -1;
            $('.Row'+index).each(function() {
                maxHeightRow = maxHeightRow > $(this).height() ? maxHeightRow : $(this).height();
            });
            $('.Row'+index).each(function() {
                $(this).height(maxHeightRow);
            });
        });
    });  
</script>
@endsection