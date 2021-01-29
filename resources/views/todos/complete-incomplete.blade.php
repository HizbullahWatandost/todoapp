@if($todo->completed)
    <span onclick="event.preventDefault();document.getElementById('form-incomplete{{ $todo->id }}').submit()" class="fas fa-check text-success cursor-pointer px-2"></span>
    <form style="display: none" method="POST" id="{{'form-incomplete'.$todo->id }}" action="{{ route('todo.incomplete', $todo->id) }}">
        @csrf 
        @method('delete')
    </form>
@else
    <span onclick="event.preventDefault();document.getElementById('form-complete{{ $todo->id }}').submit()" class="fas fa-check text-muted cursor-pointer px-2"></span>
    <form style="display: none" method="POST" id="{{'form-complete'.$todo->id }}" action="{{ route('todo.complete', $todo->id) }}">
        @csrf 
        @method('put')
    </form>
@endif