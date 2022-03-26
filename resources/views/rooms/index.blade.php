@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"><div class="col-10">
        <h1>Списък на залите</h1>
    </div>
    <div class="col-2 text-right">
        {{-- @if (Auth::user())
            <div class=""> --}}
                <a href="{{route('rooms.create')}}" class="">
                    <span class="material-icons md-18 px-1 pt-0 pb-0 btn btn-sm btn-outline-success">domain_add</span>
                </a>
            {{-- </div>
        @endif --}}
    </div>
        @if ($rooms->count())
        <div class="row align-items-center">
            <div class="col-6 col-md-1 text-right border">
                <strong>No</strong>
            </div>
            <div class="col-6 col-md border border-start-0">
                <strong>Зала</strong>
            </div>
            <div class="col-6 col-md-2 border border-start-0 text-center">
                <strong>Капацитет</strong>
            </div>
            <div class="col-6 col-md-2 border border-start-0 text-center">
                <strong>Интернет</strong>
            </div>
            <div class="col-6 col-md-2 border border-start-0 text-center">
                <strong>Мултимедия</strong>
            </div>
            {{-- @if (isset(Auth::user()->id)) --}}
                <div class="col-6 col-md-1 text-left border border-start-0">
                <strong> Редакция</strong>
                </div>
            {{-- @endif                                        --}}
        </div>    
        @else
            <strong>Няма въведени зали</strong>
        @endif
        @foreach ($rooms as $room)
            <div class="row">             
                <div class="col-6 col-md-1 text-right border border-top-0">
                    {{$loop->iteration}}
                </div>
                <div class="col-6 col-md border-end border-bottom">
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-secondary w-100 py-0">
                        {{$room->room_name}} 
                    </a>
                </div>
                <div class="col-6 col-md-2 border-end border-bottom text-center">
                    {{$room->capacity}}
                </div>
                <div class="col-6 col-md-2 border-end border-bottom text-center">
                    {{config('enums.rooms_internet')[$room->internet]}}
                </div>
                <div class="col-6 col-md-2 border-end border-bottom text-center">
                    {{config('enums.rooms_multimedia')[$room->multimedia]}}
                </div>
                <div class="col-6 col-md-1 border-end border-bottom">
                {{-- <div class="col-1 {{isset(Auth::user()->id) ? 'border-start' : ''}}"> --}}
                    {{-- @if (isset(Auth::user()->id)) --}}
                        <div class="d-flex flex-row justify-content-end align-items-end">
                            <a 
                                class="link-info px-0 pt-1 pb-0"
                                href="{{route('rooms.edit', $room->id)}}">
                                <span class="material-icons md-18">edit</span>
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" class="" method="POST">
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