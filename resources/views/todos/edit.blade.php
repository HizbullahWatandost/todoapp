@extends('todos.layout')

@section('content')
    <div class="d-flex p-2 justify-content-between border-bottom pb-4">
        <h2> Update To-DO? </h2> 
        <a href="{{ route('todo.index') }}" class="mx-2 py-2"> 
            <span class="fas fa-arrow-left"></span>
        </a>
    </div>    
    <x-alert />
    <form action="{{ route('todo.update', $todo->id) }}" method="post" class="py-2">
        @csrf
        @method('patch')
        <div class="py-1">
            <input type="text" name="title" value = "{{ $todo->title }}" class="py-2 px-2 border rounded" placeholder="Title"/>
        </div>
        <div class="py-1">
            <textarea name='description' class="p-3 rounded border">{{ $todo->description }}</textarea>
        </div>
        <div class="py-2">
            @livewire('edit-step', ['steps' => $todo->steps])
        </div>
        <div class="py-1">
            <input type="submit" value="Update" class="py-2 border rounded"/>
        </div>
    </form>
@endsection