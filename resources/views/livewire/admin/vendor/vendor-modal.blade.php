<div>
    <div class="modal fade" tabindex="-1" id="vendorModal" wire:ignore.self>
        <div class="modal-dialog mw-700px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Vendor</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-12 fv-row">
                                    <input type="text" wire:model="vendor.fname"
                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                        placeholder="Full name" value="" />
                                    @error('vendor.fname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Company</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" wire:model="vendor.company"
                                class="form-control form-control-lg form-control-solid" placeholder="Company name"
                                value="" />
                            @error('vendor.company')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                            <span class="required">Phone</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="tel" wire:model="vendor.phone"
                                class="form-control form-control-lg form-control-solid" placeholder="Phone number"
                                value="" />
                            @error('vendor.phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" wire:model="vendor.email"
                                class="form-control form-control-lg form-control-solid" placeholder="Email"
                                value="" />
                            @error('vendor.email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Address</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" wire:model="vendor.address"
                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                        placeholder="Address" value="" />
                                    @error('vendor.address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
                                    <input type="text" wire:model="vendor.postalCode"
                                        class="form-control form-control-lg form-control-solid" placeholder="Post Code"
                                        value="" />
                                    @error('vendor.postalCode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Address 2</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" wire:model="vendor.address2"
                                class="form-control form-control-lg form-control-solid" placeholder="Address 2"
                                value="" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">City & State</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <select wire:model.fill="vendor.city"
                                        class="form-select form-select-solid form-select-lg fw-semibold">
                                        <option value="" selected>Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach

                                    </select>
                                    @error('vendor.city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
                                    <input type="text" wire:model="vendor.state"
                                        class="form-control form-control-lg form-control-solid" placeholder="State"
                                        value="" />
                                    @error('vendor.state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                            <span class="">Country</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select wire:model.fill="vendor.country"
                                class="form-select form-select-solid form-select-lg fw-semibold">
                                <option value="" selected>Select Country</option>
                                <option value="PK" selected>{{ $this->country }}</option>
                            </select>
                            @error('vendor.country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>

                <div class="modal-footer">
                    @if ($hasVendor)
                        <button wire:click='update' type="button" class="btn btn-primary">Update</button>
                    @else
                        <button wire:click='update' type="button" class="btn btn-primary">Create</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('show-loader', (event) => {
            KTApp.showPageLoading()
        });
        $wire.on('hide-loader', (event) => {
            setTimeout(() => {
                KTComponents.init()
                KTApp.hidePageLoading()
            }, 1000);
        });
        $wire.on('set-current-vendor', (event) => {
            $('#vendorModal').modal('hide');
            $wire.dispatch('hide-loader');
        });
        $wire.on('hide-vendor-modal', (event) => {
            $('#vendorModal').modal('hide');
            $wire.dispatch('hide-loader');
        });
        $wire.on('show-vendor-modal', (event) => {
            $('#vendorModal').modal('show');
            $wire.dispatch('hide-loader');
        });
        $wire.on('kt-component-init', (event) => {
            $wire.dispatch('hide-loader');
        });
    </script>
@endscript
