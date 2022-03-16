@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <h1>Редактиране на данни за преподавател</h1>
    </div>

    <form action="{{route('academics.update',$academic->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-row">

            <div class="form-group col-md-2 mb-3">
                <label for="acad_position">Акад. звание</label>
                <select id="acad_position" class="form-select form-select-sm" name="acad_position" required>
                    @foreach (config('enums.acad_positions') as $apos)                                
                    <option value="{{$loop->iteration}}" {{$academic->acad_position == $loop->iteration ? "selected": ""}}>{{$apos}}</option>
                    @endforeach                            
                </select>
            </div>

            <div class="col-md-4 mb-3">    
                <label for="first_name">Име</label>          
                <input 
                    type="text"
                    class="form-control form-control-sm"
                    name="first_name" id="first_name"
                    value="{{$academic->first_name}}" required>
            </div>
            <div class="col-md-4 mb-3"> 
                <label for="last_name">Фамилия</label>
                <input 
                    type="text"
                    class="form-control form-control-sm"
                    name="last_name" id="last_name"
                    value="{{$academic->last_name}}" required>
            </div>
            <div class="form-group col-md-2 mb-3">
                <label for="acad_title">Акад. титла</label>
                <select class="form-select form-select-sm" name="acad_title" id="acad_title">
                        @foreach (config('enums.acad_titles') as $atitle)
                            <option value="{{$loop->iteration}}" {{$academic->acad_title == $loop->iteration ? "selected": ""}}>{{$atitle}}</option>
                        @endforeach
                </select>
            </div>
                <div class="col-md-2 mb-3">
                    <label for="room_no">Кабинет &#8470;</label>
                    <input type="text" class="form-control form-control-sm" id="room_no" name="room_no" value="{{$academic->room_no}}" required>
                </div>
                <div class="form-group mb-3 col-md-4"> 
                    <label for="phone">Телефон</label>
                    <input 
                        type="text"
                        class="form-control form-control-sm"
                        name="phone" id="phone"
                        value="{{$academic->phone}}" required>
                </div>
            <div class="form-group mb-3 col-md-4"> 
                <label for="email">Ел. поща</label>
                <input 
                    type="email"
                    class="form-control form-control-sm"
                    name="email" id="email"
                    value="{{$academic->email}}" required>
            </div>
        </div>
            <button type="submit" class="btn btn-success btn-sm mt-3">
                Запиши
            </button>
        
    </form>  

</div>    
@endsection