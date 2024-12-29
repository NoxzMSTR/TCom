<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">General</h3>
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
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Heading Text Color</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="color" wire:model="color.heading" class="form-control form-control-solid h-100"
                        id="">
                    @error('color.heading')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Primary Text Color</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="color" wire:model="color.text" class="form-control form-control-solid h-100"
                        id="">
                    @error('color.text')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Secondary Text Color</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="color" wire:model="color.secondaryText" class="form-control form-control-solid h-100"
                        id="">
                    @error('color.secondaryText')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Border Color</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="color" wire:model="color.border" class="form-control form-control-solid h-100"
                        id="">
                    @error('color.border')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Card Color</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="color" wire:model="color.card" class="form-control form-control-solid h-100"
                        id="">
                    @error('color.card')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Content Color</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="color" wire:model="color.content" class="form-control form-control-solid h-100"
                        id="">
                    @error('color.content')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Background Color</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="color" wire:model="color.background" class="form-control form-control-solid h-100"
                        id="">
                    @error('color.background')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button wire:click='saveColor' onclick="KTApp.showPageLoading();" class="btn btn-primary"
                id="kt_account_profile_details_submit">Save
                Changes</button>
        </div>
        <!--end::Actions-->
        <input type="hidden">

        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
