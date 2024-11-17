@if (isset($type) && $type == 'action')
    <button wire:click='$dispatch("update-vendor",{id:{{ $data->id }}})' class="btn btn-sm btn-dark" wire:navigate>
        <span class="indicator-label">
            Edit
        </span>
    </button>
@endif
