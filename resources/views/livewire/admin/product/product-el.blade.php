@if (isset($type) && $type == 'category_action')
    <button wire:click="$dispatch('edit-category',{id:{{ $data->id }}})" onclick="KTApp.showPageLoading();"
        class="btn btn-sm btn-dark">
        <span class="indicator-label">
            Edit
        </span>
    </button>
@endif
@if (isset($type) && $type == 'product_action')
    <a href="{{ route('admin.product.update', [$data->id]) }}" class="btn btn-sm btn-dark" wire:navigate>
        <span class="indicator-label">
            Edit
        </span>
    </a>
@endif
