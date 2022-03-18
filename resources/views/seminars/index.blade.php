@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"><div class="col-10">
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
        @if ($seminars->count())
            <div class="row align-items-center">
                <div class="col-1 text-right border">
                    <strong>Код</strong>
                </div>
                <div class="col border border-start-0">
                    <strong>Име</strong>
                </div>
                <div class="col-2 border border-start-0 text-center">
                    <strong>Преподавател</strong>
                </div>
                <div class="col-2 border border-start-0 text-center">
                    <strong>Час</strong>
                </div>
                <div class="col-2 border border-start-0 text-center">
                    <strong>Дата</strong>
                </div>
                {{-- @if (isset(Auth::user()->id)) --}}
                    <div class="col-1 text-left border border-start-0">
                    <strong> Редакция</strong>
                    </div>
                {{-- @endif                                        --}}
            </div>    
        @else
            <strong>Няма въведени зали</strong>
        @endif
        @foreach ($seminars as $seminar)
            <div class="row">          
                <div class="col-1 border border-top-0 ">
                        {{$seminar->subject->code}} 
                </div>         
                <div class="col border-end border-bottom">
                        {{$seminar->subject->name}} 
                </div>
                <div class="col-2 border-end border-bottom text-center">
                    {{config('enums.acad_positions')[$seminar->academic->acad_position].' '.$seminar->academic->last_name}}
                </div>
                <div class="col-2 border-end border-bottom text-center">
                    {{config('enums.class_periods')[$seminar->period]}}
                </div>
                <div class="col-2 border-end border-bottom text-center">
                    {{$seminar->date}}
                </div>
                <div class="col-1 border-end border-bottom">
                {{-- <div class="col-1 {{isset(Auth::user()->id) ? 'border-start' : ''}}"> --}}
                    {{-- @if (isset(Auth::user()->id)) --}}
                        <div class="d-flex flex-row justify-content-end align-items-end">
                            <a 
                                class="link-info px-0 pt-1 pb-0"
                                href="{{route('rooms.edit', $seminar->id)}}">
                                <span class="material-icons md-18">edit</span>
                            </a>
                            <form action="{{ route('seminars.destroy', $seminar->id) }}" class="" method="POST">
                                @csrf
                                @method('delete')
                                <button 
                                    type="submit"
                                    class="btn btn-sm link-danger px-0 pt-1 pb-0 ms-1">
                                    <span class="material-icons md-18">delete</span>
                                </button>
                            </form>
                        </div>                        
                    {{-- @endif                     --}}
                </div>
            </div>
        @endforeach
    <div class="row mt-3 ms-auto">
        <div class="col-4">
        {{ $seminars->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>
@endsection