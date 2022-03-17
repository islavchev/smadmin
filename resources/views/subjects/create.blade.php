@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
            <div class="col-md-8">
                <h1>Добавяне на дисциплина</h1>
            </div>
        </div>
    </div>
    <div class="row mt-5 ms-3">
        <form action="{{route('subjects.index')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="subject_types">Вид на дисциплината:</label>
                    <select id="subject_types" class="form-select form-select-sm" name="subject_types" required>
                        <option value="" disabled selected hidden>Вид</option>
                        @foreach (config('enums.subject_types') as $type)                                
                        <option value="{{$loop->iteration}}">{{$type}}</option>
                        @endforeach                            
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="subject_code">Код на дисциплината</label>
                    <input type="text" name="subject_code" id="subject_code" class="form-control form-control-sm" placeholder="Код до 6 символа...">
                </div>
                <div class="col-md-5 mb-3">    
                    <label for="name">Заглавие на дисциплината</label>          
                    <input 
                        type="text" maxlength="6"
                        class="form-control form-control-sm"
                        name="name" id="name"
                        placeholder="Име..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3"> 
                    <label for="lecture_hours">Часове лекции</label>
                    <input 
                        type="number" min="0"
                        class="form-control form-control-sm"
                        name="lecture_hours" id="lecture_hours"
                        placeholder="Часове лекции..." required>
                </div>
                <div class="col-md-3 mb-3"> 
                    <label for="seminar_hours">Часове упражнения</label>
                    <input 
                        type="number" min="0"
                        class="form-control form-control-sm"
                        name="seminar_hours" id="seminar_hours"
                        placeholder="Часове упражнения..." required>
                </div>
                <div class="col-md-3 mb-3"> 
                    <label for="ects">Брой ECTS</label>
                    <input 
                        type="number" min="1"
                        class="form-control form-control-sm"
                        name="ects" id="ects"
                        placeholder="ECTS..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 mb-3">
                    <Label for="note">Забележки:</Label>
                    <textarea class="form-control" name="note" id="note" cols="30" rows="5" placeholder="Забележки по дисциплината..."></textarea>
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