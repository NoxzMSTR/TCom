<div>
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Navs-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <!--begin::Nav item-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab"
                        href="#account_security">Security</a>
                </li>

                <!--end::Nav item-->
            </ul>
            <!--begin::Navs-->
        </div>
    </div>
    <!--end::Navbar-->
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade  show active" id="account_security" role="tabpanel">
            <!--begin::Sign-in Method-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Security Settings</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Email Address-->
                        <div class="d-flex flex-wrap align-items-center">

                            <!--begin::Edit-->
                            <div id="kt_signin_email_edit" class="flex-row-fluid">
                                <!--begin::Form-->

                                <div class="row mb-6">
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <div class="fv-row mb-0">
                                            <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Enter
                                                New Email
                                                Address</label>
                                            <input type="email"
                                                class="form-control form-control-lg form-control-solid"
                                                id="emailaddress" placeholder="Email Address" name="emailaddress"
                                                value="{{ Auth::user()->email }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fv-row mb-0">
                                            <label for="confirmemailpassword"
                                                class="form-label fs-6 fw-bold mb-3">Confirm
                                                Password</label>
                                            <input type="password"
                                                class="form-control form-control-lg form-control-solid"
                                                name="confirmemailpassword" id="confirmemailpassword" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button id="kt_signin_submit" type="button"
                                        class="btn btn-primary me-2 px-6">Update Email</button>
                                    <button id="kt_signin_cancel" type="button"
                                        class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                </div>

                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->

                        </div>
                        <!--end::Email Address-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-6"></div>
                        <!--end::Separator-->
                        <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center mb-10">

                            <!--begin::Edit-->
                            <div id="kt_signin_password_edit" class="flex-row-fluid">
                                <!--begin::Form-->

                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current
                                                Password</label>
                                            <input type="password"
                                                class="form-control form-control-lg form-control-solid"
                                                name="currentpassword" id="currentpassword" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New
                                                Password</label>
                                            <input type="password"
                                                class="form-control form-control-lg form-control-solid"
                                                name="newpassword" id="newpassword" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm
                                                New
                                                Password</label>
                                            <input type="password"
                                                class="form-control form-control-lg form-control-solid"
                                                name="confirmpassword" id="confirmpassword" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-text mb-5">Password must be at least 8 character and
                                    contain symbols</div>
                                <div class="d-flex">
                                    <button id="kt_password_submit" type="button"
                                        class="btn btn-primary me-2 px-6">Update Password</button>
                                    <button id="kt_password_cancel" type="button"
                                        class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                </div>

                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->

                        </div>
                        <!--end::Password-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content-->
            </div>

            <!--end::Sign-in Method-->
        </div>

    </div>

</div>
@section('js')
    <script>
        setTimeout(() => {
            KTApp.hidePageLoading();
            KTComponents.init();
        }, 1000);
    </script>
@endsection
