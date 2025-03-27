<div class="d-flex flex-wrap">
    <!--begin::Aside column-->
    @include('livewire.admin.product.partials.category.form')
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
                @livewire('admin.product.category-datatable')
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

        window.formatCatResult = function formatCatResult(node) {
            var level = 0;
            if (node.element !== undefined) {
                level = $(node.element).attr('data-level');

                level = parseInt(level);

            }
            var $result = $('<span style="padding-left:' + (20 * level) + 'px;">' + node.text + '</span>');
            return $result;
        };
    </script>
@endscript
