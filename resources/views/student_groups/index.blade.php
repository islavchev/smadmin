@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-5">
            <div class="col-6">
                <h1>Списък на групите</h1>
            </div>
            <div class="col-6 text-end">
                {{-- @if (Auth::user()) --}}
                    <a href="{{route('student_groups.create')}}" class="ms-auto">
                        <span class="material-icons md-18 px-1 pt-0 pb-0 btn btn-sm btn-outline-success">group_add</span>                   
                    </a>
                {{-- @endif --}}
            </div>
        </div>
        <div class="d-flex flex-row flex-wrap">
        @foreach ($student_groups as $group)
            <div class="col-sm-2 d-flex border ps-2 pt-1 align-items-center">
                    {{ $group->name }}

{{--            <div class="">
                <p class="">
                    тел.: <strong>{{ $teacher->phone }}</strong> | ел.поща: <strong>{{ $teacher->email }}</strong> | кабинет: <strong>{{ $teacher->room_no }}</strong>
                </p>
                </div> --}}
            {{-- </div> --}}
            {{-- <div class="col-4"> --}}
                {{-- @if (isset(Auth::user()->id)) --}}
                    {{-- <div class="d-flex flex-row justify-content-end align-bottom"> --}}
                        {{-- <a 
                            class="btn btn-link link-info px-1 pb-0 pt-1"
                            href="{{ route('student_groups.edit', $group->id) }}">
                            <span class="material-icons md-18">
                                edit
                                </span>
                        </a> --}}

                        <form action="{{ route('student_groups.destroy', $group->id) }}" class="" method="POST">
                            @csrf
                            @method('delete')
                            <button 
                                type="submit"
                                class="btn btn-link link-danger px-0 pb-0 pt-1"><span class="material-icons md-18">
                                    delete_forever
                                    </span>
                            </button>
                        </form>
                    {{-- </div> --}}
                    
                {{-- @endif --}}

                
            </div>
        @endforeach
    </div>

    {{ $student_groups->links() }}

</div>
@endsection