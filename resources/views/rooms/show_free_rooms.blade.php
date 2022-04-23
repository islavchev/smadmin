@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-10">
            <h1>Свободни зали</h1>
            <h4>Дата: {{DateTime::createFromFormat('Y-m-d', $date)->format('d.m.y')}}</h4>
            <h4>Час: {{$period == 0 ? 'Всички часове' : config('enums.class_periods')[$period]}}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                Свободни зали:
            </div>
            @if ($period == 0)
                @foreach (config('enums.class_periods') as $class => $check_period)
                        <strong>{{$check_period}}</strong>
                    @foreach ($free_rooms[$class] as $room)
                        <div class="row">
                            {{$room->room_name}}
                        </div>
                    @endforeach                            
                @endforeach
            @else
                @foreach ($free_rooms as $room)
                    <div class="row">
                        {{$room->room_name}}
                    </div>
                @endforeach                
            @endif
        </div>
    </div>

</div>
    
@endsection