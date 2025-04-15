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
                    <div id="variations" x-data="{
                        variations: $wire.entangle('variations'),
                        addVariation() {
                            var index = this.variations.length;
                            this.variations[index] = {
                                type: '',
                                hasPrice: '',
                                stock: 0,
                                data: '',
                                thumbnail: null,
                                previewThumbnail: null,
                            };
                        },
                        deleteVariation(index, id = null) {
                            this.variations.splice(index, 1);
                            $wire.deleteVariations(this.variations, id);
                        },
                        previewImage(event, index) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.variations[index]['previewThumbnail'] = e.target.result; // Store the preview
                                };
                                reader.readAsDataURL(file);
                                $wire.upload(`variations.${index}.thumbnail`, file); // Send the file to Livewire
                            }
                        },
                        async deleteVThumb(index) {
                            $('.btn').attr('disabled', true);
                            await $wire.deleteVThumb(index);
                            $('.btn').attr('disabled', false);
                            $('.image-input-placeholder').removeAttr('style')
                        },
                        init() {
                            if (this.variations.length == 0) {
                                this.variations[0] = {
                                    type: '',
                                    hasPrice: '',
                                    stock: 0,
                                    data: '',
                                    thumbnail: null,
                                    previewThumbnail: null,
                                };
                            }
                    
                        }
                    }">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div data-repeater-list="variations" class="d-flex flex-column gap-3">
                                <template x-for="(variation, index) in variations" :key="index">
                                    <div class="align-items-center d-flex gap-2 justify-content-between">
                                        <div x-show="variation.previewThumbnail" class="image-preview position-relative"
                                            wire:ignore>
                                            <span @click="deleteVThumb(index)"
                                                class="badge badge-circle cursor-pointer  h-25px position-absolute shadow start-0 text-gray-600 top-0 translate-middle w-25px z-index-3">
                                                <i class="ki-duotone ki-trash fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </span>
                                            <label class="form-check-image">
                                                <div class="form-check-wrapper">
                                                    <img class="w-100px" :src="variation.previewThumbnail" />
                                                </div>
                                            </label>
                                        </div>

                                        <div>
                                            <div
                                                class="form-group d-flex flex-wrap flex-md-nowrap align-items-center gap-5">
                                                <!--begin::Select2-->
                                                <select class="form-select type" x-model="variation.type">
                                                    <option value=""></option>
                                                    @foreach (PRODUCT_VARIATIONS as $vKey => $vValue)
                                                        <option value="{{ $vKey }}">{{ $vValue }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->

                                                <!--begin::Input-->
                                                <input type="number" class="form-control " x-model="variation.hasPrice"
                                                    placeholder="Percentage %">
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <input type="number" class="form-control " x-model="variation.stock"
                                                    placeholder="Stock">
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control " x-model="variation.data"
                                                    placeholder="Variation">
                                                <!--end::Input-->

                                                <button type="button" @click="deleteVariation(index,variation.id)"
                                                    class="bg-transparent btn btn-sm">
                                                    <i class="ki-duotone ki-cross fs-1 text-dark text-hover-danger"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </button>
                                            </div>
                                            <label :for="'variationsT' + index"
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
                                            <input :id="'variationsT' + index" type="file"
                                                @change="previewImage($event, index)" hidden>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <button @click="addVariation()" type="button" class="btn btn-sm btn-light-primary">
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
                    <label class="form-label">Tag Keywords</label>
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
