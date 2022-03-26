@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h1>Конфликти в планирането на заниманията</h1>
    </div>
    @foreach ($conflict_seminars as $seminars)
        <div class="row border-bottom">
            <div class="col">
                @foreach ($seminars as $seminar)
                    @if ($loop->first)
                        <div class="row border">
                            <strong>{{DateTime::createFromFormat('Y-m-d', $seminar->date)->format('d.m.Y').' / '.config('enums.class_periods')[$seminar->period]}}</strong>
                        </div>
                    @endif
                    <div class="row border-bottom border-start">
                        <div class="col-md-6">
                            {{$seminar->subject->name}}
                        </div>
                        <div class="col-md-3">
                            {{$seminar->academic->first_name.' '.$seminar->academic->last_name}}
                        </div>
                        <div class="col-md-1">
                            {{$seminar->student_group->name}}
                        </div>
                        <div class="col-md-1">
                            {{$seminar->room->room_name}}
                        </div>
                        <div class="col-md-1 border-end">
                            <div class="row p-0">
                                <div class="col text-end p-0">
                                <a 
                                    class="link-info"
                                    href="{{route('seminars.edit', $seminar->id)}}">
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
                    </div>
                @endforeach
            </div>
        </div>    
    @endforeach
</div>
@endsection