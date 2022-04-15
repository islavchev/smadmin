@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-5">
            <div class="col-6">
                <h1>Списък на студентите</h1>
            </div>
            <div class="col-6 text-end">
                {{-- @if (Auth::user()) --}}
                    <a href="{{route('students.create')}}" class="ms-auto">
                        <span class="material-icons md-18 px-1 pt-0 pb-0 btn btn-sm btn-outline-success">person_add</span>                   
                    </a>
                {{-- @endif --}}
            </div>
        </div>
        @foreach ($students as $student)
        <div class="row border border-bottom-0">
            <div class="col-8"> <img src="{{asset('/storage/images/'.$student->image)}}" alt="" class="{{$student->image === 'student.png'? '': 'rounded-circle'}} m-1" width="48px">
                <a href="{{route('students.show', $student->id)}}" class="">
                    {{ $student->first_name }} {{ $student->last_name }}
                </a>

{{--            <div class="">
                <p class="">
                    тел.: <strong>{{ $student->phone }}</strong> | ел.поща: <strong>{{ $student->email }}</strong> | кабинет: <strong>{{ $student->room_no }}</strong>
                </p>
                </div> --}}
            </div>
            <div class="col-4">
                {{-- @if (isset(Auth::user()->id)) --}}
                    <div class="d-flex flex-row justify-content-end">
                        <a 
                            class="btn btn-link link-info px-0 pb-0 pt-1 me-2"
                            href="{{ route('students.edit', $student->id) }}">
                            <span class="material-icons md-18">
                                edit
                                </span>
                        </a>

                        <form action="{{ route('students.destroy', $student->id) }}" class="" method="POST">
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

    {{ $students->links() }}

</div>
@endsection