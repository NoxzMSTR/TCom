<div x-data="{
    availableCities: $wire.entangle('availableCities'),
    deliveryOn: $wire.entangle('deliveryOn'),
    deliveryTime: $wire.entangle('deliveryTime'),
    deliveryCities: [],
    sameDayDelivery: $wire.entangle('sameDayDelivery'),
    currentTab: 'general',
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
    <div x-show="currentTab == 'general'" x-transition>
        <!--begin::Basic info-->
        @include('livewire.admin.order.partials.settings.general')
        <!--end::Basic info-->
        <!--begin::Basic info-->
        @include('livewire.admin.order.partials.settings.shipping')
        <!--end::Basic info-->
    </div>
    <div x-show="currentTab == 'payment'" x-transition>
        <!--begin::Basic info-->
        @include('livewire.admin.order.partials.settings.advance')
        <!--end::Basic info-->
        <!--begin::Basic info-->
        @include('livewire.admin.order.partials.settings.gateway')
        <!--end::Basic info-->
        <!--begin::Basic info-->
        @include('livewire.admin.order.partials.settings.charges')
        <!--end::Basic info-->
    </div>
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
