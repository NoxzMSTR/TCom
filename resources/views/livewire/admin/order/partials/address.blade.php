<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Delivery Details</h2>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Billing address-->
        <div class="d-flex flex-column gap-5 gap-md-7">
            <!--begin::Title-->
            <div class="fs-3 fw-bold mb-n2">Billing Address</div>
            <!--end::Title-->

            <!--begin::Input group-->
            <div class="d-flex flex-column flex-md-row gap-5">
                <div class="fv-row flex-row-fluid fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Address Line 1</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input class="form-control" wire:model='billingAddress' placeholder="Address Line 1" value="">
                    <!--end::Input-->
                    @error('billingAddress')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex-row-fluid">
                    <!--begin::Label-->
                    <label class="form-label">Address Line 2</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input class="form-control" wire:model='billingAddress2' placeholder="Address Line 2">
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column flex-md-row gap-5">
                <div class="flex-row-fluid">
                    <!--begin::Label-->
                    <label class="form-label required">City</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input class="form-control" wire:model='billingCity' placeholder="" value="">
                    <!--end::Input-->
                    @error('billingCity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="fv-row flex-row-fluid fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Postcode</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input class="form-control" wire:model='billingPostcode' placeholder="" value="">
                    <!--end::Input-->
                    @error('billingPostcode')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="fv-row flex-row-fluid fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">State</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input class="form-control" wire:model='billingState' placeholder="" value="">
                    <!--end::Input-->
                    @error('billingState')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required form-label">Country</label>
                <!--end::Label-->

                <!--begin::Select2-->
                <select wire:model.fill="billingCountry" aria-label="Select a Country" data-control="select2"
                    data-placeholder="Select a country..." {{ isset($vendor['id']) ? 'readonly' : '' }}
                    class="form-select form-select-solid form-select-lg fw-semibold">
                    <option value="">Select Country</option>
                    <option value="PK" selected>{{ $this->country }}</option>

                </select>
                <!--end::Select2-->
                @error('billingCountry')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Input group-->

            <!--begin::Checkbox-->
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" wire:model.live.fill='shippingSameAsBilling'
                    value="1" {{ $shippingSameAsBilling ? 'checked' : '' }}>
                <label class="form-check-label" for="same_as_billing">
                    Shipping address is the same as billing address
                </label>
            </div>
            <!--end::Checkbox-->
            @if ($shippingSameAsBilling == false)
                <!--begin::Shipping address-->
                <div class="d-flex flex-column gap-5 gap-md-7" id="kt_ecommerce_edit_order_shipping_form">
                    <!--begin::Title-->
                    <div class="fs-3 fw-bold mb-n2">Shipping Address</div>
                    <!--end::Title-->

                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="form-label required">Address Line 1</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input class="form-control"wire:model='shippingAddress' placeholder="Address Line 1"
                                value="">
                            <!--end::Input-->
                            @error('shippingAddress')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex-row-fluid">
                            <!--begin::Label-->
                            <label class="form-label">Address Line 2</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input class="form-control" wire:model='shippingAddress2' placeholder="Address Line 2">
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="flex-row-fluid">
                            <!--begin::Label-->
                            <label class="form-label required">City</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input class="form-control" wire:model='shippingCity' placeholder="" value="">
                            <!--end::Input-->
                            @error('shippingCity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="form-label required">Postcode</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input class="form-control" wire:model='shippingPostcode' placeholder="" value="">
                            <!--end::Input-->
                            @error('shippingPostcode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="form-label required">State</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input class="form-control" wire:model='shippingState' placeholder="" value="">
                            <!--end::Input-->
                            @error('shippingState')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="form-label required">Country</label>
                        <!--end::Label-->

                        <!--begin::Select2-->
                        <select wire:model.fill="shippingCountry" aria-label="Select a Country" data-control="select2"
                            data-placeholder="Select a country..." {{ isset($vendor['id']) ? 'readonly' : '' }}
                            class="form-select form-select-solid form-select-lg fw-semibold">
                            <option value="">Select Country</option>
                            <option value="PK" selected>{{ $this->country }}</option>
                        </select>
                        <!--end::Select2-->
                        @error('shippingCountry')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Shipping address-->
            @endif

        </div>
        <!--end::Billing address-->


    </div>
    <!--end::Card body-->
</div>
