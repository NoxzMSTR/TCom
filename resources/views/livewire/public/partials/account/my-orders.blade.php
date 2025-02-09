@extends('layout.public-master')

@section('content')
    <div class="container">
        <div class="row mb-8">
            @include('livewire.public.partials.account.menu')
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar Title -->
                <div class="d-block d-md-flex flex-center-between mb-3 bg-gray-1 borders-radius-9 p-2">
                    <h4 class="font-size-25 mb-2 mb-md-0">My Orders</h4>

                </div>
                <!-- End shop-control-bar Title -->

                <!-- Shop Body -->
                <!-- Tab Content -->
                <!--begin::Sign-in Method-->
                <div class="card  mb-5 mb-xl-5">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h5 class="fw-bold m-0">List</h5>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top">
                            @livewire('public.datatables.order-datatable')
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Sign-in Method-->
                <!-- End Shop Body -->
            </div>

        </div>
    </div>
@endsection
