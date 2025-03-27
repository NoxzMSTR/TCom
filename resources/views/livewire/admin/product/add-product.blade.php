<div class="d-flex flex-md-nowrap flex-wrap" x-data="{
    showThumbnail: $wire.entangle('showThumbnail'),
    async cancelThumb() {
        $('.btn').attr('disabled', true);
        await $wire.set('thumbnail', null, true);
        $('.btn').attr('disabled', false);
        $('.image-input-placeholder').removeAttr('style')
    },
    async deleteThumb() {
        $('.btn').attr('disabled', true);
        await $wire.deleteThumb();
        $('.btn').attr('disabled', false);
        $('.image-input-placeholder').removeAttr('style')
    },
    init() {

        KTComponents.init();

        $wire.on('set-field', (e) => {
            $('.parentCategory').val(e.parent).trigger('change');
        });
        $wire.on('on-clear', (e) => {
            $('.cancelThumb').click();
        });
        $wire.on('pro-notification', (e) => {
            Swal.fire({
                title: e.title,
                text: e.message,
                icon: e.type
            });
        });
    }
}">
    <!--begin::Aside column-->
    @include('livewire.admin.product.partials.product.aside')
    <!--end::Aside column-->

    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2" role="tablist"
            wire:ignore>
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#product_general"
                    aria-selected="true" role="tab">General</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#product_media"
                    aria-selected="false" tabindex="-1" role="tab">Media</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#product_advanced"
                    aria-selected="false" tabindex="-1" role="tab">Advanced</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#product_specification"
                    aria-selected="false" tabindex="-1" role="tab">Specification</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#product_vendor"
                    aria-selected="false" tabindex="-1" role="tab">Vendor</a>
            </li>
            <!--end:::Tab item-->

        </ul>
        <!--end:::Tabs-->
        <div>
            @if ($errors->all())
                @foreach ($errors->all() as $error)
                    <div class="text-danger mb-1">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            @include('livewire.admin.product.partials.product.general')
            <!--end::Tab pane-->

            <!--begin::Tab pane-->
            @include('livewire.admin.product.partials.product.media')
            <!--end::Tab pane-->

            <!--begin::Tab pane-->
            @include('livewire.admin.product.partials.product.specification')
            <!--end::Tab pane-->

            <!--begin::Tab pane-->
            @include('livewire.admin.product.partials.product.advanced')
            <!--end::Tab pane-->

            <!--begin::Tab pane-->
            @include('livewire.admin.product.partials.product.vendor')
            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->

        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a wire:click='clear' id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                Clear
            </a>
            <!--end::Button-->
            @if ($product)
                <!--begin::Button-->
                <button wire:click='updateProduct' onclick="KTApp.showPageLoading();" class="btn btn-primary">
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
                <button wire:click='saveProduct' onclick="KTApp.showPageLoading();" class="btn btn-primary">
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

        window.formatCatResult = function formatCatResult(node) {
            var level = 0;
            if (node.element !== undefined) {
                level = $(node.element).attr('data-level');

                level = parseInt(level);

            }
            var $result = $('<span style="padding-left:' + (20 * level) + 'px;">' + node.text + '</span>');
            return $result;
        };

        function initEl(e = null) {
            var metatags = document.querySelector("#metatags");
            $('#metatags').parent().find('.tagify').remove();
            if (typeof metatags.__tagify !== 'undefined') {
                delete metatags.__tagify
            }
            new Tagify(metatags, {
                callbacks: {
                    "change": (e) => $wire.set('metaTags', e.detail.value, false),
                }
            });

            KTComponents.init();
            $('.type').on('select2:select', function(e) {
                var key = $(this).attr('wire:model');
                $wire.set(key, $(this).val(), false)
            });
            $('.type').on('select2:unselect', function(e) {
                var key = $(this).attr('wire:model');
                $wire.set(key, $(this).val(), false)
            });

        }
    </script>
@endscript
