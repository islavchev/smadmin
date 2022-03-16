@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
            <div class="col-md-8">
                <h1>Добавяне на преподавател</h1>
            </div>
        </div>
    </div>
    <div class="row mt-5 ms-3">
        <form action="{{route('academics.index')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="acad_position">Акад. звание</label>
                    <select id="acad_position" class="form-select form-select-sm" name="acad_position" required>
                        <option value="" disabled selected hidden>Звание</option>
                        @foreach (config('enums.acad_positions') as $apos)                                
                        <option value="{{$loop->iteration}}">{{$apos}}</option>
                        @endforeach                            
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="acad_title">Акад. титла</label>
                    <select class="form-select form-select-sm" name="acad_title" id="acad_title">
                            <option value="" disabled selected hidden>Титла</option>
                            @foreach (config('enums.acad_titles') as $atitle)
                                <option value="{{$loop->iteration}}">{{$atitle}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="acad_abbreviation">Абревиатура</label>
                    <input type="text" name="abbreviation" id="acad_abbreviation" class="form-control form-control-sm" placeholder="Съкращение до 4 символа...">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">    
                    <label for="first_name">Име</label>          
                    <input 
                        type="text"
                        class="form-control form-control-sm"
                        name="first_name" id="first_name"
                        placeholder="Име..." required>
                </div>
                <div class="col-md-3 mb-3"> 
                    <label for="last_name">Фамилия</label>
                    <input 
                        type="text"
                        class="form-control form-control-sm"
                        name="last_name" id="last_name"
                        placeholder="Фамилия..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="room_no">Кабинет &#8470;</label>
                    <input type="text" class="form-control form-control-sm" id="room_no" name="room_no" placeholder="Кабинет &#8470;" required>
                </div>
                <div class="mb-3 col-md-4"> 
                    <label for="phone">Телефон</label>
                    <input 
                        type="text"
                        class="form-control form-control-sm"
                        name="phone" id="phone"
                        placeholder="Сл. телефон..." required>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-md-4"> 
                    <label for="email">Ел. поща</label>
                    <input 
                        type="email"
                        class="form-control form-control-sm"
                        name="email" id="email"
                        placeholder="Ел. поща..." required>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-lg">
                Запиши
            </button>
            </div>
        </form>
    </div>
</div>
@endsection