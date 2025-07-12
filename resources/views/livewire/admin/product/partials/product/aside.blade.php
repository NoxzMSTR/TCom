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
                    <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
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
            <div wire:ignore x-data="{
                init() {
            
                    $('.category').select2({
                        placeholder: 'Select category',
            
                        templateResult: formatCatResult,
                    });
                    $('.category').on('select2:select', function(e) {
                        $wire.set('category', $(this).val(), false)
                    });
                    $('.category').on('select2:unselect', function(e) {
                        $wire.set('category', $(this).val(), false)
                    });
                }
            }">

                <select class="form-select category mb-3" wire:modal.fill='category'>
                    <option value=""></option>
                    @foreach ($this->categories as $key => $cat)
                        <option data-level="{{ $cat['level'] }}" value="{{ $cat['id'] }}">{{ $cat['name'] }}
                        </option>
                        @if (isset($cat['child']))
                            @include('livewire.admin.product.partials.product.sub-cat-options', [
                                'categories' => $cat['child'],
                            ])
                        @endif
                    @endforeach
                </select>
            </div>
            <!--end::Select2-->

            <!--end::Input group-->

            <!--begin::Button-->
            <a href="{{ route('admin.product.categories') }}" wire:navigate class="btn btn-light-primary btn-sm mb-10">
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
            <div wire:ignore x-data="{
                init() {
                    $('.brand').on('select2:select', function(e) {
                        $wire.set('brand', $(this).val(), false)
                    });
                    $('.brand').on('select2:unselect', function(e) {
                        $wire.set('brand', $(this).val(), false)
                    });
                }
            }">
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
            </div>
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
            <div class="mb-10 fv-row fv-plugins-icon-container" x-data="{
                init() {
                    $('.expireAt').flatpickr({
                        enableTime: true,
                        time_24hr: true,
                        dateFormat: 'Y-m-d H:i',
                    });
                }
            }">
                <!--begin::Label-->
                <label class="required form-label">Offer Expire At</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="text" wire:model="offerExpireAt" class="form-control mb-2 expireAt"
                    placeholder="Expire at" value="{{ $offerExpireAt }}">
                <!--end::Input-->

                <!--begin::Description-->
                <div class="text-muted fs-7">Set the offer date and time when the it is gonna expire.</div>
                <!--end::Description-->
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
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
    <!--begin::Shipping-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Shipping</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Input group-->
            <div class="fv-row">
                <!--begin::Input-->
                <div class="form-check form-check-custom form-check-solid mb-2">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" wire:model.fill='sameDay'
                            {{ $sameDay ? 'checked' : '' }} />
                    </label>
                    <label class="form-check-label">
                        Same Day Delivery
                    </label>
                </div>
                <!--end::Input-->

            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card header-->
    </div>
    <!--end::Shipping-->
    <!--begin::Shipping-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Used Product</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Input group-->
            <div class="fv-row">
                <!--begin::Input-->
                <div class="form-check form-check-custom form-check-solid mb-2">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" wire:model.fill='used'
                            {{ $used ? 'checked' : '' }} />
                    </label>
                    <label class="form-check-label">
                        This is a used product
                    </label>
                </div>
                <!--end::Input-->

            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card header-->
    </div>
    <!--end::Shipping-->
    <!--begin::Shipping-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Need Advance Payment</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Input group-->
            <div class="fv-row">
                <!--begin::Input-->
                <div class="form-check form-check-custom form-check-solid mb-2">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" wire:model.fill='needAdvance'
                            {{ $needAdvance ? 'checked' : '' }} />
                    </label>
                    <label class="form-check-label">
                        If product needs advance payment then need to check it.
                    </label>
                </div>
                <!--end::Input-->

            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card header-->
    </div>
    <!--end::Shipping-->
</div>
