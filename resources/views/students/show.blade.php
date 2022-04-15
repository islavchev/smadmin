@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-10">
            <h1>Детайли за студент</h1>
        </div>
        <div class="col-2">
            <a 
                class="link-info px-0 pt-1 pb-0"
                href="{{route('students.edit', $student->id)}}">
                <span class="material-icons md-18">edit</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-2">
            <div class="row">
                <div class="col text-center">
                    <img src="{{asset('/storage/images/'.$student->image)}}" alt="" class=""> <br>
                </div>
            </div>
            <div class="d-flex col justify-content-evenly"> 
                <a href="{{route('students.select_photo', $student->id)}}" class="link-text link-secondary" style="">
                <span class="material-icons md-18">perm_media</span>
                </a>
                <form action="{{route('students.delete_photo', $student->id)}}" class="" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-link link-danger px-0 py-0">
                        <span class="material-icons md-18">image_not_supported</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-10">
            <div class="row">
                <div class="col-12 col-md-4">
                    <h4>{{$student->first_name}} {{$student->last_name}}</h4>
                </div>
            </div>                
                {{-- <div class="col-1 col-md-1"><span class="material-icons align-middle">
                    phone_in_talk
                    </span></div>
                    <div class="col-11 col-md-2">
                        {{ $student->contacts->where('type', '=', '1')->last()->contact_info }} --}}
                    {{-- @forelse ($student->contacts->where('type', '=', '1') as $phone)                        
                        <div class="row">{{$phone->contact_info)}}</div>
                    @empty
                        Няма въведен телефон.
                    @endforelse --}}
                    {{-- </div>
                <div class="col-1 col-md-1"><span class="material-icons align-middle">
                    mail
                    </span></div>
                    <div class="col-11 col-md-2">
                        {{ $student->contacts->where('type', '=', '2')->last()->contact_info }} --}}
                    {{-- @forelse ($student->contacts->where('type', '=', '2') as $email)                        
                        <div class="row">{{$email->contact_info}}</div>
                    @empty
                        Няма въведена електронна поща.
                    @endforelse --}}
                    {{-- </div> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 mt-4">
            <h5>Записан в групи:</h5>
        </div>
        <div class="col-md-2 mt-4">
            {{-- @if (isset(Auth::user()->id)) --}}
            <a href="{{route('students.addGroups',$student)}}" class="btn btn-sm btn-outline-secondary pt-1 pb-0 px-1 m-0"><span class="material-icons md-18">
                group_add
                </span></a>
            {{-- @endif --}}
        </div>
    </div>

    <div class="row align-items-center mt-3">
        <div class="col-md-12">
            @if($student->groups->isEmpty())
                <strong>Няма</strong>
            @else
                <div class="row">
                    <div class="col">
                        @foreach ($student->groups->sortBy('name') as $group)
                                <div class="d-inline-flex border border-info rounded col-1 justify-content-around">
                                    <strong>                                    
                                        <a href="{{route('groups.show', $group->id)}}" class="ps-1">{{$group->name}}</a>
                                    </strong>
                                    {{-- @if (isset(Auth::user()->id)) --}}
                                        <form action="{{route('students.detachGroup',[$student->id, $group->id])}}" method="POST" >
                                        @csrf
                                        @method('delete')
                                            <button class="btn btn-sm btn-link text-danger p-0"><span class="align-top material-icons md-18">
                                                clear
                                                </span></button>
                                        </form> 
                                    {{-- @endif                                     --}}
                                </div>
                        @endforeach
                    </div>
                </div>  
            @endif
        </div>
    </div>
</div>
    
@endsection