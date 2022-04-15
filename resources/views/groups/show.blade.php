@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row align-items-center">
        <div class="col-8">
            <h2 class="">Група: {{$group->name}}</h2>
        </div>
    </div> 
    <div class="row align-items-center mb-1 mt-3">
        <div class="col-11">
            <h3>Студенти в групата:</h3>
        </div>
        <div class="col-1 text-center">
            @if (isset(Auth::user()->id))
            <a href="{{route('groups.addStudents',$group)}}" class="btn btn-sm btn-outline-success m-0 px-1 pt-1 pb-0"> <span class="material-icons md-18 text-success">group_add</span></a>
            @endif
        </div>
    </div>
    @if($group->students->isEmpty())
        <div class="row align-items-center"><div class="col-md-1 text-center"><strong>Няма</strong></div></div>
    @else    
        <div class="row align-items-center border border-left-0">
            <div class="col border-left text-center"><strong>Имена</strong></div>
            <div class="col-1 text-center border-left"><strong>Премахни</strong></div>
        </div> 
    @endif
    @foreach ($group->students->sortBy('fac_no') as $student)
        <div class="row border border-left-0 border-top-0">
            <div class="col border-left mh-100 d-flex align-items-center justify-content-center">
                <a href="{{route('students.show',$student->id)}}">
                    @if (isset(Auth::user()->id))
                        {{ $student->first_name }} {{ $student->last_name }}
                    @else
                        {{ mb_substr($student->first_name, 0,1,'utf-8') }}. {{ mb_substr($student->last_name, 0,1,'utf-8') }}.
                    @endif
                </a>
            </div>
            <div class="col-1 text-center border-left mh-100 d-flex align-items-center justify-content-center">
                <form action="{{route('groups.detachStudent',[$group->id, $student->id])}}" method="POST">
                    @csrf
                    @method('delete')
                    <button 
                    type="submit"
                    class="btn btn-outline-danger btn-sm pb-0 px-1 pt-1 m-1">
                    <span class="material-icons md-18 text-danger">person_remove</span>
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>
    
@endsection