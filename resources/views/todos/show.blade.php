@extends('todos.layout')

@section('content')
    <div class="d-flex p-2 justify-content-between border-bottom pb-4">
        <h2> {{ $todo->title }} </h2> 
        <a href="{{ route('todo.index') }}" class="mx-2 py-2"> 
            <span class="fas fa-arrow-left"></span>
        </a>
    </div>
    <div>
        <div class="py-2">
            <h4>Description</h4>
            {{ $todo->description }}
        </div>

        @if($todo->steps)
        <div class="py-3">
            <h4>Steps for this task</h4>
            @foreach($todo->steps as $step)
                <p> {{ $step->name }} </p>
            @endforeach
        </div>
        @endif
    </div>
@endsection
