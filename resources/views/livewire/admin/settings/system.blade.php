<div>
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-12">
                <!--begin::Card body-->
                <!--begin::Form-->
                <style>
                    .image-input-wrapper {
                        background-image: url('{{ asset('mAssets/media/avatars/thumbnail.jpg') }}');
                    }

                    [data-bs-theme="dark"] .image-input-wrapper {
                        background-image: url('{{ asset('mAssets/media/avatars/thumbnail.jpg') }}');
                    }
                </style>

                <!--begin:Card body-->
                <div class="card-body border-top p-9">

                    <div class="row">
                        <!--begin::Input group-->
                        <div class="row col-12 mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label required fw-semibold fs-6">System Title</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <input type="text" wire:model='system.name'
                                    class="form-control form-control-lg form-control-solid "
                                    placeholder="Enter System Title " value="" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="row col mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label required fw-semibold fs-6"> System Logo Light
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 d-flex fv-row justify-content-between mt-2">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty" data-kt-image-input="true">
                                    <!--begin::Image preview wrapper-->

                                    @if (isset($system['aLogoLight']))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url('{{ $system['aLogoLight'] }}')">
                                        </div>
                                    @elseif (isset($system['logoLight']))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url('{{ $system['logoLight']->temporaryUrl() }}')">
                                        </div>
                                    @else
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                    @endif

                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Change logo">
                                        <i class="bi bi-pencil-square fs-6"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="systemLogoLight" wire:model='system.logoLight'
                                            accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Cancel avatar">
                                        <i class="bi bi-x fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Remove avatar">
                                        <i class="bi bi-x fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row col mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label required fw-semibold fs-6">System Logo Dark
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 d-flex fv-row justify-content-between mt-2">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty" data-kt-image-input="true">

                                    @if (isset($system['aLogoDark']))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url('{{ $system['aLogoDark'] }}')">
                                        </div>
                                    @elseif (isset($system['logoDark']))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url('{{ $system['logoDark']->temporaryUrl() }}')">
                                        </div>
                                    @else
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                    @endif


                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Change logo">
                                        <i class="bi bi-pencil-square fs-6"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" wire:model='system.logoDark' accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Cancel avatar">
                                        <i class="bi bi-x fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Remove avatar">
                                        <i class="bi bi-x fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row col mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label required fw-semibold fs-6">System Favicon
                                Logo</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 d-flex fv-row justify-content-between mt-2">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty" data-kt-image-input="true">

                                    @if (isset($system['aFavicon']))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url('{{ $system['aFavicon'] }}')">
                                        </div>
                                    @elseif (isset($system['favicon']))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url('{{ $system['favicon']->temporaryUrl() }}')">
                                        </div>
                                    @else
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                    @endif

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Change logo">
                                        <i class="bi bi-pencil-square fs-6"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="systemFavLogo" wire:model='system.favicon'
                                            accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Cancel avatar">
                                        <i class="bi bi-x fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Remove avatar">
                                        <i class="bi bi-x fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="row col-12 mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label required fw-semibold fs-6">Privacy
                                Policy</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <textarea id="privacyPolicy" class="form-control form-control-lg form-control-solid"
                                    wire:model='system.privacyPolicy' id="" cols="5" rows="3"></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row col-12 mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label required fw-semibold fs-6">Term
                                Conditions</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <textarea id="termCondition" class="form-control form-control-lg form-control-solid"
                                    wire:model='system.termNCondition' id="" cols="5" rows="3"></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row col-12 mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label  required fw-semibold fs-6">About Us</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <textarea id="aboutUs" class="form-control form-control-lg form-control-solid" wire:model='system.aboutUs'
                                    cols="5" rows="3"></textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="row">
                        <!--begin::Input group-->
                        <div class="row col mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label fw-semibold fs-6 url ">Facebook Link</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <input type="text" wire:model='system.facebook'
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="Enter Facebook Link" value="" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row col mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label  fw-semibold fs-6 url ">Instagram Link</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <input type="text" wire:model='system.instagram'
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="Enter Instagram Link" value="" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row col mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-12 col-form-label fw-semibold fs-6 url ">Pinterest Link</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <input type="text" wire:model='system.pinterest'
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="Enter Pinterest Link" value="" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>

                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button wire:click='update' class="btn btn-primary" id="generalFormBtn">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->


                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->

        <!--end::Content-->
    </div>
</div>

@script
    <script>
        setTimeout(() => {
            KTApp.hidePageLoading();
            KTComponents.init();
        }, 1000);
        $wire.on('show-loader', (event) => {
            KTApp.showPageLoading()
        });
        $wire.on('hide-loader', (event) => {
            setTimeout(() => {
                KTComponents.init()
                KTApp.hidePageLoading()
            }, 1000);
        });
    </script>
@endscript
