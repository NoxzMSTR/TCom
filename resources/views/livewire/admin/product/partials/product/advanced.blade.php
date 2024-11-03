<div class="tab-pane fade" id="product_advanced" role="tab-panel" wire:ignore.self>
    <div class="d-flex flex-column gap-7 gap-lg-10">

        <!--begin::Inventory-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Inventory</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">SKU</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" wire:model="sku" class="form-control mb-2" placeholder="SKU Number"
                        value="">
                    <!--end::Input-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Enter the product SKU.</div>
                    <!--end::Description-->
                    @error('sku')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Quantity</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <div class="d-flex gap-3">
                        <input type="number" wire:model="onSQty" class="form-control mb-2" placeholder="On shelf"
                            value="">
                        <input type="number" wire:model="onWQty" class="form-control mb-2" placeholder="In warehouse">
                    </div>
                    <!--end::Input-->

                    <!--begin::Description-->
                    @error('onSQty')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <!--end::Description-->

                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="form-label">Allow Backorders</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <div class="form-check form-check-custom form-check-solid mb-2">
                        <input class="form-check-input" type="checkbox" wire:model='backOrder' value="1"
                            {{ $backOrder ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Yes
                        </label>
                    </div>
                    <!--end::Input-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Allow customers to purchase products that are out of
                        stock.</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Inventory-->

        <!--begin::Variations-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Variations</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                    <!--begin::Label-->
                    <label class="form-label">Add Product Variations</label>
                    <!--end::Label-->

                    <!--begin::Repeater-->
                    <div id="variations">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div data-repeater-list="variations" class="d-flex flex-column gap-3">
                                @foreach ($variations as $key => $value)
                                    <div class="align-items-center d-flex gap-2 justify-content-between">
                                        @if (isset($value['thumbnail']) && $value['thumbnail'] !== null && $value['thumbnail'] !== '')
                                            <div>
                                                <label class="form-check-image">
                                                    <div class="form-check-wrapper">
                                                        <img class="w-100px"
                                                            src="{{ $value['thumbnail']->temporaryUrl() }}" />
                                                    </div>
                                                </label>
                                            </div>
                                        @elseif(isset($value['showThumbnail']))
                                            <div>
                                                <label class="form-check-image">
                                                    <div class="form-check-wrapper">
                                                        <img class="w-100px" src="{{ $value['showThumbnail'] }}" />
                                                    </div>
                                                </label>
                                            </div>
                                        @endif

                                        <div>
                                            <div data-repeater-item
                                                class="form-group d-flex flex-wrap flex-md-nowrap align-items-center gap-5">
                                                <!--begin::Select2-->
                                                <select class="form-select type"
                                                    wire:model='variations.{{ $key }}.type'>
                                                    <option value=""></option>
                                                    @foreach (PRODUCT_VARIATIONS as $vKey => $vValue)
                                                        <option value="{{ $vKey }}">{{ $vValue }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control "
                                                    wire:model='variations.{{ $key }}.hasPrice'
                                                    placeholder="Has Price">
                                                <!--end::Input-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control "
                                                    wire:model='variations.{{ $key }}.data'
                                                    placeholder="Variation">
                                                <!--end::Input-->

                                                <button type="button"
                                                    wire:click='deleteVariations({{ $key }})'
                                                    class="bg-transparent btn btn-flush btn-icon btn-light-danger btn-sm">
                                                    <i class="ki-duotone ki-cross fs-1"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </button>
                                            </div>
                                            <label for="variations{{ $key }}thumbnail"
                                                class="dropzone dz-clickable h-100 mt-4 py-2 w-100"
                                                id="kt_ecommerce_add_product_media">
                                                <!--begin::Message-->
                                                <div class="dz-message align-items-center needsclick">
                                                    <!--begin::Icon-->
                                                    <i class="ki-duotone ki-file-up text-primary fs-3x"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                    <!--end::Icon-->
                                                    <!--begin::Info-->
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Click to
                                                            upload.</h3>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                            </label>
                                            <input id="variations{{ $key }}thumbnail" type="file"
                                                wire:model="variations.{{ $key }}.thumbnail" hidden>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <button wire:click='addVariations()' type="button" class="btn btn-sm btn-light-primary">
                                <i class="ki-duotone ki-plus fs-2"></i> Add another variation
                            </button>
                        </div>
                        <!--end::Form group-->
                    </div>
                    <!--end::Repeater-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Variations-->

        <!--begin::Shipping-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Dimensions</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Shipping form-->
                <div id="kt_ecommerce_add_product_shipping" class="mt-10">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="form-label">Weight</label>
                        <!--end::Label-->

                        <!--begin::Editor-->
                        <input type="text" wire:model="weight" class="form-control mb-2"
                            placeholder="Product weight" value="">
                        <!--end::Editor-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                        <!--end::Description-->
                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="form-label">Dimension</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                            <input type="number" wire:model="width" class="form-control mb-2"
                                placeholder="Width (w)" value="">
                            <input type="number" wire:model="height" class="form-control mb-2"
                                placeholder="Height (h)" value="">
                            <input type="number" wire:model="length" class="form-control mb-2"
                                placeholder="Lengtn (l)" value="">
                        </div>
                        <!--end::Input-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).
                        </div>
                        <!--end::Description-->
                        @error('width')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('height')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('length')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Shipping form-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Shipping-->
        <!--begin::Meta options-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Meta Options</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mb-10">
                    <!--begin::Label-->
                    <label class="form-label">Meta Tag Title</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" class="form-control mb-2" wire:model="metaTitle"
                        placeholder="Meta tag name">
                    <!--end::Input-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and
                        precise keywords.</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-10">
                    <!--begin::Label-->
                    <label class="form-label">Meta Tag Description</label>
                    <!--end::Label-->

                    <!--begin::Editor-->
                    <livewire:quill-text-editor wire:model="metaDescription" />
                    <!--end::Editor-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set a meta tag description to the product for
                        increased SEO ranking.</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div>
                    <!--begin::Label-->
                    <label class="form-label">Meta Tag Keywords</label>
                    <!--end::Label-->

                    <!--begin::Editor-->
                    <input id="metatags" wire:model.fill="metaTags" class="form-control mb-2">
                    <!--end::Editor-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set a list of keywords that the product is related to.
                        Separate the keywords by adding a comma <code>,</code> between each keyword.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Meta options-->
    </div>
</div>
