@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <h1>Редактиране на данни за студент</h1>
    </div>

    <form action="{{route('students.update',$student->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-row">

            <div class="col-md-4 mb-3">    
                <label for="first_name">Име</label>          
                <input 
                    type="text"
                    class="form-control form-control-sm"
                    name="first_name" id="first_name"
                    value="{{$student->first_name}}" required>
            </div>
            <div class="col-md-4 mb-3"> 
                <label for="middle_name">Презиме</label>
                <input 
                    type="text"
                    class="form-control form-control-sm"
                    name="middle_name" id="middle_name"
                    value="{{$student->middle_name}}">
            </div>
            <div class="col-md-4 mb-3"> 
                <label for="last_name">Фамилия</label>
                <input 
                    type="text"
                    class="form-control form-control-sm"
                    name="last_name" id="last_name"
                    value="{{$student->last_name}}" required>
            </div>
        </div>

        <div class="form-row">
            <label for="date_of_birth">Дата на раждане</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="{{$student->date_of_birth}}">
        </div>
            <button type="submit" class="btn btn-success btn-sm mt-3">
                Запиши
            </button>
        
    </form>  

</div>    
@endsection