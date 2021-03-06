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
        @foreach ($academics as $academic)
        <div class="row">
            <div class="col-8"> 
                <img src="{{asset('/storage/images/'.$academic->image)}}" alt="" class="h-50 {{$academic->image === 'academic.png'? '': 'rounded-circle'}}"> 
                <a href="{{route('academics.show', $academic->id)}}" class="">
                    {{ config('enums.acad_positions')[$academic->acad_position] }} {{ $academic->first_name }} {{ $academic->last_name }}, {{ config('enums.acad_titles')[$academic->acad_title] }}
                </a>

{{--            <div class="">
                <p class="">
                    тел.: <strong>{{ $academic->phone }}</strong> | ел.поща: <strong>{{ $academic->email }}</strong> | кабинет: <strong>{{ $academic->room_no }}</strong>
                </p>
                </div> --}}
            </div>
            <div class="col-4">
                {{-- @if (isset(Auth::user()->id)) --}}
                    <div class="d-flex flex-row justify-content-end align-bottom">
                        <a 
                            class="btn btn-link link-info px-0 pb-0 pt-1 me-2"
                            href="{{ route('academics.edit', $academic->id) }}">
                            <span class="material-icons md-18">
                                edit
                                </span>
                        </a>

                        <form action="{{ route('academics.destroy', $academic->id) }}" class="" method="POST">
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