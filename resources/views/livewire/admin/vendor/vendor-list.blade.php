@extends('admin.layout.master')

@section('content')
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>List</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            @livewire('admin.vendor.vendor-datatable')
        </div>
        <!--end::Card body-->
    </div>
    @php
        $cities = [];
        if (isset($orderSettings)) {
            foreach ($orderSettings as $key => $value) {
                if ($value['type'] == 'available_for') {
                    $cities = json_validate($value['data']) ? json_decode($value['data']) : ['Sialkot'];
                }
            }
        }
    @endphp
    @livewire('admin.vendor.vendor-modal', ['cities' => $cities])
@endsection
@section('js')
    <script>
        setTimeout(() => {
            KTApp.hidePageLoading();
            KTComponents.init();
        }, 1000);
    </script>
@endsection
