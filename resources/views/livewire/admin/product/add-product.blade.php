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
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::Thumbnail settings-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Thumbnail</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <!--begin::Image input-->
                <!--begin::Image input placeholder-->
                <style>
                    .image-input-placeholder {
                        background-image: url('{{ $showThumbnail ? $showThumbnail : asset('mAssets/media/avatars/thumbnail.jpg') }}');
                    }

                    [data-bs-theme="dark"] .image-input-placeholder {
                        background-image: url('{{ $showThumbnail ? $showThumbnail : asset('mAssets/media/avatars/thumbnail.jpg') }}');
                    }
                </style>
                <!--end::Image input placeholder-->

                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                    data-kt-image-input="true" wire:ignore>
                    <!--begin::Preview existing avatar-->
                    <div class="image-input-wrapper image-input-placeholder w-150px h-150px"></div>
                    <!--end::Preview existing avatar-->
                    <template x-if="showThumbnail">
                        <span @click="deleteThumb"
                            class="badge badge-circle cursor-pointer  h-25 position-absolute shadow start-0 text-gray-600 top-0 translate-middle w-25">
                            <i class="ki-duotone ki-trash fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                    </template>
                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar"
                        data-bs-original-title="Change avatar" data-kt-initialized="1">
                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                class="path2"></span></i>
                        <!--begin::Inputs-->
                        <input type="file" wire:model="thumbnail" name="avatar" accept=".png, .jpg, .jpeg">
                        <input type="hidden" name="avatar_remove">
                        <!--end::Inputs-->
                    </label>
                    <!--end::Label-->

                    <!--begin::Cancel-->
                    <span @click="cancelThumb"
                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Cancel avatar">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </span>
                    <!--end::Cancel-->
                </div>
                <!--end::Image input-->

                <!--begin::Description-->
                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image
                    files are accepted</div>
                <!--end::Description-->
                @error('thumbnail')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Thumbnail settings-->
        <!--begin::Status-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Status</h2>
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                </div>
                <!--begin::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Select2-->
                <select class="form-select" wire:model.fill='status'>
                    @foreach (PRODUCT_STATUS as $key => $value)
                        <option value="{{ $key }}" {{ $status == $key ? 'selected' : '' }}>{{ $value }}
                        </option>
                    @endforeach
                </select>

                <!--end::Select2-->

                <!--begin::Description-->
                <div class="text-muted fs-7">Set the product status.</div>
                <!--end::Description-->

                <!--begin::Datepicker-->
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <!--end::Datepicker-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Status-->

        <!--begin::Category & tags-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Product Details</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 pb-0">
                <!--begin::Input group-->
                <!--begin::Label-->
                <label class="form-label">Categories</label>
                <!--end::Label-->

                <!--begin::Select2-->
                <select class="form-select category mb-3" wire:modal.fill='category' data-control="select2"
                    data-placeholder="Select category">
                    <option value=""></option>
                    @foreach ($this->categories as $key => $value)
                        <option value="{{ $key }}" {{ $category == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                <!--end::Select2-->

                <!--end::Input group-->

                <!--begin::Button-->
                <a href="{{ route('admin.product.categories') }}" wire:navigate
                    class="btn btn-light-primary btn-sm mb-10">
                    <i class="ki-duotone ki-plus fs-2"></i> Create new category
                </a>
                <!--end::Button-->
                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category & tags-->
        <!--begin::Category & tags-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Brand</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 pb-0">
                <!--begin::Input group-->
                <!--begin::Select2-->
                <select class="form-select brand mb-3" wire:modal.fill='brand' data-control="select2"
                    data-placeholder="Select brand">
                    <option value=""></option>
                    @foreach ($this->brands as $key => $value)
                        <option value="{{ $key }}" {{ $brand == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                <!--end::Select2-->

                <!--end::Input group-->

                <!--begin::Button-->
                <a href="{{ route('admin.brands') }}" wire:navigate class="btn btn-light-primary btn-sm mb-10">
                    <i class="ki-duotone ki-plus fs-2"></i> Create new brand
                </a>
                <!--end::Button-->
                @error('brand')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category & tags-->
        <!--begin::Shipping-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Is Featured?</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 pb-0">
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Input-->
                    <div class="form-check form-check-custom form-check-solid mb-2">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" wire:model.fill='featured'
                                {{ $featured ? 'checked' : '' }} />
                        </label>
                        <label class="form-check-label">
                            Feature Product
                        </label>
                    </div>
                    <!--end::Input-->

                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Shipping-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Is Offer?</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 pb-0">
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Input-->
                    <div class="form-check form-check-custom form-check-solid mb-2">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" wire:model.fill='offered'
                                {{ $offered ? 'checked' : '' }} />
                        </label>
                        <label class="form-check-label">
                            Special Offered Product
                        </label>
                    </div>
                    <!--end::Input-->

                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
    </div>
    <!--end::Aside column-->

    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2"
            role="tablist" wire:ignore>
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
            $('.category').on('select2:select', function(e) {
                $wire.set("category", $(this).val(), false)
            });
            $('.category').on('select2:unselect', function(e) {
                $wire.set("category", $(this).val(), false)
            });
            $('.brand').on('select2:select', function(e) {
                $wire.set("brand", $(this).val(), false)
            });
            $('.brand').on('select2:unselect', function(e) {
                $wire.set("brand", $(this).val(), false)
            });
        }
    </script>
@endscript
