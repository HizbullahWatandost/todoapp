<div>
    <div class="d-flex p-2 justify-content-center pb-4">
        <h5> Add steps if required </h5> 
        <span wire:click = "increment" class="fas fa-plus cursor-pointer px-3 py-1"></span>
    </div> 
    @foreach($steps as $step)
        <div class="flex justify-content-center py-1" wire:key="{{ $loop->index }}">
            <input type="text" name="stepName[]" class="py-2 px-2 border rounded" value = "{{ $step['name'] }}" placeholder="{{ 'Describe steps '.($loop->index+1) }}"/>
            <input type="hidden" name="stepId[]" class="py-2 px-2 border rounded" value = "{{ $step['id'] }}"/>
            <span class="fas fa-times text-danger" wire:click="remove({{ $loop->index }})"></span>
        </div>
    @endforeach
</div>
