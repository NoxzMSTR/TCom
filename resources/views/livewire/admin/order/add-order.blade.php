<div>
    <div class="form d-flex flex-column flex-lg-row">
        <!--begin::Aside column-->
        @include('livewire.admin.order.partials.aside')
        <!--end::Aside column-->

        <!--begin::Main column-->
        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">

            <!--begin::Order details-->
            @include('livewire.admin.order.partials.products')
            <!--end::Order details-->

            <!--begin::Order details-->
            @include('livewire.admin.order.partials.address')
            <!--end::Order details-->
            <div class="d-flex justify-content-end">
                @if ($order)
                    <!--begin::Button-->
                    <button wire:click='updateOrder' class="btn btn-primary">
                        <span class="indicator-label">
                            Update
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                @else
                    <!--begin::Button-->
                    <button class="btn btn-light me-5">
                        Clear
                    </button>
                    <!--end::Button-->

                    <!--begin::Button-->
                    <button wire:click='addOrder' id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Add
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                @endif

            </div>
        </div>
        <!--end::Main column-->
    </div>
</div>
@script
    <script>
        setTimeout(() => {
            KTApp.hidePageLoading();
            KTComponents.init();
        }, 1000);
    </script>
@endscript
