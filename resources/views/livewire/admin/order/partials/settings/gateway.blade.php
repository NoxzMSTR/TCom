<div class="card mb-5 mb-xl-10" x-data="{
    url: $wire.entangle('sUrl'),
    clientID: $wire.entangle('sClientID'),
    secret: $wire.entangle('sSecret'),
}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Switch Payment Gateway</h3>
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
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Landing Page URL</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    <div class="mt-3 d-flex gap-3 flex-wrap">
                        <input x-model="url" class="form-control form-control-sm" type="text" />
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Client ID</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input x-model="clientID" class="form-control form-control-sm" type="text" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Secret Key</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input x-model="secret" class="form-control form-control-sm" type="text" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button wire:click='saveSwitchPayment' onclick="KTApp.showPageLoading();" class="btn btn-primary"
                id="kt_account_profile_details_submit">Save
                Changes</button>
        </div>
        <!--end::Actions-->
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
