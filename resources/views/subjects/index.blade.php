@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center mb-5">
            <div class="col-6">
                <h1>Списък на дисциплините</h1>
            </div>
            <div class="col-6 text-end">
                {{-- @if (Auth::user()) --}}
                    <a href="{{route('subjects.create')}}" class="ms-auto">
                        <span class="material-icons md-18 px-1 pt-0 pb-0 btn btn-sm btn-outline-success">post_add</span>                   
                    </a>
                {{-- @endif --}}
            </div>
        </div>
        @if ($subjects)            
        <div class="row border">
            <div class="col-8">
                <strong>Име на дисциплината</strong>
            </div>
            <div class="col-2 text-end">
                <strong>Кредити</strong>
            </div>
            <div class="col-2 text-end">
                <strong>Управление</strong>
            </div>
        </div>
        @endif
        @foreach ($subjects as $subject)
        <div class="row border border-top-0">
            <div class="col-8">
                <a href="{{route('subjects.show', $subject->id)}}" class="">{{'('.$subject->code.') '.$subject->name}} 
                </a>
            </div>
            <div class="col-2 text-end">{{$subject->ects}} ECTS</div>
            <div class="col-2">
                {{-- @if (isset(Auth::user()->id)) --}}
                    <div class="d-flex flex-row justify-content-end align-bottom">
                        <a 
                            class="btn btn-link link-info px-0 pb-0 pt-1 me-2"
                            href="{{ route('subjects.edit', $subject->id) }}">
                            <span class="material-icons md-18">
                                edit
                                </span>
                        </a>

                        <form action="{{ route('subjects.destroy', $subject->id) }}" class="" method="POST">
                            @csrf
                            @method('delete')
                            <button 
                                type="submit"
                                class="btn btn-link link-danger px-0 pb-0 pt-1"><span class="material-icons md-18">
                                    delete_forever
                                    </span>
                            </button>
                        </form>
                    </div>
                    
                {{-- @endif --}}

                
            </div>
        </div>
        @endforeach
<hr>
    {{ $subjects->links() }}

</div>
@endsection