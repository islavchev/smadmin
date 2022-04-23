@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10">
        <h1>Списък на насрочените занимания</h1>
        </div>
        <div class="col-2 text-right">
            {{-- @if (Auth::user())
                <div class=""> --}}
                    <a href="{{route('seminars.create')}}" class="">
                        <span class="material-icons md-18 px-1 pt-0 pb-0 btn btn-sm btn-outline-success">more_time</span>
                    </a>
                {{-- </div>
            @endif --}}
        </div>
    </div>

    <form action="{{route('seminars.multiple_delete')}}" class="" method="POST">
        @csrf
            
        @if ($seminars->count())
            <div class="row align-items-center border">
                <div class="col-md-2 col-lg-2 text-start d-none d-md-block">
                    <strong>Дата и час</strong>
                </div>
                <div class="col-md-1 col-lg-1 border-start text-start d-none d-md-block">
                    <strong>Група</strong>
                </div>
                <div class="col-md border-start text-start d-none d-md-block">
                    <strong>Дисциплина</strong>
                </div>
                <div class="col-md-2 border-start text-start d-none d-md-block">
                    <strong>Преподавател</strong>
                </div>
                {{-- @if (isset(Auth::user()->id)) --}}
                    <div class="col-md-2 border-start text-start d-none d-md-block">
                    <strong> Редакция</strong>
                    </div>
                {{-- @endif --}}
            </div>    
        @else
            <strong>Няма въведени занимания</strong>
        @endif

        @foreach ($seminars as $seminar)                
            @php
                $day_of_week = DateTime::createFromFormat('Y-m-d', $seminar->date)->format('w');
            @endphp

            <div class="row border-end border-bottom">
                <div class="col-5 text-end d-block d-md-none border-start" >
                    <strong>Дата и час</strong>
                </div>
                <div class="col-7 col-md-2 col-lg-2 text-start border-start">
                    <div class="row">
                        <div class="col-2 {{$day_of_week == 0 || $day_of_week == 6 ? 'text-danger' : ''}} ">
                            <strong>{{config('enums.weekdays')[$day_of_week]}}</strong>
                        </div>
                        <div class="col-10">
                            {{DateTime::createFromFormat('Y-m-d', $seminar->date)->format('d.m.y')}}
                        </div>
                    </div>
                    <div class="row"><div class="col">{{config('enums.class_periods')[$seminar->period]}}</div></div>
                </div>    
                <div class="col-5 text-end d-block d-md-none border-start">
                    <strong>Група</strong>
                </div>     
                <div class="col-7 col-md-1 col-lg-1 border-start text-start">
                    {{$seminar->group->name}} 
                </div>    
                <div class="col-5 text-end d-block d-md-none border-start">
                    <strong>Дисциплина</strong>
                </div>     
                <div class="col-7 col-md-5 border-start text-start">
                        {{$seminar->subject->name}} 
                </div>   
                <div class="col-5 text-end d-block d-md-none border-start">
                    <strong>Преподавател</strong>
                </div>
                <div class="col-7 col-md-2 border-start text-start"> 
                    @isset($seminar->academic)
                    {{config('enums.acad_positions')[$seminar->academic->acad_position].' '.$seminar->academic->last_name}} 
                    @else
                    N/A
                    @endisset
                </div>
                {{-- <div class="col-1 {{isset(Auth::user()->id) ? 'border-start' : ''}}"> --}}
                    {{-- @if (isset(Auth::user()->id)) --}}
                <div class="col-5 text-end d-block d-md-none  border-start">
                    <strong> Редакция</strong>
                    </div>
                    <div class="col-7 col-md-2 col-lg-2 border-start">
                        <div class="row align-items-end p-0">
                            <div class="col text-end p-0">
                            <input type="checkbox" name="selected_seminars[]" id="checkbox_{{$seminar->id}}" class="form-check-input" value="{{$seminar->id}}">
                            <a 
                                class="link-info p-0"
                                href="{{route('seminars.edit', $seminar->id)}}">
                                <span class="material-icons md-18">edit</span>
                            </a>
                        </div>
                        {{-- <div class="col text-start p-0">
                            <form action="{{ route('seminars.destroy', $seminar->id) }}" class="" method="POST">
                                @csrf
                                @method('delete')
                                <button 
                                    type="submit"
                                    class="btn btn-sm link-danger p-0 ms-1">
                                    <span class="material-icons md-18">delete</span>
                                </button>
                            </form>
                        </div> --}}
                    </div>                 
                </div>       
                {{-- @endif                     --}}
            </div>
        @endforeach
    <div class="row mt-3">
        <div class="col-6">
        {{ $seminars->links("pagination::bootstrap-4") }}
        </div>
        <div class="col-6 ms-auto text-end">
            <button type="submit" class="btn btn-danger btn-sm">Изтрий избраните</button>
        </div>
    </div>

    </form>
</div>
@endsection