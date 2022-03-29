@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"><div class="col-10">
        <h1>График на семесътр</h1>
    </div>

    <form action="{{route('semester_show')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mt-5">
            <div class="col-12 col-md-6 col-lg-4">
                <h5>Изберете година и семестър</h5>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-6 col-md-3 col-lg-2">
                <input type="number" name="year" id="year" value="{{date('Y')}}" min="1990" max="2200" class="form-control form-control-sm">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <select name="semester" id="semester" class="form-select form-select-sm">
                    <option value="1">Летен</option>
                    <option value="2">Зимен</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 d-grid">
                <button type="submit" class="btn btn-block btn-success btn-sm mt-3">
                    Покажи
                </button>  
            </div>
        </div>  
    </form>

</div>
@endsection

