@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-5">
            <div class="col-6">
                <h1>Списък на преподавателите</h1>
            </div>
            <div class="col-6 text-end">
                {{-- @if (Auth::user()) --}}
                    <a href="{{route('academics.create')}}" class="ms-auto">
                        <span class="material-icons md-18 px-1 pt-0 pb-0 btn btn-sm btn-outline-success">person_add</span>                   
                    </a>
                {{-- @endif --}}
            </div>
        </div>
        @foreach ($academics as $teacher)
        <div class="row">
            <div class="col-8">
                <a href="{{route('academics.show', $teacher->id)}}" class="">
                    {{ config('enums.acad_positions')[$teacher->acad_position] }} {{ $teacher->first_name }} {{ $teacher->last_name }}, {{ config('enums.acad_titles')[$teacher->acad_title] }} 
                </a>

{{--            <div class="">
                <p class="">
                    тел.: <strong>{{ $teacher->phone }}</strong> | ел.поща: <strong>{{ $teacher->email }}</strong> | кабинет: <strong>{{ $teacher->room_no }}</strong>
                </p>
                </div> --}}
            </div>
            <div class="col-4">
                {{-- @if (isset(Auth::user()->id)) --}}
                    <div class="d-flex flex-row justify-content-end align-bottom">
                        <a 
                            class="btn btn-link link-info px-0 pb-0 pt-1 me-2"
                            href="{{ route('academics.edit', $teacher->id) }}">
                            <span class="material-icons md-18">
                                edit
                                </span>
                        </a>

                        <form action="{{ route('academics.destroy', $teacher->id) }}" class="" method="POST">
                            @csrf
                            @method('delete')
                            <button 
                                type="submit"
                                class="btn btn-link link-danger px-0 pb-0 pt-1"><span class="material-icons md-18">
                                    delete_forever
                                    </span>
                            </button>
                        </form>
                    </div>
                    
                {{-- @endif --}}

                
            </div>
        </div>
        @endforeach

    {{ $academics->links() }}

</div>
@endsection