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
                    <span class="material-icons md-24 px-1 pt-0 pb-0 link-success">more_time</span>
                </a>
            {{-- </div>
        @endif --}}
    </div>
        @if ($seminars->count())
        <div class="row align-items-center">
            <div class="col-1 text-right border">
                <strong>No</strong>
            </div>
            <div class="col border border-start-0">
                <strong>Зала</strong>
            </div>
            <div class="col-2 border border-start-0 text-center">
                <strong>Капацитет</strong>
            </div>
            <div class="col-2 border border-start-0 text-center">
                <strong>Интернет</strong>
            </div>
            <div class="col-2 border border-start-0 text-center">
                <strong>Мултимедия</strong>
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
                        {{$seminar->seminar_code}} 
                </div>         
                <div class="col border-end border-bottom">
                        {{$seminar->seminar_name}} 
                </div>
                <div class="col-2 border-end border-bottom text-center">
                    {{$seminar->seminar_code}}
                </div>
                <div class="col-2 border-end border-bottom text-center">
                    {{config('enums.class_periods')[$seminar->seminar_period]}}
                </div>
                <div class="col-2 border-end border-bottom text-center">
                    {{$seminar->seminar_date}}
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
                            <form action="{{ route('rooms.destroy', $seminar->id) }}" class="" method="POST">
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
   </div>
</div>
@endsection