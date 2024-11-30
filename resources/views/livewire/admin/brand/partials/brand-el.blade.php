@if (isset($type) && $type == 'action')
    <button wire:click="$dispatch('edit-brand',{id:{{ $data->id }}})" onclick="KTApp.showPageLoading();"
        class="btn btn-sm btn-dark">
        <span class="indicator-label">
            Edit
        </span>
    </button>
@endif
