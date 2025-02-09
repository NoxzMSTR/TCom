<div class="col-xl-9 col-wd-9gdot5">
    <!-- Shop-control-bar Title -->
    <div class="d-block d-md-flex flex-center-between mb-3 bg-gray-1 borders-radius-9 p-2">
        <h4 class="font-size-25 mb-2 mb-md-0">My Account</h4>

    </div>
    <!-- End shop-control-bar Title -->

    <!-- Shop Body -->
    <!-- Tab Content -->
    <!--begin::Sign-in Method-->
    <div class="card  mb-5 mb-xl-5" x-data="{
        name: $wire.entangle('name'),
        email: $wire.entangle('email'),
        updateAccount() {
            $wire.updateAccount();
        }
    }">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_signin_method">
            <div class="card-title m-0">
                <h5 class="fw-bold m-0">Update Account</h5>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Content-->
        <div id="kt_account_settings_signin_method" class="collapse show">
            <!--begin::Card body-->
            <div class="card-body border-top">
                <!--begin::Email Address-->
                <div class="row mb-4">
                    <div class="col-lg-12 mb-4 mb-lg-0">
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="name" class="form-label fs-6 fw-bold mb-3">Enter Name</label>
                            <input type="text" class="form-control form-control-solid" id="name"
                                placeholder="Name" x-model="name" value="{{ Auth::user()->name }}">

                        </div>
                    </div>
                    <div class="col-lg-12 mb-4 mb-lg-0">
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Enter New
                                Email Address</label>
                            <input type="email" class="form-control form-control-solid" id="emailaddress"
                                placeholder="Email Address" x-model="email" value="{{ Auth::user()->email }}">

                        </div>
                    </div>

                </div>
                <div class="d-flex">
                    <button id="kt_signin_submit" @click="updateAccount" type="button"
                        class="btn btn-primary">Update</button>
                </div>
                <!--end::Email Address-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Sign-in Method-->
    <!--begin::Basic info-->
    <div class="row" style="gap: 20px;">
        <div class="card mb-5 mb-xl-5 col-md-6" data-select2-id="select2-data-135-qbue" x-data="{
            billingName: $wire.entangle('billingName'),
            billingCompany: $wire.entangle('billingCompany'),
            billingAddress: $wire.entangle('billingAddress'),
            billingAddress2: $wire.entangle('billingAddress2'),
            billingCity: $wire.entangle('billingCity'),
            billingEmail: $wire.entangle('billingEmail'),
            billingPhone: $wire.entangle('billingPhone'),
            updateBilling() {
                $wire.updateBilling();
            }
        }">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h5 class="fw-bold m-0">Billing Details</h5>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->

            <!--begin::Content-->
            <!--begin::Card body-->
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Full name
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" x-model="billingName"
                                placeholder="Name" aria-label="Jack" required="" data-msg="Please enter your name."
                                data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                            @error('billingName')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->

                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Company name (optional)
                            </label>
                            <input type="text" class="form-control form-control-sm" placeholder="Company Name"
                                aria-label="Company Name" data-msg="Please enter a company name."
                                data-error-class="u-has-error" data-success-class="u-has-success"
                                x-model='billingCompany'>
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-8">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Street address
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" name="streetAddress"
                                placeholder="Address" aria-label="470 Lucy Forks" required=""
                                data-msg="Please enter a valid address." data-error-class="u-has-error"
                                data-success-class="u-has-success" x-model='billingAddress'>
                            @error('billingAddress')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-4">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Apt, suite, etc.
                            </label>
                            <input type="text" class="form-control form-control-sm" placeholder="Apt, suite, etc."
                                aria-label="YC7B 3UT" data-msg="Please enter a valid address."
                                data-error-class="u-has-error" data-success-class="u-has-success"
                                x-model='billingAddress2'>
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                City
                                <span class="text-danger">*</span>
                            </label>
                            <div wire:ignore>
                                <select class="form-control js-select selectpicker dropdown-select" required=""
                                    data-msg="Please select city." data-error-class="u-has-error"
                                    data-success-class="u-has-success" data-live-search="true"
                                    data-style="form-control border-color-1 font-weight-normal" x-model='billingCity'>
                                    <option value="" disabled>Select city</option>
                                    @foreach ($cities as $key => $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('billingCity')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-6">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Email address
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-sm" name="emailAddress"
                                placeholder="Email" aria-label="jackwayley@gmail.com" required=""
                                data-msg="Please enter a valid email address." data-error-class="u-has-error"
                                data-success-class="u-has-success" x-model='billingEmail'>
                            @error('billingEmail')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-6">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Phone
                            </label>
                            <input type="text" class="form-control form-control-sm" placeholder="Phone"
                                aria-label="+1 (062) 109-9222" data-msg="Please enter your last name."
                                data-error-class="u-has-error" data-success-class="u-has-success"
                                x-model='billingPhone'>
                            @error('billingPhone')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="w-100"></div>
                </div>

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 ">
                <button type="button" @click="updateBilling" class="btn btn-primary"
                    id="kt_account_profile_details_submit">Save
                    Changes</button>
            </div>
            <!--end::Actions-->
            <!--end::Content-->
        </div>
        <div class="card mb-5 mb-xl-5 col" data-select2-id="select2-data-135-qbue" x-data="{
            shippingName: $wire.entangle('shippingName'),
            shippingCompany: $wire.entangle('shippingCompany'),
            shippingAddress: $wire.entangle('shippingAddress'),
            shippingAddress2: $wire.entangle('shippingAddress2'),
            shippingCity: $wire.entangle('shippingCity'),
            shippingEmail: $wire.entangle('shippingEmail'),
            shippingPhone: $wire.entangle('shippingPhone'),
            updateShipping() {
                $wire.updateShipping();
            }
        }">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h5 class="fw-bold m-0">Shipping Details</h5>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->

            <!--begin::Content-->
            <!--begin::Card body-->
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Full name
                            </label>
                            <input type="text" class="form-control form-control-sm" name="name"
                                placeholder="Name" aria-label="Jack" required=""
                                data-msg="Please enter your frist name." data-error-class="u-has-error"
                                data-success-class="u-has-success" autocomplete="off" x-model='shippingName'>
                            @error('shippingName')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->

                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Company name (optional)
                            </label>
                            <input type="text" class="form-control form-control-sm" name="companyName"
                                placeholder="Company Name" aria-label="Company Name"
                                data-msg="Please enter a company name." data-error-class="u-has-error"
                                data-success-class="u-has-success" x-model='shippingCompany'>
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-8">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Street address
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" name="streetAddress"
                                placeholder="Address" aria-label="470 Lucy Forks" required=""
                                data-msg="Please enter a valid address." data-error-class="u-has-error"
                                data-success-class="u-has-success" x-model='shippingAddress'>
                            @error('shippingAddress')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-4">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Apt, suite, etc.
                            </label>
                            <input type="text" class="form-control form-control-sm" placeholder="Apt, suite, etc."
                                aria-label="YC7B 3UT" data-msg="Please enter a valid address."
                                data-error-class="u-has-error" data-success-class="u-has-success"
                                x-model='shippingAddress2'>
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                City
                                <span class="text-danger">*</span>
                            </label>
                            <div wire:ignore>
                                <select class="form-control js-select selectpicker dropdown-select" required=""
                                    data-msg="Please select city." data-error-class="u-has-error"
                                    data-success-class="u-has-success" data-live-search="true"
                                    data-style="form-control border-color-1 font-weight-normal"
                                    x-model='shippingCity'>
                                    <option value="" disabled>Select city</option>
                                    @foreach ($cities as $key => $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('shippingCity')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-6">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Email address
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-sm" name="emailAddress"
                                placeholder="Email" aria-label="jackwayley@gmail.com" required=""
                                data-msg="Please enter a valid email address." data-error-class="u-has-error"
                                data-success-class="u-has-success" x-model='shippingEmail'>
                            @error('shippingEmail')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="col-md-6">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Phone
                            </label>
                            <input type="text" class="form-control form-control-sm" placeholder="Phone"
                                aria-label="+1 (062) 109-9222" data-msg="Please enter your last name."
                                data-error-class="u-has-error" data-success-class="u-has-success"
                                x-model='shippingPhone'>
                            @error('shippingPhone')
                                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="w-100"></div>
                </div>

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6">

                <button type="submit" @click="updateShipping" class="btn btn-primary"
                    id="kt_account_profile_details_submit">Save
                    Changes</button>
            </div>
            <!--end::Actions-->
            <!--end::Content-->
        </div>
    </div>
    <!--end::Basic info-->

    <!-- End Tab Content -->
    <!-- End Shop Body -->
</div>
