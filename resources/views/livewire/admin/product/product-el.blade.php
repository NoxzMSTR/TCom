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
@if (isset($type) && $type == 'image')
    @if ($value)
        <div class="symbol symbol-50px">
            <img src="{{ $value }}" alt="" />
        </div>
    @else
        <div class="symbol symbol-50px">
            <div class="symbol-label fs-2 fw-semibold text-success">T</div>
        </div>
    @endif
@endif
