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
                <div class="col-md-2 col-lg-1 border text-start d-none d-md-block">
                    <strong>Дата</strong>
                </div>
                <div class="col-md-2 border border-start-0 text-start d-none d-md-block">
                    <strong>Час</strong>
                </div>
                <div class="col-md-2 col-lg-1 text-start border border-start-0 d-none d-md-block">
                    <strong>Код</strong>
                </div>
                <div class="col-md border border-start-0 text-start d-none d-md-block">
                    <strong>Име</strong>
                </div>
                <div class="col-md-2 border border-start-0 text-start d-none d-md-block">
                    <strong>Преподавател</strong>
                </div>
                {{-- @if (isset(Auth::user()->id)) --}}
                    <div class="col-md-2 col-lg-1 text-start border border-start-0 d-none d-md-block">
                    <strong> Редакция</strong>
                    </div>
                {{-- @endif --}}
            </div>    
        @else
            <strong>Няма въведени зали</strong>
        @endif
        @foreach ($seminars as $seminar)
            <div class="row">
                <div class="col-6 border border-end-0 text-start d-block d-md-none">
                    <strong>Дата</strong>
                </div>
                <div class="col-6 col-md-2 col-lg-1 border border-top-0 text-end">
                    {{DateTime::createFromFormat('Y-m-d', $seminar->date)->format('d.m.y')}}
                </div> 
                <div class="col-6 border border-top-0 text-start d-block d-md-none">
                    <strong>Час</strong>
                </div>
                <div class="col-6 col-md-2 border-end border-bottom text-end">
                    {{config('enums.class_periods')[$seminar->period]}}
                </div>    
                <div class="col-6 text-start border border-start-0 d-block d-md-none">
                    <strong>Код</strong>
                </div>     
                <div class="col-6 col-md-2 col-lg-1 border-end border-bottom text-end">
                        {{$seminar->subject->code}} 
                </div>    
                <div class="col-6 border border-start-0 text-start d-block d-md-none">
                    <strong>Име</strong>
                </div>     
                <div class="col-6 col-md border-end border-bottom text-end">
                        {{$seminar->subject->name}} 
                </div>
                <div class="col-6 border border-start-0 text-start d-block d-md-none">
                    <strong>Преподавател</strong>
                </div>
                <div class="col-6 col-md-2 border-end border-bottom text-end">
                    {{config('enums.acad_positions')[$seminar->academic->acad_position].' '.$seminar->academic->last_name}}
                </div>
                {{-- <div class="col-1 {{isset(Auth::user()->id) ? 'border-start' : ''}}"> --}}
                    {{-- @if (isset(Auth::user()->id)) --}}
                <div class="col-6 text-start border border-start-0 d-block d-md-none">
                    <strong> Редакция</strong>
                    </div>
                    <div class="col-6 col-md-2 col-lg-1 border-end border-bottom">
                        <div class="row align-items-end p-0">
                            <div class="col text-end p-0">
                            <a 
                                class="link-info p-0"
                                href="{{route('rooms.edit', $seminar->id)}}">
                                <span class="material-icons md-18">edit</span>
                            </a>
                        </div>
                        <div class="col text-start p-0">
                            <form action="{{ route('seminars.destroy', $seminar->id) }}" class="" method="POST">
                                @csrf
                                @method('delete')
                                <button 
                                    type="submit"
                                    class="btn btn-sm link-danger p-0 ms-1">
                                    <span class="material-icons md-18">delete</span>
                                </button>
                            </form>
                        </div>
                        </div>                 
                    </div>       
                    {{-- @endif                     --}}
            </div>
        @endforeach
    <div class="row mt-3 ms-auto">
        <div class="col-4">
        {{ $seminars->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>
@endsection