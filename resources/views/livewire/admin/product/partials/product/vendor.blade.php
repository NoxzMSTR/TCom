<div class="tab-pane fade" id="product_vendor" role="tab-panel" wire:ignore.self>
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card-body">
            <!--begin::Compact form-->
            <div class="w-100">
                <!--begin::Input group-->
                <div class="position-relative me-md-2">
                    <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                            class="path1"></span><span class="path2"></span></i>
                    <input type="text" class="form-control form-control-solid ps-10" wire:model.live="searchVendor"
                        value="" placeholder="Search">
                </div>
                <!--end::Input group-->
                @if ($searchVendor)
                    <div class="py-5">
                        <!--begin::Results-->
                        <div data-kt-search-element="results" class="">
                            <!--begin::Users-->
                            <div class="mh-300px scroll-y me-n5 pe-5">
                                @forelse ($this->searchData as $key => $value)
                                    <div wire:click='setVendor({{ $value }})'
                                        class="d-flex align-items-center p-3 rounded-3 border-hover border border-dashed border-gray-300 cursor-pointer mb-1"
                                        data-kt-search-element="customer">
                                        <!--begin::Info-->
                                        <div class="fw-semibold">
                                            <span class="fs-6 text-gray-800 me-2">{{ $value->name }}</span>
                                            <span class="badge badge-light">{{ $value->company ?: '-' }}</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                @empty
                                    <!--begin::Empty-->
                                    <div data-kt-search-element="empty" class="text-center ">
                                        <!--begin::Message-->
                                        <div class="fw-semibold py-0">
                                            <div class="text-gray-600 fs-3 mb-2">No vendors found</div>
                                        </div>
                                        <!--end::Message-->
                                    </div>
                                    <!--end::Empty-->
                                @endforelse
                            </div>
                            <!--end::Users-->
                        </div>
                        <!--end::Results-->

                    </div>
                @endif

            </div>
            <!--end::Compact form-->
        </div>
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Details</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <div class="card-body border-top p-9">
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
                                        placeholder="First name" value=""
                                        {{ isset($vendor['id']) ? 'readonly' : '' }} />
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
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Company</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" wire:model="vendor.company"
                                class="form-control form-control-lg form-control-solid" placeholder="Company name"
                                value="" {{ isset($vendor['id']) ? 'readonly' : '' }} />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                            <span class="required">Contact Phone</span>
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
                                value="" {{ isset($vendor['id']) ? 'readonly' : '' }} />
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
                                value="" {{ isset($vendor['id']) ? 'readonly' : '' }} />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Address</label>
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
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
                                    <input type="text" wire:model="vendor.postalCode"
                                        class="form-control form-control-lg form-control-solid" placeholder="Post Code"
                                        value="" />
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
                                value="" {{ isset($vendor['id']) ? 'readonly' : '' }} />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">City & State</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" wire:model="vendor.city"
                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                        placeholder="City" value=""
                                        {{ isset($vendor['id']) ? 'readonly' : '' }} />
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
                                    <input type="text" wire:model="vendor.state"
                                        class="form-control form-control-lg form-control-solid" placeholder="State"
                                        value="" {{ isset($vendor['id']) ? 'readonly' : '' }} />
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
                            <span class="required">Country</span>
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
                            <select wire:model="vendor.country" aria-label="Select a Country" data-control="select2"
                                data-placeholder="Select a country..." {{ isset($vendor['id']) ? 'readonly' : '' }}
                                class="form-select form-select-solid form-select-lg fw-semibold">
                                <option value="PK" selected>{{ $this->country }}</option>

                            </select>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div>
