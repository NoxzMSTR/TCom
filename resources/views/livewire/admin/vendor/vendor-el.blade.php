@if (isset($type) && $type == 'action')
    <button wire:click='$dispatch("update-vendor",{id:{{ $data->id }}})' class="btn btn-sm btn-dark" wire:navigate>
        <span class="indicator-label">
            Edit
        </span>
    </button>
@endif
@if (isset($type) && $type == 'add')
    <button wire:click='add()' class="btn btn-sm btn-primary ms-2" wire:navigate>
        <span class="indicator-label">
            Add
        </span>
    </button>
@endif
