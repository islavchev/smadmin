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

    <div class="row p-2 p-md-0">
        <div class="col-lg-1 col-md-3 col-sm-6 mt-3 border border-secondary h-auto" style="background-color:lightgray">
            <div class="row text-center"><strong>Period</strong></div>
            @foreach ( config('enums.class_periods') as $key => $class_period)
                <div class="row border-top border-secondary text-center Row{{$loop -> iteration}} align-items-center">
                    <div class="col-1 d-block d-md-none">
                        {{$loop->iteration}}
                    </div>
                    <div class="col">
                    <strong>{{ $class_period }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
        @foreach ($week_array as $weekday)
        @if ($loop->iteration < 6)            
        <div class="col-lg col-md-3 col-sm-6 mt-3 border border-start-0 border-secondary" style="{{ $loop->even ? "background-color:lightgray;":"" }} {{$weekday==$today ? "background-color:lightblue" : "" }}">
            <div class="row text-center" style="background-color: lightgray"><strong>{{date('d.m.y', DateTime::createFromFormat('Y-m-d',$weekday)->getTimestamp()).' ('.config('enums.weekdays')[$weekday_array[$loop->iteration-1]].')'}}</strong></div>
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
                        @if ($seminars)
                            @foreach ($seminars->sortBy('period')->sortBy('date') as $seminar)
                            @if ($seminar->date == $weekday && $seminar->period == $period)
                                <div class="row {{$seminars_count>0 ? 'border-top':''}}" style="font-size:0.7rem">
                                    <div class="col py-0 ps-1 pe-0">{{$seminar->subject->code}}</div>
                                    <div class="col py-0 px-1">
                                        @isset($seminar->academic)
                                        <a href="{{route('academics.show',$seminar->academic)}}" class="link-success">{{$seminar->academic->abbreviation}}</a>
                                        @else
                                            N/A
                                        @endisset
                                    </div> 
                                    <div class="col p-0">
                                        @isset($seminar->room)
                                            <a href="{{route('rooms.show', $seminar->room)}}" class="link-success">{{$seminar->room->room_name}}</a>
                                        @else
                                            N/A
                                        @endisset
                                    </div> 
                                        
                                    <div class="col p-0">{{$seminar->group->name}}</div>
                                </div>
                                @php
                                    $seminars_count++;
                                @endphp
                            @endif
                            @endforeach
                        @endif               
                    </div>
                </div>
            @endforeach
        </div>

        @else
            @if ($loop->iteration > 5)
            <div class="col-lg col-md-3 col-sm-6 mt-3 border border-start-0 border-secondary" style="{{ $loop->even ? "background-color: #fdf5e6 ;":"background-color: #ffe4e1;" }} {{$weekday==$today ? "background-color:lightblue" : "" }}">
                <div class="row text-center" style="background-color: lightgray"><strong>{{date('d.m.y', DateTime::createFromFormat('Y-m-d',$weekday)->getTimestamp()).' ('.config('enums.weekdays')[$weekday_array[$loop->iteration-1]].')'}}</strong></div>
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
                            @if ($seminars)
                                @foreach ($seminars->sortBy('period')->sortBy('date') as $seminar)
                                @if ($seminar->date == $weekday && $seminar->period == $period)
                                    <div class="row {{$seminars_count>0 ? 'border-top':''}}" style="font-size:0.7rem">
                                        <div class="col py-0 ps-1 pe-0">{{$seminar->subject->code}}</div>
                                        <div class="col py-0 px-1">
                                            @isset($seminar->academic)
                                            <a href="{{route('academics.show',$seminar->academic)}}" class="link-success">{{$seminar->academic->abbreviation}}</a>
                                            @else
                                                N/A
                                            @endisset
                                        </div> 
                                        <div class="col p-0">
                                            @isset($seminar->room)
                                                <a href="{{route('rooms.show', $seminar->room)}}" class="link-success">{{$seminar->room->room_name}}</a>
                                            @else
                                                N/A
                                            @endisset
                                        </div> 
                                            
                                        <div class="col p-0">{{$seminar->group->name}}</div>
                                    </div>
                                    @php
                                        $seminars_count++;
                                    @endphp
                                @endif
                                @endforeach
                            @endif               
                        </div>
                    </div>
                @endforeach
            </div>      
            @endif 
        @endif

        @endforeach        
    </div>
</div>

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