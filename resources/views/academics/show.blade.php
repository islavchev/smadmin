@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-10">
            <h1>Детайли за преподавател</h1>
        </div>
        <div class="col-2">
            <a 
                class="link-info px-0 pt-1 pb-0"
                href="{{route('academics.edit', $academic->id)}}">
                <span class="material-icons md-18">edit</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-2">
            <div class="row">
                <div class="col text-center">
                    <img src="{{asset('/storage/images/'.$academic->image)}}" alt="" class=""> <br>
                </div>
            </div>
            <div class="d-flex col justify-content-evenly"> 
                <a href="{{route('academics.select_photo', $academic->id)}}" class="link-text link-secondary" style="">
                <span class="material-icons md-18">perm_media</span>
                </a>
                <form action="{{route('academics.delete_photo', $academic->id)}}" class="" method="POST">
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
                    <h4>{{config('enums.acad_positions')[$academic->acad_position]}} {{$academic->first_name}} {{$academic->last_name}}, {{config('enums.acad_titles')[$academic->acad_title]}}</h4>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-6 col-md-2"><span class="material-icons align-middle">
                    meeting_room
                    </span> {{$academic->room_no}}</div>
            </div>
            <div class="row">
                
                <div class="col-1 col-md-1"><span class="material-icons align-middle">
                    phone_in_talk
                    </span></div>
                    <div class="col-11 col-md-2">
                        {{ $academic->contacts->where('type', '=', '1')->last()->contact_info }}
                    {{-- @forelse ($academic->contacts->where('type', '=', '1') as $phone)                        
                        <div class="row">{{$phone->contact_info)}}</div>
                    @empty
                        Няма въведен телефон.
                    @endforelse --}}
                    </div>
                <div class="col-1 col-md-1"><span class="material-icons align-middle">
                    mail
                    </span></div>
                    <div class="col-11 col-md-2">
                        {{ $academic->contacts->where('type', '=', '2')->last()->contact_info }}
                    {{-- @forelse ($academic->contacts->where('type', '=', '2') as $email)                        
                        <div class="row">{{$email->contact_info}}</div>
                    @empty
                        Няма въведена електронна поща.
                    @endforelse --}}
                    </div>
            </div>
        </div>
    </div>

</div>
    
@endsection