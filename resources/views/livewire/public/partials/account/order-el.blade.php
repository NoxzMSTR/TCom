@if (isset($type) && $type == 'order_action')
    <a href="{{ route('public.checkout.success', [$data->trackingNo]) }}" class="btn btn-sm btn-dark">
        <span class="indicator-label">
            View
        </span>
    </a>
@endif
@if (isset($type) && $type == 'order_status')
    @if ($data->status == 0)
        <span class="badge badge-warning">{{ ORDER_STATUS[$data->status] }}</span>
    @elseif ($data->status == 1)
        <span class="badge badge-info">{{ ORDER_STATUS[$data->status] }}</span>
    @elseif ($data->status == 2)
        <span class="badge badge-success">{{ ORDER_STATUS[$data->status] }}</span>
    @elseif ($data->status == 3)
        <span class="badge badge-info">{{ ORDER_STATUS[$data->status] }}</span>
    @elseif ($data->status == 4)
        <span class="badge badge-danger">{{ ORDER_STATUS[$data->status] }}</span>
    @else
        <span class="badge badge-danger">{{ ORDER_STATUS[$data->status] }}</span>
    @endif
@endif
