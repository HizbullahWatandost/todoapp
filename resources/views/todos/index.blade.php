@extends('todos.layout')

@section('content')

    <div class="d-flex p-3 justify-content-between border-bottom pb-4">
        <h2> All your Todos</h2> 
        <a href="{{ route('todo.create') }}" class="mx-3 py-2"> 
            <span class="fas fa-plus"></span>
        </a>
    </div>
    <ul class="list-unstyled pt-2">
        <x-alert />
        @forelse($todos as $todo)
            <li class="d-flex justify-content-between p-2">
                <div>
                    @include('todos.complete-incomplete')
                </div>
                @if($todo->completed)
                    <p class="text-success font-weight-bold"><del>{{ $todo->title }}</del></p>
                @else 
                    <a class="cursor-pointer" href="{{ route('todo.show', $todo->id)}}">{{ $todo->title }}</a>
                @endif
                <div>
                    <a href="{{route('todo.edit', $todo->id)}}">
                        <i class="fas fa-edit px-2 text-warning cursor-pointer"></i>
                    </a>
                    <a onclick="event.preventDefault();
                    if(confirm('Are you want to delete?')){
                        document.getElementById('form-delete{{ $todo->id }}').submit();
                    }">
                        <i class="fas fa-trash px-2 text-danger cursor-pointer"></i>
                    </a>
                    <form style="display: none" method="POST" id="{{'form-delete'.$todo->id }}" action="{{ route('todo.destroy', $todo->id) }}">
                        @csrf 
                        @method('delete')
                    </form>
                </div>
            </li>
        @empty
            <p>No task available, create one.</p>
        @endforelse
    </ul> 
@endsection
