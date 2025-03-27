@foreach ($categories as $cat)
    <option data-level="{{ $cat['level'] }}" value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
    @if (isset($cat['child']))
        @include('livewire.admin.product.partials.product.sub-cat-options', [
            'categories' => $cat['child'],
        ])
    @endif
@endforeach
