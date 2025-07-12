<div class="card mb-5 mb-xl-10" x-data="{
    amount: $wire.entangle('shippingCharges'),
    mAmount: $wire.entangle('shippingChargeLimit'),

}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Shipping Charges</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->

        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Charges</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input x-model="amount" class="form-control form-control-sm" type="number" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Charges Applies After</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input x-model="mAmount" class="form-control form-control-sm" type="number" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button wire:click='saveShippingCharges' onclick="KTApp.showPageLoading();" class="btn btn-primary"
                id="kt_account_profile_details_submit">Save
                Changes</button>
        </div>
        <!--end::Actions-->

        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
