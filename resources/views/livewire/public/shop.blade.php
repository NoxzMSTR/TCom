<div>
    <div class="container">
        <div class="row mb-8">
            @include('livewire.public.partials.shop.filter')
            @include('livewire.public.partials.shop.products')
        </div>
    </div>
</div>
@push('js')
    <script>
        $(window).on('load', function() {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });
        });

        $(document).on('ready', function() {
            $.HSCore.components.HSRangeSlider.init('.js-range-slider');
        });
    </script>
@endpush
