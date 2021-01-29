<div>
    <div class="d-flex p-2 justify-content-center pb-4">
        <h5> Add steps if required </h5> 
        <span wire:click = "increment" class="fas fa-plus cursor-pointer px-3 py-1"></span>
    </div> 
    @foreach($steps as $step)
        <div class="flex justify-content-center py-1" wire:key="{{ $step }}">
            <input type="text" name="step[]" class="py-2 px-2 border rounded" placeholder="{{ 'Describe steps '.($step+1) }}"/>
            <span class="fas fa-times text-danger" wire:click="remove({{ $step }})"></span>
        </div>
    @endforeach
</div>
