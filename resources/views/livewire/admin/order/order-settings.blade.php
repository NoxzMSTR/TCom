<div x-data="{
    availableCities: $wire.entangle('availableCities'),
    deliveryOn: $wire.entangle('deliveryOn'),
    deliveryTime: $wire.entangle('deliveryTime'),
    deliveryCities: [],
    sameDayDelivery: $wire.entangle('sameDayDelivery'),
    init() {

        KTComponents.init();

        $wire.on('set-field', (e) => {
            $('.parentCategory').val(e.parent).trigger('change');
        });
        $wire.on('on-clear', (e) => {
            $('.cancelThumb').click();
        });
        $wire.on('os-notification', (e) => {
            Swal.fire({
                title: e.title,
                text: e.message,
                icon: e.type
            });
        });
    }
}">
    <!--begin::Navbar-->
    @include('livewire.admin.order.partials.settings.header')
    <!--end::Navbar-->
    <!--begin::Basic info-->
    @include('livewire.admin.order.partials.settings.general')
    <!--end::Basic info-->
    <!--begin::Basic info-->
    @include('livewire.admin.order.partials.settings.shipping')
    <!--end::Basic info-->

</div>
@script
    <script>
        setTimeout(() => {
            KTApp.hidePageLoading();
            initEl();
        }, 1000);

        $wire.on('show-loader', () => {
            KTApp.showPageLoading();
        });

        $wire.on('hide-loader', (e) => {
            setTimeout(() => {
                KTApp.hidePageLoading();
                initEl(e);
            }, 1000);

        });

        function initEl(e = null) {
            KTComponents.init();
            $('.currency').on('select2:select', function(e) {
                var key = $(this).attr('wire:model.fill');

                $wire.set(key, $(this).val(), false)
            });
            $('.currency').on('select2:unselect', function(e) {
                var key = $(this).attr('wire:model.fill');
                $wire.set(key, $(this).val(), false)
            });
            $('.cities').on('select2:select', function(e) {
                var key = $(this).attr('wire:model.fill');

                $wire.set(key, $(this).val(), false)
            });
            $('.cities').on('select2:unselect', function(e) {
                var key = $(this).attr('wire:model.fill');
                $wire.set(key, $(this).val(), false)
            });
        }
    </script>
@endscript
