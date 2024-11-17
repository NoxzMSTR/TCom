<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Shipping</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                    Same Day Delivery
                    <a href="javascript:;" wire:click='addSameDayDelivery' class="btn btn-light-primary">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Add
                    </a>
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                            <div class="form-group">
                                @foreach ($sameDayDelivery as $key => $value)
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-label">From:</label>
                                            <input type="time" wire:model='sameDayDelivery.{{ $key }}.from'
                                                class="form-control mb-2 mb-md-0" placeholder="Select time from" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">To:</label>
                                            <input type="time" wire:model='sameDayDelivery.{{ $key }}.to'
                                                class="form-control mb-2 mb-md-0" placeholder="Select time to" />
                                        </div>

                                        <div class="col-md-4">
                                            <a href="javascript:;"
                                                wire:click='deleteSameDayDelivery({{ $key }})'
                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                        class="path2"></span><span class="path3"></span><span
                                                        class="path4"></span><span class="path5"></span></i>
                                                Delete
                                            </a>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Standard Delivery</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                    <select wire:model.fill='standardDelivery' class="form-select form-select-solid"
                        aria-label="Select example">
                        <option>Select Option</option>
                        @foreach ($this->standardDeliveries as $key => $value)
                            <option value="{{ $key }}" {{ $standardDelivery == $key ? 'selected' : '' }}>
                                {{ $value }}</option>
                        @endforeach

                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button wire:click='saveShipping' class="btn btn-primary" id="kt_account_profile_details_submit">Save
                Changes</button>
        </div>
        <!--end::Actions-->
        <input type="hidden">

    </div>
    <!--end::Content-->
</div>
