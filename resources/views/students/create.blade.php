@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
            <div class="col-md-8">
                <h1>Добавяне на студент</h1>
            </div>
        </div>
    </div>
    <div class="row mt-5 ms-3">
        <form action="{{route('students.index')}}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    <label for="last_name">Презиме</label>
                    <input 
                        type="text"
                        class="form-control form-control-sm"
                        name="middle_name" id="middle_name"
                        placeholder="Презиме...">
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
                <div class="mb-5 col-md-3"> 
                    <label for="date_of_birth">Дата на раждане:</label>
                    <input 
                        type="date"
                        class="form-control form-control-sm"
                        name="date_of_birth" id="date_of_birth">
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