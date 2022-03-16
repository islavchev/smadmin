@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <h1>Редактиране на зала</h1>
    </div>

    <form action="{{route('rooms.update',$room->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
            <div class="row">
            <div class="col-2 text-end">
                <label for="names"><strong>Име на залата:</strong></label>
            </div>
            <div class="col-10">
                <input type="text" name="room_name" value="{{$room->room_name}}">
            </div>
            </div> 
                <div class="form-group">  
                    <div class="row mt-2">
                        <div class="col-2 text-end">
                            <strong>Интернет свързаност:</strong>
                        </div>
                        <div class="col-10">
                            @foreach (config('enums.rooms_internet') as $item) 
                            <div class="form-check form-check-inline">                  
                                <input class="form-check-input" type="radio" name="internet" id="inlineRadio{{$loop->iteration}}" value="{{$loop->iteration}}" {{$room->internet == $loop->iteration ? 'checked' :''}} >
                                <label  class="form-check-label mr-2" for="inlineRadio{{$loop->iteration}}">
                                    {{ $item }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row mt-2">
                        <div class="col-2 text-end">
                            <strong>Мултимедия:</strong>
                        </div>
                        <div class="col-10">
                            @foreach (config('enums.rooms_multimedia') as $item) 
                            <div class="form-check form-check-inline">                  
                                <input class="form-check-input" type="radio" name="multimedia" id="inlineRadio{{$loop->iteration}}" value="{{$loop->iteration}}"  {{$room->multimedia == $loop->iteration ? 'checked' :''}}>
                                <label  class="form-check-label mr-2" for="inlineRadio{{$loop->iteration}}">
                                    {{ $item }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row mt-2">
                        <div class="col-2 text-end">
                            <label for="room_capacity"><strong>Капацитет на залата:</strong></label>
                        </div>
                        <div class="col-10">
                            <input type="number" name="capacity" id="room_capacity" value="12">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mt-2">
                        <div class="col-2 text-end">
                            <label for="notes"><strong>Забележки:</strong></label>
                        </div>                        
                        <div class="col-10">
                            <textarea name="notes" id="notes" rows="5">{{$room->notes}}</textarea>
                        </div>
                    </div>
                </div>
            <button type="submit" class="btn btn-success btn-sm mt-3">
                Запиши
            </button>
        
    </form>  

</div>    
@endsection