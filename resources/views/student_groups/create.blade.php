@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
            <div class="col-md-8">
                <h1>Добавяне на групи</h1>
            </div>
            <form action="{{route('student_groups.index')}}" method="POST" enctype="multipart/form-data" class="mt-2">
                @csrf
                <div class="form-row">
                    <textarea name="names" id="" cols="30" rows="10" placeholder="Напишете имената на групите по една на ред..."></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm mt-2">
                    Запиши
                </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection