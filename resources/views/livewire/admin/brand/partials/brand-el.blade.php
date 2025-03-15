@if (isset($type) && $type == 'action')
    <button wire:click="$dispatch('edit-brand',{id:{{ $data->id }}})" onclick="KTApp.showPageLoading();"
        class="btn btn-sm btn-dark">
        <span class="indicator-label">
            Edit
        </span>
    </button>
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
