@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm-10">
            <h2 class="">добавяне на 
                {{-- {{$student->fac_no}} @if (isset(Auth::user()->id))
                {{ $student->first_name }} {{ $student->last_name }}
            @else --}}
                {{ mb_substr($student->first_name, 0,1,'utf-8') }}. {{ mb_substr($student->last_name, 0,1,'utf-8') }}.
            {{-- @endif
            </h2>
            <div class="">
                Специалност: <strong>{{ $student->major->name }}</strong>                 @if ($student->second_major)
                | Нова специалност: <strong>{{$student->second_major->name }}</strong>
                @endif
            </div> --}}
        </div>
    </div> 
    <div class="row align-items-center">
        <div class="col-md-6 mt-4">
            <h3>Групи:</h3>
        </div>
        <div class="col-md-6 mt-4">
            <h3>Групи, в които е записан:</h3>
        </div>
    </div>
    <div class="row align-items-top">

        <div class="col-md-6 mt-4">
            <?php  $counter = 1 ?>
            <form action="{{route('students.attachGroups',$student)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @foreach ($groups as $group)
                    @if ($student->groups->contains($group))
                    @else
                        <div class="row align-items-center">
                            <div class="col-md-1 text-right"><input type="checkbox" name="groupIds[]" value="{{$group->id}}" class="form-check-input"> {{$counter}}</div>
                            <div class="col-md-5 text-center">{{$group->name}}</div> 
                        </div>                  
                        <?php  $counter++ ?>
                    @endif
                @endforeach
                <button type="submit" class="btn btn-sm btn-success">Запиши в избраните групи</button>
             </form>
        </div>

        <div class="col-md-6 mt-4">
            @foreach ($student->groups as $group)
                <div class="row align-items-center">
                    <div class="col-md-1 text-right">{{$loop->iteration}}</div>
                    <div class="col-md-5 text-center">{{$group->name}}</div>
                </div>
            @endforeach
        </div>

</div>
@endsection