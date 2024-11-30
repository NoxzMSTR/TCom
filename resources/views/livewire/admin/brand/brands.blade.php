<div class="d-flex flex-wrap">
    <!--begin::Aside column-->
    @include('livewire.admin.brand.partials.form')
    <!--end::Aside column-->

    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>List</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                @livewire('admin.brand.brand-datatable')
            </div>
            <!--end::Card header-->
        </div>


    </div>
    <!--end::Main column-->
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

        $wire.on('hide-loader', () => {
            setTimeout(() => {
                KTApp.hidePageLoading();
                initEl();
            }, 1000);

        });

        function initEl() {
            KTComponents.init();

        }
    </script>
@endscript
