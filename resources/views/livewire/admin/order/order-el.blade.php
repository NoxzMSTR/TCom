@if (isset($type) && $type == 'order_action')
    <a href="{{ route('admin.order.update', [$data->id]) }}" class="btn btn-sm btn-dark" wire:navigate>
        <span class="indicator-label">
            Edit
        </span>
    </a>
@endif
