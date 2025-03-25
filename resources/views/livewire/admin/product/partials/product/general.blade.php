<div class="tab-pane fade show active" id="product_general" role="tab-panel" wire:ignore.self>
    <div class="d-flex flex-column gap-7 gap-lg-10">

        <!--begin::General options-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>General</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Product Name</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" wire:model="name" class="form-control mb-2" placeholder="Product name"
                        value="">
                    <!--end::Input-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">A product name is required and recommended to be
                        unique.</div>
                    <!--end::Description-->
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div>
                    <!--begin::Label-->
                    <label class="form-label">Short Description</label>
                    <!--end::Label-->

                    <!--begin::Editor-->
                    <livewire:quill-text-editor wire:model="shortDescription" />
                    <!--end::Editor-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set a short description to the product for better
                        visibility.</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div>
                    <!--begin::Label-->
                    <label class="form-label">Description</label>
                    <!--end::Label-->

                    <!--begin::Editor-->
                    <livewire:quill-text-editor wire:model="description" />
                    <!--end::Editor-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set a description to the product for better
                        visibility.</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::General options-->

        <!--begin::Pricing-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Pricing</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Base Price</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" wire:model="price" class="form-control mb-2" placeholder="Product price"
                        value="">
                    <!--end::Input-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the product price.</div>
                    <!--end::Description-->
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-2">
                        Discount Type
                    </label>
                    <!--End::Label-->

                    <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true"
                        data-kt-buttons-target="[data-kt-button='true']" data-kt-initialized="1">
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Option-->
                            <label
                                class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6"
                                data-kt-button="true">
                                <!--begin::Radio-->
                                <span
                                    class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                    <input class="form-check-input" type="radio" wire:model.lazy="discountType"
                                        value="0" checked="checked">
                                </span>
                                <!--end::Radio-->

                                <!--begin::Info-->
                                <span class="ms-5">
                                    <span class="fs-4 fw-bold text-gray-800 d-block">No Discount</span>
                                </span>
                                <!--end::Info-->
                            </label>
                            <!--end::Option-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Option-->
                            <label
                                class="btn btn-outline btn-outline-dashed btn-active-light-primary  d-flex text-start p-6"
                                data-kt-button="true">
                                <!--begin::Radio-->
                                <span
                                    class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                    <input class="form-check-input" type="radio" wire:model.lazy="discountType"
                                        value="1">
                                </span>
                                <!--end::Radio-->

                                <!--begin::Info-->
                                <span class="ms-5">
                                    <span class="fs-4 fw-bold text-gray-800 d-block">Percentage
                                        %</span>
                                </span>
                                <!--end::Info-->
                            </label>
                            <!--end::Option-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Option-->
                            <label
                                class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6"
                                data-kt-button="true">
                                <!--begin::Radio-->
                                <span
                                    class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                    <input class="form-check-input" type="radio" wire:model.lazy="discountType"
                                        value="2">
                                </span>
                                <!--end::Radio-->

                                <!--begin::Info-->
                                <span class="ms-5">
                                    <span class="fs-4 fw-bold text-gray-800 d-block">Fixed Price</span>
                                </span>
                                <!--end::Info-->
                            </label>
                            <!--end::Option-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    @error('discountType')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->
                @if ($discountType == 1)
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                        <!--begin::Label-->
                        <label class="form-label">Set Discount Percentage</label>
                        <!--end::Label-->

                        <!--begin::Slider-->
                        <div class="d-flex flex-column text-center mb-5">
                            <input type="text" wire:model="discountData" name="discount_percentage"
                                class="form-control mb-2" placeholder="Discount Percentage %">
                        </div>
                        <!--end::Slider-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set a percentage discount to be applied on this
                            product.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                @endif


                @if ($discountType == 2)
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
                        <!--begin::Label-->
                        <label class="form-label">Fixed Discounted Price</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="text" name="dicsounted_price" wire:model="discountData"
                            class="form-control mb-2" placeholder="Discounted price">
                        <!--end::Input-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the discounted product price. The product will be
                            reduced at the determined fixed price</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                @endif

                <!--begin::Tax-->
                <div class="d-flex flex-column flex-wrap gap-5">
                    <!--begin::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row w-100 flex-md-root">
                        <!--begin::Label-->
                        <label class="form-label">VAT Amount (%)</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="text" class="form-control mb-2" wire:model='vat' value="">
                        <!--end::Input-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the product VAT about.</div>
                        <!--end::Description-->
                    </div>
                </div>
                <!--end:Tax-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Pricing-->

    </div>
</div>
