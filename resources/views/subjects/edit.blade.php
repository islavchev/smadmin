@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <h1>Редактиране на дисциплина</h1>
    </div>

    <form action="{{route('subjects.update',$subject->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-2 mb-3">
                <label for="code">Код на дисциплината</label>
                <input type="text" name="code" maxlength="6" id="code" class="form-control form-control-sm" value="{{$subject->code}}">
            </div>
            <div class="col-md-4 mb-3">    
                <label for="name">Заглавие на дисциплината</label>          
                <input 
                    type="text" 
                    class="form-control form-control-sm"
                    name="name" id="name" value="{{$subject->name}}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 mb-3"> 
                <label for="lecture_hours">Часове лекции</label>
                <input 
                    type="number" min="0"
                    class="form-control form-control-sm"
                    name="lecture_hours" id="lecture_hours"
                    value="{{$subject->lecture_hours}}" required>
            </div>
            <div class="col-md-2 mb-3"> 
                <label for="seminar_hours">Часове упражнения</label>
                <input 
                    type="number" min="0"
                    class="form-control form-control-sm"
                    name="seminar_hours" id="seminar_hours"
                    value="{{$subject->seminar_hours}}" required>
            </div>
            <div class="col-md-2 mb-3"> 
                <label for="ects">Брой ECTS</label>
                <input 
                    type="number" min="1"
                    class="form-control form-control-sm"
                    name="ects" id="ects"
                    value="{{$subject->ects}}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="edu_form">Форма на обучение:</label>
                <select id="edu_form" class="form-select form-select-sm" name="edu_form" required>
                    @foreach (config('enums.edu_form') as $form_key => $form_type)                                
                    <option value="{{$loop->iteration}}" {{$subject->edu_form == $form_key ? 'selected':''}}>{{$form_type}}</option>
                    @endforeach                            
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="type">Вид на дисциплината:</label>
                <select id="type" class="form-select form-select-sm" name="type" required>
                    @foreach (config('enums.subject_types') as $type_key => $type_value)                                
                    <option value="{{$loop->iteration}}" {{$subject->type == $type_key ? 'selected':''}}>{{$type_value}}</option>
                    @endforeach                            
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <Label for="note">Забележки:</Label>
                <textarea class="form-control" name="note" id="note" cols="30" rows="5">{{$subject->note}}</textarea>
            </div>
        </div>
            <button type="submit" class="btn btn-success btn-sm mt-3">
                Запиши
            </button>
        
    </form>  

</div>    
@endsection