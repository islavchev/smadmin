@extends('layouts.app')

@section('content')
<div class="container">
    
<div class="row">
    <div class="col-10"><h1>Създаване на зали</h1></div>
</div>
<form action="{{route('rooms.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="col">
            <label for="names"><strong>Имена на залите:</strong></label>
            <textarea 
                class="form-control form-control-sm"
                name="names" rows="5" id="names"
                placeholder="Напишете имената или номерата на залите на отделни редове..." required></textarea>
            <br>
            <div class="form-group">  
                <div class="row">
                    <div class="col-2 text-end">
                        <strong>Интернет свързаност:</strong>
                    </div>
                    <div class="col-10">
                        @foreach (config('enums.rooms_internet') as $item) 
                        <div class="form-check form-check-inline">                  
                            <input class="form-check-input" type="radio" name="internet" id="inlineRadio{{$loop->iteration}}" value="{{$loop->iteration}}">
                            <label  class="form-check-label mr-2" for="inlineRadio{{$loop->iteration}}">
                                {{ $item }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> 
            <div class="form-group">
                <div class="row">
                    <div class="col-2 text-end">
                        <strong>Мултимедия:</strong>
                    </div>
                    <div class="col-10">
                        @foreach (config('enums.rooms_multimedia') as $item) 
                        <div class="form-check form-check-inline">                  
                            <input class="form-check-input" type="radio" name="multimedia" id="inlineRadio{{$loop->iteration}}" value="{{$loop->iteration}}">
                            <label  class="form-check-label mr-2" for="inlineRadio{{$loop->iteration}}">
                                {{ $item }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> 
            <div class="form-group">
                <div class="row">
                    <div class="col-2 text-end">
                        <label for="room_capacity"><strong>Капацитет на залата:</strong></label>
                    </div>
                    <div class="col-10">
                        <input type="number" name="capacity" id="room_capacity" value="12">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <button type="submit" class="btn btn-success btn-sm mt-3">
            Запиши
        </button>
    
</form>  
</div>  
@endsection